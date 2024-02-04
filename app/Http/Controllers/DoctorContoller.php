<?php

namespace App\Http\Controllers;

use App\Http\Requests\Doctors\CreateAndUpdateDoctorRequest;
use App\Models\Doctor;
use Hash;
use Illuminate\Http\Request;

class DoctorContoller extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();

        return response()->json(['data' => $doctors]);
    }
    public function store(Request $request)
    {
        $doctor = new Doctor();
        $doctor->name = $request->name;
        $doctor->password = Hash::make($request->password);
        $doctor->save();
        return response()->json(['message' => 'Doctor created successfully', 'data' => $doctor], 201);
    }

    public function show($id)
    {
        $doctor = Doctor::find($id);

        return response()->json(['data' => $doctor]);
    }

    public function update(CreateAndUpdateDoctorRequest $request, $id)
    {
        $doctor = Doctor::find($id);
        if(!isset($user))
        return response()->json(['message' => 'do not found this doctor', 'data' => null]);

        $validatedData = $request->validated();

        $doctor->update($validatedData);

        return response()->json(['message' => 'Doctor updated successfully', 'data' => $doctor]);
    }
    public function destroy($id)
    {
        $doctor = Doctor::find($id);

        $doctor->delete();

        return response()->json(['message' => 'Doctor deleted successfully']);
    }
}
