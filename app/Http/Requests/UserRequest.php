<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Validator;


class UserRequest
{
    public static function validateRegisterRequest(array $request)
    {
        $validator = Validator::make($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) return $validator->errors();

        return false;
    }

    public static function validateLoginRequest(array $request)
    {
        $validator = Validator::make($request, [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) return $validator->errors();

        return false;
    }
}
