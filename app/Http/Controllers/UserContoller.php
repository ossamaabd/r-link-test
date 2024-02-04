<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\CreateAndUpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserContoller extends Controller
{

    public function index()
    {
        $users = User::all();

        return response()->json(['data' => $users]);
    }
    public function store(CreateAndUpdateUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json(['message' => 'User created successfully', 'data' => $user], 201);
    }

    public function show($id)
    {
        $user = User::find($id);

        return response()->json(['data' => $user]);
    }

    public function update(CreateAndUpdateUserRequest $request, $id)
    {
        $user = User::find($id);
        if(!isset($user))
        return response()->json(['message' => 'do not found this user', 'data' => null]);

        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message' => 'User updated successfully', 'data' => $user]);
    }
    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
