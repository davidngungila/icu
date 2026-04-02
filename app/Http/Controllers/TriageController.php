<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\PatientAdmission;
use App\Models\PatientVital;
use App\Models\Bed;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TriageController extends Controller
{
    public function index()
    {
        $pendingPatients = Patient::where('status', 'registered')
            ->with(['admissions' => function($query) {
                $query->where('status', 'pending');
            }])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('hms.triage.index', compact('pendingPatients'));
    }

    public function create(Patient $patient)
    {
        $wards = Ward::with(['beds' => function($query) {
            $query->where('status', 'available');
        }])->get();
        
        return view('hms.triage.create', compact('patient', 'wards'));
    }

    public function store(Request $request, Patient $patient)
    {
        $validator = Validator::make($request->all(), [
            'chief_complaint' => 'required|string|max:1000',
            'history_present_illness' => 'required|string|max:2000',
            'vitals' => 'required|array',
            'vitals.hr' => 'required|integer|min:30|max:200',
            'vitals.sbp' => 'required|integer|min:50|max:250',
            'vitals.dbp' => 'required|integer|min:30|max:150',
            'vitals.temp_c' => 'required|numeric|min:35|max:42',
            'vitals.spo2' => 'required|integer|min:70|max:100',
            'vitals.rr' => 'required|integer|min:8|max:40',
            'acuity_level' => 'required|in:critical,urgent,non_urgent',
            'requires_admission' => 'required|boolean',
            'ward_id' => 'required_if:requires_admission,true|exists:wards,id',
            'bed_id' => 'required_if:requires_admission,true|exists:beds,id',
            'attending_physician' => 'required|string|max:255',
            'primary_diagnosis' => 'nullable|string|max:1000',
            'allergies' => 'nullable|string|max:1000',
            'medications' => 'nullable|string|max:1000',
            'notes' => 'nullable|string|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            // Create admission record
            $admission = PatientAdmission::create([
                'patient_id' => $patient->id,
                'ward_id' => $request->requires_admission ? $request->ward_id : null,
                'bed_id' => $request->requires_admission ? $request->bed_id : null,
                'admitted_at' => now(),
                'primary_diagnosis' => $request->primary_diagnosis,
                'attending_physician' => $request->attending_physician,
                'status' => 'active',
                'metadata' => [
                    'chief_complaint' => $request->chief_complaint,
                    'history_present_illness' => $request->history_present_illness,
                    'acuity_level' => $request->acuity_level,
                    'allergies' => $request->allergies,
                    'medications' => $request->medications,
                    'triage_nurse_id' => auth()->id(),
                    'triage_timestamp' => now()->toISOString(),
                ]
            ]);

            // Record initial vitals
            PatientVital::create([
                'patient_id' => $patient->id,
                'admission_id' => $admission->id,
                'measured_at' => now(),
                'hr' => $request->vitals['hr'],
                'sbp' => $request->vitals['sbp'],
                'dbp' => $request->vitals['dbp'],
                'temp_c' => $request->vitals['temp_c'],
                'spo2' => $request->vitals['spo2'],
                'rr' => $request->vitals['rr'],
            ]);

            // Update patient status
            $patient->update([
                'status' => $request->requires_admission ? 'admitted' : 'outpatient',
            ]);

            // Mark bed as occupied if admission requires bed
            if ($request->requires_admission && $request->bed_id) {
                Bed::where('id', $request->bed_id)->update([
                    'status' => 'occupied',
                    'occupied_by_patient_id' => $patient->id,
                    'occupied_at' => now(),
                ]);
            }

            // Create alert if critical or urgent acuity
            if (in_array($request->acuity_level, ['critical', 'urgent'])) {
                $this->createTriageAlert($patient, $admission, $request->acuity_level);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Patient triage completed successfully',
                'admission' => $admission->load(['patient', 'ward', 'bed']),
                'acuity_level' => $request->acuity_level
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Error during triage process: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(PatientAdmission $admission)
    {
        $admission->load([
            'patient',
            'ward',
            'bed',
            'vitals' => function($query) {
                $query->orderBy('measured_at', 'desc')->limit(20);
            }
        ]);

        return view('hms.triage.show', compact('admission'));
    }

    public function updateVitals(Request $request, Patient $patient)
    {
        $validator = Validator::make($request->all(), [
            'hr' => 'required|integer|min:30|max:200',
            'sbp' => 'required|integer|min:50|max:250',
            'dbp' => 'required|integer|min:30|max:150',
            'temp_c' => 'required|numeric|min:35|max:42',
            'spo2' => 'required|integer|min:70|max:100',
            'rr' => 'required|integer|min:8|max:40',
            'notes' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $vital = PatientVital::create([
            'patient_id' => $patient->id,
            'admission_id' => $patient->activeAdmission?->id,
            'measured_at' => now(),
            'hr' => $request->hr,
            'sbp' => $request->sbp,
            'dbp' => $request->dbp,
            'temp_c' => $request->temp_c,
            'spo2' => $request->spo2,
            'rr' => $request->rr,
        ]);

        // Check for critical vitals and create alerts
        $this->checkCriticalVitals($patient, $request->all());

        return response()->json([
            'success' => true,
            'message' => 'Vitals recorded successfully',
            'vital' => $vital
        ]);
    }

    public function getAvailableBeds(Request $request)
    {
        $wardId = $request->get('ward_id');
        
        if (!$wardId) {
            return response()->json(['error' => 'Ward ID is required'], 422);
        }

        $beds = Bed::where('ward_id', $wardId)
            ->where('status', 'available')
            ->orderBy('code')
            ->get();

        return response()->json($beds);
    }

    public function getTriageStats()
    {
        $today = Carbon::today();
        $stats = [
            'pending_triage' => Patient::where('status', 'registered')->count(),
            'triaged_today' => PatientAdmission::whereDate('admitted_at', $today)->count(),
            'critical_patients' => PatientAdmission::where('status', 'active')
                ->whereJsonContains('metadata->acuity_level', 'critical')
                ->count(),
            'urgent_patients' => PatientAdmission::where('status', 'active')
                ->whereJsonContains('metadata->acuity_level', 'urgent')
                ->count(),
            'available_beds' => Bed::where('status', 'available')->count(),
            'occupied_beds' => Bed::where('status', 'occupied')->count(),
        ];

        return response()->json($stats);
    }

    public function dischargePatient(Request $request, PatientAdmission $admission)
    {
        $validator = Validator::make($request->all(), [
            'discharge_notes' => 'required|string|max:2000',
            'discharge_type' => 'required|in:recovered,transferred,referred,lama',
            'follow_up_instructions' => 'nullable|string|max:1000',
            'medications_on_discharge' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            $admission->update([
                'discharged_at' => now(),
                'status' => 'discharged',
                'metadata' => array_merge($admission->metadata ?? [], [
                    'discharge_type' => $request->discharge_type,
                    'discharge_notes' => $request->discharge_notes,
                    'follow_up_instructions' => $request->follow_up_instructions,
                    'medications_on_discharge' => $request->medications_on_discharge,
                    'discharged_by' => auth()->id(),
                ])
            ]);

            // Free up the bed
            if ($admission->bed_id) {
                Bed::where('id', $admission->bed_id)->update([
                    'status' => 'available',
                    'occupied_by_patient_id' => null,
                    'occupied_at' => null,
                ]);
            }

            // Update patient status
            $admission->patient->update([
                'status' => 'discharged',
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Patient discharged successfully',
                'admission' => $admission->load(['patient', 'ward', 'bed'])
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Error during discharge: ' . $e->getMessage()
            ], 500);
        }
    }

    private function createTriageAlert(Patient $patient, PatientAdmission $admission, string $acuityLevel)
    {
        $alertData = [
            'severity' => $acuityLevel === 'critical' ? 'critical' : 'high',
            'category' => 'Triage',
            'title' => 'Patient requires immediate attention',
            'message' => "Patient {$patient->full_name} (MRN: {$patient->mrn}) triaged as {$acuityLevel}",
            'patient_id' => $patient->id,
            'admission_id' => $admission->id,
            'triggered_at' => now(),
            'metadata' => [
                'acuity_level' => $acuityLevel,
                'patient_name' => $patient->full_name,
                'mrn' => $patient->mrn,
                'location' => $admission->ward?->name . ' - ' . $admission->bed?->code,
            ]
        ];

        // This would create an alert in the existing Alert system
        // For now, we'll just log it
        \Log::critical('Triage Alert Created', $alertData);
    }

    private function checkCriticalVitals(Patient $patient, array $vitals)
    {
        $criticalRanges = [
            'hr' => ['min' => 40, 'max' => 120],
            'sbp' => ['min' => 90, 'max' => 180],
            'dbp' => ['min' => 60, 'max' => 110],
            'temp_c' => ['min' => 36.0, 'max' => 38.5],
            'spo2' => ['min' => 95, 'max' => 100],
            'rr' => ['min' => 12, 'max' => 20],
        ];

        $criticalVitals = [];
        
        foreach ($criticalRanges as $vital => $range) {
            $value = $vitals[$vital];
            if ($value < $range['min'] || $value > $range['max']) {
                $criticalVitals[] = [
                    'vital' => $vital,
                    'value' => $value,
                    'range' => $range,
                    'status' => $value < $range['min'] ? 'low' : 'high'
                ];
            }
        }

        if (!empty($criticalVitals)) {
            $this->createVitalAlert($patient, $criticalVitals);
        }
    }

    private function createVitalAlert(Patient $patient, array $criticalVitals)
    {
        $alertData = [
            'severity' => 'high',
            'category' => 'Vitals',
            'title' => 'Critical vitals detected',
            'message' => "Patient {$patient->full_name} has critical vitals readings",
            'patient_id' => $patient->id,
            'triggered_at' => now(),
            'metadata' => [
                'critical_vitals' => $criticalVitals,
                'patient_name' => $patient->full_name,
                'mrn' => $patient->mrn,
            ]
        ];

        \Log::critical('Critical Vitals Alert', $alertData);
    }

    public function getPatientVitals(Patient $patient, Request $request)
    {
        $limit = $request->get('limit', 20);
        $vitals = PatientVital::where('patient_id', $patient->id)
            ->with('admission')
            ->orderBy('measured_at', 'desc')
            ->limit($limit)
            ->get();

        return response()->json($vitals);
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        
        $patients = Patient::where('status', 'registered')
            ->where(function($q) use ($query) {
                $q->where('mrn', 'LIKE', "%{$query}%")
                  ->orWhere('full_name', 'LIKE', "%{$query}%")
                  ->orWhere('phone', 'LIKE', "%{$query}%");
            })
            ->limit(10)
            ->get();

        return response()->json($patients);
    }
}
