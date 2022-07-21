<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Validator;


class BookingRequest
{
    public static function validateBookingRequest(array $request)
    {
        $validator = Validator::make($request, [
            'start_point' => 'required|string|in:Cairo,Fayum,Minya,Alexandria,Tanta,Luxor,Ismailia,Asyut,Qina,Giza',
            'end_point' => 'required|string|in:Cairo,Fayum,Minya,Alexandria,Tanta,Luxor,Ismailia,Asyut,Qina,Giza',
        ]);
        if ($validator->fails()) return $validator->errors();

        return false;
    }

}
