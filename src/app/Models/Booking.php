<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
     protected $fillable = [
        'booking_time',
        'client_name',
        'egn',
        'description',
        'notification_method',
    ];
}
