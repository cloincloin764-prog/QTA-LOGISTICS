<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DriverAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $driver = Driver::where('email', $request->email)->first();

        if (! $driver || ! Hash::check($request->password, $driver->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        $token = $driver->createToken('driver-token')->plainTextToken;

        return response()->json([
            'token'  => $token,
            'driver' => $driver,
        ]);
    }
}
