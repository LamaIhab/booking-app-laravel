<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Constants\HttpCode;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        // validate email and password before continuing
        $validate = UserRequest::validateLoginRequest($request->toArray());
        if ($validate) return response()->json([$validate], HttpCode::HTTP_BAD_REQUEST);
        $credentials = $request->only('email', 'password');
        // generating token from email and password and checking if it's correct
        $token = Auth::attempt($credentials);
        if (!$token) return response()->json(['message' => 'Incorrect email or password'], HttpCode::HTTP_UNAUTHORIZED);
        // returning token to user if login was successful
        return response()->json(['message' => 'Login Successful', 'token' => $token, 'type' => 'bearer'], HttpCode::HTTP_OK);

    }

    public function register(Request $request)
    {
        // check for validation errors from request before creating user
        $validate = UserRequest::validateRegisterRequest($request->toArray());
        if ($validate) return response()->json([$validate], HttpCode::HTTP_BAD_REQUEST);
        // create user if there are no validation errors
        $user = User::create(['name' => $request['name'], 'email' => $request['email'], 'password' => Hash::make($request['password'])]);
        // creating token for user to use in other operations for authentication and returning token to user
        $token = Auth::login($user);
        return response()->json(['message' => 'User created successfully', 'token' => $token, 'type' => 'bearer'], HttpCode::HTTP_CREATED);
    }


}
