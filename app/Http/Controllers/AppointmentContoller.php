<?php

namespace App\Http\Controllers;

use App\Http\Requests\Appointments\CreateAppointmentRequest;
use App\Http\Requests\Users\CreateAndUpdateUserRequest;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AppointmentContoller extends Controller
{

    public function index()
    {
        $appointments = Appointment::all();

        return response()->json(['data' => $appointments]);
    }
    public function store(CreateAppointmentRequest $request)
    {
        $validatedData = $request->validated();

        $appointment = Appointment::create($validatedData);

        return response()->json(['message' => 'Appointment created successfully', 'data' => $appointment], 201);
    }

    public function show($id)
    {
        $appointment = Appointment::find($id);

        return response()->json(['data' => $appointment]);
    }

    public function update(CreateAndUpdateUserRequest $request, $id)
    {
        $appointment = Appointment::find($id);
        if(!isset($appointment))
        return response()->json(['message' => 'do not found this Appointment', 'data' => null]);
        $validatedData = $request->validated();

        $appointment->update($validatedData);

        return response()->json(['message' => 'Appointment updated successfully', 'data' => $appointment]);
    }
    public function destroy($id)
    {
        $appointment = Appointment::find($id);

        $appointment->delete();

        return response()->json(['message' => 'Appointment deleted successfully']);
    }
}
