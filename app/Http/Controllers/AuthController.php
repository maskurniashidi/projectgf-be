<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'username' => 'required|string',
            'name' => 'required|string',
            'roleId' => 'required|integer',
            'phoneNumber' => 'required|string|unique:users,phoneNumber',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'username' => $fields['username'],
            'name' => $fields['name'],
            'roleId' => $fields['roleId'],
            'phoneNumber' => $fields['phoneNumber'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request){
        $fields = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        // check
        $user = User::where('username', $fields['username'])->first();

        if(!$user || !hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'Wrong Password'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
};
