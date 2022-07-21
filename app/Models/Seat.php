<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $table = 'seats';

    protected $fillable = [
        'bus_id',
        'user_id',
        'booked'
    ];

    // defining relations for this model

    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
