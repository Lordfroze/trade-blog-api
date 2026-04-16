<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// panggil beberapa class
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class JWTAuthController extends Controller
{
    // Handling register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // jika validator gagal
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        // jika validator sukses
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        // buat token
        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'), 201);
    }

    // Handling login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password'); // ambil credential dari request

        $token = JWTAuth::attempt($credentials); // cek credential dengan database
        // jika credential tidak cocok
        if (!$token) {
            return response()->json([
                'error' => 'Invalid Credentials',
            ], 401);
        }

        // jika credential cocok
        return response()->json(compact('token'));
    }
}
