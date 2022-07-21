<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $table = 'busses';

    protected $fillable = [
        'start_point',
        'end_point'
    ];

    // defining relations for this model


    public function trips()
    {
        return $this->hasMany(Trip::class, 'bus_id');
    }

    public function seats()
    {
        return $this->hasMany(Seat::class, 'bus_id');
    }
}
