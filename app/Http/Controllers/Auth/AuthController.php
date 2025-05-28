<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    // 🔐 REGISTER
    public function register(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|unique:customer',
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:customer',
            'password' => 'required|min:6',
            'phone' => 'required|date',
            'address' => 'required|date'
        ]);

        $customer = Customer::create([
            'customer_id' => $request->customer_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        return response()->json(['message' => 'Register success', 'data' => $customer], 201);
    }

    // 🔑 LOGIN
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $customer = Customer::where('email', $request->email)->first();

    if (!$customer || !Hash::check($request->password, $customer->password)) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $token = $customer->createToken('auth_token')->plainTextToken;

    return response()->json([
        'token' => $token,
        'user' => $customer
    ]);
}


    // 🚪 LOGOUT
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}