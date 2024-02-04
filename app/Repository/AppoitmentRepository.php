<?php

namespace App\Repository;

use App\Interfaces\AppoitmentInterface;
use App\Models\Appointment;
use App\Models\AppointmentStatus;

use function PHPUnit\Framework\returnCallback;

class AppoitmentRepository implements AppoitmentInterface
{
    public function dispalyAppointmentsByUser()
    {
        try {
            $appointments = Appointment::select('user_id', 'doctor_id', 'status_id', 'appointment_date', 'start_time')->with(['user', 'doctor', 'status'])->where('user_id', auth('user')->user()->id)->get();

            return response()->json(['data' => $appointments]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function displayAppointmentsByAdmin($request)
    {
        try {
            $appointments = Appointment::select('user_id', 'doctor_id', 'status_id', 'appointment_date', 'start_time')->with(['user', 'doctor', 'status'])->where('user_id', $request->user_id)->get();

            return response()->json(['data' => $appointments]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function searchAppointmentsByAdmin($request)
    {
        try {
            $query = Appointment::query();


            if ($request->has('user_name')) {
                $userName = $request->input('user_name');
                $query->with([
                    'user' =>
                    function ($subQuery) use ($userName) {
                        $subQuery->where('name', 'like', '%' . $userName . '%');
                    }, 'doctor', 'status'
                ])->get();
            }
            if ($request->has('status_name')) {
                $statusName = $request->input('status_name');
                $query->with(['user', 'doctor.specialties', 'status'])->whereHas('user', function ($subQuery) use ($statusName) {
                    $subQuery->where('name', 'like', '%' . $statusName . '%');
                });
            }

            if ($request->has('doctor_name')) {
                $doctorName = $request->input('doctor_name');
                $query->with(['user', 'doctor.specialties', 'status'])->whereHas('doctor', function ($subQuery) use ($doctorName) {
                    $subQuery->where('name', 'like', '%' . $doctorName . '%');
                });
            }

            if ($request->has('specialization')) {
                $specialization = $request->input('specialization');

                $query->with(['user', 'doctor.specialties', 'status'])->whereHas('doctor.specialties', function ($subQuery) use ($specialization) {
                    $subQuery->where('name', 'like', '%' . $specialization . '%');
                });
            }

            $appointments = $query->get();


            return response()->json(['data' => $appointments]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function createAppointmentByUser($request)
    {
        try {
            $appointment = new Appointment();
            $appointment->user_id = auth('user')->user()->id;
            $appointment->doctor_id = $request->doctor_id;
            $appointment->status_id = $request->status_id;
            $appointment->appointment_date = $request->appointment_date;
            $appointment->start_time = $request->start_time;
            $appointment->end_time = $request->end_time;
            $appointment->save();

            return response()->json(['message' => 'Appointment created successfully', 'data' => $appointment], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function acceprOrRejectedAppointmentByAdmin($request)
    {
        try {
            $appointment =  Appointment::find($request->appointment_id);

            $appointment->status_id = $request->status_id;
            $appointment->save();

            return response()->json(['message' => 'Appointment updated successfully', 'data' => $appointment]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function acceptOrRejectedAppointmentByDoctor($request)
    {
        try {
            $status = AppointmentStatus::find($request->status_id);

            if (!isset($status))
                return response()->json(['message' => 'Appointment status not found']);
            $appointment =  Appointment::find($request->appointment_id);

            $appointment->status_id = $request->status_id;
            $appointment->save();

            return response()->json(['message' => 'Appointment updated successfully', 'data' => $appointment]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function cancelAppointmentByUser($request)
    {
        try {
            $status = AppointmentStatus::find($request->status_id);
            if (!isset($status))
                return response()->json(['message' => 'Appointment status not found']);

            $appointment =  Appointment::find($request->appointment_id);

            $appointment->status_id = $request->status_id;
            $appointment->save();

            return response()->json(['message' => 'Appointment updated successfully', 'data' => $appointment]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
