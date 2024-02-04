<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyContoller extends Controller
{

    public function index()
    {
        $Specialties = Specialty::all();

        return response()->json(['data' => $Specialties]);
    }

    public function store(Request $request)
    {
        $specialty = new Specialty();
        $specialty->name = $request->name;
        $specialty->save();
        return response()->json(['message' => 'specialty created successfully', 'data' => $specialty], 201);
    }

    public function show($id)
    {
        $specialty = Specialty::find($id);

        return response()->json(['user' => $specialty]);
    }

    public function update(Request $request, $id)
    {
        $specialty = Specialty::find($id);
        if(!isset($specialty))
        return response()->json(['message' => 'do not found this Specialty', 'data' => null]);

        $validatedData = $request->validated();

        $specialty->update($validatedData);

        return response()->json(['message' => 'Specialty updated successfully', 'data' => $specialty]);
    }
    public function destroy($id)
    {
        $specialty = Specialty::find($id);

        $specialty->delete();

        return response()->json(['message' => 'Specialty deleted successfully']);
    }
}
