<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['patient', 'doctor'])
            ->orderBy('appointment_datetime', 'asc')
            ->paginate(10);
            
        return view('hms.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $patients = Patient::where('status', '!=', 'discharged')->orderBy('full_name')->get();
        $doctors = User::whereHas('roles', function($query) {
            $query->whereIn('name', ['ICU Physician', 'System Admin', 'Super Admin']);
        })->orderBy('name')->get();
        
        return view('hms.appointments.create', compact('patients', 'doctors'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:users,id',
            'appointment_datetime' => 'required|date|after:now',
            'appointment_type' => 'required|in:consultation,follow_up,emergency',
            'reason_for_visit' => 'required|string|max:1000',
            'notes' => 'nullable|string|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Check for conflicting appointments
        $conflict = Appointment::where('doctor_id', $request->doctor_id)
            ->where('appointment_datetime', $request->appointment_datetime)
            ->where('status', '!=', 'cancelled')
            ->first();

        if ($conflict) {
            return response()->json([
                'success' => false,
                'message' => 'Doctor already has an appointment at this time'
            ], 422);
        }

        // Generate QR code
        $qrCodeData = json_encode([
            'appointment_id' => 'APT-' . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT),
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'datetime' => $request->appointment_datetime
        ]);
        
        $qrCode = base64_encode(\SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')->size(200)->generate($qrCodeData));

        $appointment = Appointment::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'appointment_datetime' => $request->appointment_datetime,
            'appointment_type' => $request->appointment_type,
            'reason_for_visit' => $request->reason_for_visit,
            'notes' => $request->notes,
            'qr_code' => $qrCode,
            'status' => 'scheduled',
        ]);

        // Send reminder notification (this would integrate with a notification system)
        $this->sendAppointmentReminder($appointment);

        return response()->json([
            'success' => true,
            'message' => 'Appointment scheduled successfully',
            'appointment' => $appointment->load(['patient', 'doctor']),
            'qr_code' => $qrCode
        ]);
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['patient', 'doctor']);
        return view('hms.appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $patients = Patient::where('status', '!=', 'discharged')->orderBy('full_name')->get();
        $doctors = User::whereHas('roles', function($query) {
            $query->whereIn('name', ['ICU Physician', 'System Admin', 'Super Admin']);
        })->orderBy('name')->get();
        
        return view('hms.appointments.edit', compact('appointment', 'patients', 'doctors'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validator = Validator::make($request->all(), [
            'appointment_datetime' => 'required|date|after:now',
            'appointment_type' => 'required|in:consultation,follow_up,emergency',
            'reason_for_visit' => 'required|string|max:1000',
            'notes' => 'nullable|string|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $appointment->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Appointment updated successfully',
            'appointment' => $appointment->load(['patient', 'doctor'])
        ]);
    }

    public function checkIn(Appointment $appointment)
    {
        if ($appointment->status !== 'scheduled') {
            return response()->json([
                'success' => false,
                'message' => 'Appointment cannot be checked in'
            ], 422);
        }

        $appointment->update([
            'status' => 'confirmed',
            'checked_in_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Patient checked in successfully',
            'appointment' => $appointment->load(['patient', 'doctor'])
        ]);
    }

    public function complete(Appointment $appointment)
    {
        if ($appointment->status !== 'confirmed') {
            return response()->json([
                'success' => false,
                'message' => 'Appointment must be checked in first'
            ], 422);
        }

        $appointment->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Appointment completed successfully',
            'appointment' => $appointment->load(['patient', 'doctor'])
        ]);
    }

    public function cancel(Request $request, Appointment $appointment)
    {
        $validator = Validator::make($request->all(), [
            'cancellation_reason' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $appointment->update([
            'status' => 'cancelled',
            'notes' => $appointment->notes . "\n\nCancelled: " . $request->cancellation_reason,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Appointment cancelled successfully',
            'appointment' => $appointment->load(['patient', 'doctor'])
        ]);
    }

    public function getDoctorAvailability(Request $request)
    {
        $doctorId = $request->get('doctor_id');
        $date = $request->get('date');
        
        if (!$doctorId || !$date) {
            return response()->json(['error' => 'Doctor ID and date are required'], 422);
        }

        $appointments = Appointment::where('doctor_id', $doctorId)
            ->whereDate('appointment_datetime', $date)
            ->where('status', '!=', 'cancelled')
            ->pluck('appointment_datetime')
            ->map(function($datetime) {
                return Carbon::parse($datetime)->format('H:i');
            });

        // Generate available time slots (9 AM to 5 PM, 30-minute intervals)
        $availableSlots = [];
        $startTime = Carbon::parse($date . ' 09:00');
        $endTime = Carbon::parse($date . ' 17:00');
        
        while ($startTime < $endTime) {
            $timeSlot = $startTime->format('H:i');
            if (!$appointments->contains($timeSlot)) {
                $availableSlots[] = $timeSlot;
            }
            $startTime->addMinutes(30);
        }

        return response()->json([
            'available_slots' => $availableSlots,
            'booked_slots' => $appointments->toArray()
        ]);
    }

    public function getCalendar(Request $request)
    {
        $doctorId = $request->get('doctor_id');
        $startDate = $request->get('start');
        $endDate = $request->get('end');

        $query = Appointment::with(['patient', 'doctor'])
            ->whereBetween('appointment_datetime', [$startDate, $endDate])
            ->where('status', '!=', 'cancelled');

        if ($doctorId) {
            $query->where('doctor_id', $doctorId);
        }

        $appointments = $query->get()->map(function($appointment) {
            return [
                'id' => $appointment->id,
                'title' => $appointment->patient->full_name . ' - ' . $appointment->appointment_type,
                'start' => $appointment->appointment_datetime,
                'backgroundColor' => $this->getStatusColor($appointment->status),
                'borderColor' => $this->getStatusColor($appointment->status),
                'extendedProps' => [
                    'patient' => $appointment->patient,
                    'doctor' => $appointment->doctor,
                    'status' => $appointment->status,
                    'reason' => $appointment->reason_for_visit
                ]
            ];
        });

        return response()->json($appointments);
    }

    public function getAppointmentStats()
    {
        $today = Carbon::today();
        $stats = [
            'total_appointments' => Appointment::count(),
            'today_appointments' => Appointment::whereDate('appointment_datetime', $today)->count(),
            'pending_appointments' => Appointment::where('status', 'scheduled')->count(),
            'completed_appointments' => Appointment::where('status', 'completed')->count(),
            'cancelled_appointments' => Appointment::where('status', 'cancelled')->count(),
            'checked_in_today' => Appointment::whereDate('checked_in_at', $today)->count(),
        ];

        return response()->json($stats);
    }

    private function getStatusColor($status)
    {
        return match($status) {
            'scheduled' => '#3B82F6', // blue
            'confirmed' => '#10B981', // emerald
            'completed' => '#6B7280', // gray
            'cancelled' => '#EF4444', // red
            'no_show' => '#F59E0B', // amber
            default => '#6B7280'
        };
    }

    private function sendAppointmentReminder($appointment)
    {
        // This would integrate with SMS, Email, or Push notification systems
        // For now, we'll just log that a reminder was sent
        \Log::info('Appointment reminder sent for appointment #' . $appointment->id);
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        
        $appointments = Appointment::with(['patient', 'doctor'])
            ->where(function($q) use ($query) {
                $q->whereHas('patient', function($subQuery) use ($query) {
                    $subQuery->where('full_name', 'LIKE', "%{$query}%")
                             ->orWhere('mrn', 'LIKE', "%{$query}%")
                             ->orWhere('phone', 'LIKE', "%{$query}%");
                })
                ->orWhereHas('doctor', function($subQuery) use ($query) {
                    $subQuery->where('name', 'LIKE', "%{$query}%");
                });
            })
            ->limit(10)
            ->get();

        return response()->json($appointments);
    }
}
