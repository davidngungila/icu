<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PatientRegistrationController extends Controller
{
    public function index()
    {
        $patients = Patient::with(['admissions' => function($query) {
            $query->where('status', 'active');
        }])->orderBy('created_at', 'desc')->paginate(10);
        
        return view('hms.patient-registration.index', compact('patients'));
    }

    public function create()
    {
        return view('hms.patient-registration.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'sex' => 'required|in:M,F',
            'dob' => 'required|date|before:today',
            'phone' => 'required|string|max:20',
            'national_id' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:500',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:20',
            'blood_type' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'allergies' => 'nullable|string|max:1000',
            'chronic_conditions' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Generate unique MRN
        $mrn = $this->generateMRN();
        
        // Generate QR code for patient
        $qrCodeData = json_encode([
            'mrn' => $mrn,
            'name' => $request->full_name,
            'phone' => $request->phone,
            'dob' => $request->dob
        ]);
        
        $qrCode = base64_encode(QrCode::format('png')->size(200)->generate($qrCodeData));

        $patient = Patient::create([
            'mrn' => $mrn,
            'full_name' => $request->full_name,
            'sex' => $request->sex,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'national_id' => $request->national_id,
            'email' => $request->email,
            'address' => $request->address,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_phone' => $request->emergency_contact_phone,
            'blood_type' => $request->blood_type,
            'allergies' => $request->allergies,
            'chronic_conditions' => $request->chronic_conditions,
            'qr_code' => $qrCode,
            'status' => 'registered',
            'registered_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Patient registered successfully',
            'patient' => $patient->load('admissions'),
            'qr_code' => $qrCode
        ]);
    }

    public function show(Patient $patient)
    {
        $patient->load(['admissions', 'vitals' => function($query) {
            $query->latest()->limit(10);
        }, 'labResults', 'radiologyExams', 'billing']);
        
        return view('hms.patient-registration.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('hms.patient-registration.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'sex' => 'required|in:M,F',
            'dob' => 'required|date|before:today',
            'phone' => 'required|string|max:20',
            'national_id' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:500',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:20',
            'blood_type' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'allergies' => 'nullable|string|max:1000',
            'chronic_conditions' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $patient->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Patient information updated successfully',
            'patient' => $patient
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        
        $patients = Patient::where(function($q) use ($query) {
            $q->where('mrn', 'LIKE', "%{$query}%")
              ->orWhere('full_name', 'LIKE', "%{$query}%")
              ->orWhere('phone', 'LIKE', "%{$query}%")
              ->orWhere('national_id', 'LIKE', "%{$query}%");
        })->limit(10)->get();

        return response()->json($patients);
    }

    private function generateMRN()
    {
        do {
            $mrn = 'HMS-' . date('Y') . '-' . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
        } while (Patient::where('mrn', $mrn)->exists());
        
        return $mrn;
    }

    public function getPatientStats()
    {
        $stats = [
            'total_patients' => Patient::count(),
            'registered_today' => Patient::whereDate('created_at', today())->count(),
            'admitted_patients' => Patient::where('status', 'admitted')->count(),
            'discharged_today' => Patient::whereHas('admissions', function($query) {
                $query->whereDate('discharged_at', today());
            })->count(),
        ];

        return response()->json($stats);
    }
}
