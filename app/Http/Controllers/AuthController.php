<?php

namespace App\Http\Controllers;


use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error'=>$validator->errors(),
                "success" => false
            ], 422);
        }

        $input = $request->all();
        $input['password'] = bcrypt($request->get('password'));
        $user = User::create($input);
        $token =  $user->createToken('MyApp')->accessToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
            'success' => true
        ], 200);
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if(!Auth::attempt($credentials)){
            return response([
                "message" => "Usuario y/o contraseña es invalido.",
                "success" => false

            ], 401);
        }

        $accessToken = Auth::user()->createToken('authTestToken')->accessToken;

        return response([
            "user" => Auth::user(),
            "access_token" => $accessToken,
            "success" => true
        ]);

    }
}
