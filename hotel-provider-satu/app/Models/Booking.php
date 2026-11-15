<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $fillable = [
        'room_id',
        'customer_name',
        'source',
        'check_in',
        'check_out',
        'status',
    ];

    // Relasi ke model Room
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
