<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bookings';

    protected $fillable = [
        'offer_id',
        'full_name',
        'email',
        'phone',
        'pickup',
        'booking_date',
        'booking_time',
        'no_of_people',
        'message',
        'status',
        'admin_remarks',
    ];

    protected $dates = ['deleted_at'];
}
