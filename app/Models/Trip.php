<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $table = 'trips';

    protected $fillable = [
        'start_point',
        'end_point',
        'start_point_order',
        'end_point_order',
        'available_seats',
        'bus_id'
    ];

    // defining relations for this model


    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id');
    }

}
