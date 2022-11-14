<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
    function login(Request $request)
    {
        $userData = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($userData)) {
            $token = Auth::user()->createToken('auth_token');

            $data = [
                'message' => 'Login successfully',
                'token' => $token->plainTextToken,
                'code' => 200
            ];
        } else {
            $data = [
                'message' => 'Username or Password is wrong',
                'code' => 200
            ];

        }
        return response()->json($data,$data['code']); 
    }

    function register(Request $request)
    {
        # get input data
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];

        $userCreated = User::create($userData);

        $data = [
            'message' => 'User is created successfully',
            'code' => 201,
        ];

        // Mengirim respon JSON
        return response()->json($data,$data['code']);
    }
}
