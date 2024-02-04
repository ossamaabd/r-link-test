<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthContoller extends Controller
{
    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $token = auth()->user()->createToken('UserToken',['actAsUser'])->plainTextToken;
            return response()->json(['token' => $token]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }
    public function loginAdmin(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
        // return Auth::guard('admin');
        $admin = Admin::where('name',$request->name)->first();
        if (Hash::check($request->password, $admin->password)) {
            $token = $admin->createToken('AdminToken',['actAsAdmin'])->plainTextToken;
            return response()->json(['token' => $token]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    protected function guardAdmin()
    {
        return Auth::guard('admin');
    }
}
