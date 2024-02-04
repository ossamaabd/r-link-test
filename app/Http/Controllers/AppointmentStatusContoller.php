<?php

namespace App\Http\Controllers;

use App\Models\AppointmentStatus;
use App\Models\Specialty;
use Illuminate\Http\Request;

class AppointmentStatusContoller extends Controller
{

    public function index()
    {
        $appointmentStatus = AppointmentStatus::all();

        return response()->json(['data' => $appointmentStatus]);
    }

    public function store(Request $request)
    {
        $appointmentStatus = new AppointmentStatus();
        $appointmentStatus->name = $request->name;
        $appointmentStatus->save();
        return response()->json(['message' => 'appointment Status created successfully', 'data' => $appointmentStatus], 201);
    }

    public function show($id)
    {
        $specialty = AppointmentStatus::find($id);

        return response()->json(['appointmentStatus' => $specialty]);
    }

    public function update(Request $request, $id)
    {
        $appointmentStatus = AppointmentStatus::find($id);
        if(!isset($appointmentStatus))
        return response()->json(['message' => 'do not found this appointmentStatus', 'data' => null]);

        $validatedData = $request->validated();

        $appointmentStatus->update($validatedData);

        return response()->json(['message' => 'appointmentStatus updated successfully', 'data' => $appointmentStatus]);
    }
    public function destroy($id)
    {
        $appointmentStatus = AppointmentStatus::find($id);

        $appointmentStatus->delete();

        return response()->json(['message' => 'appointmentStatus deleted successfully']);
    }
}
