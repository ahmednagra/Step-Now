<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSection extends Model
{


    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'type',
        'order_no',
    ];


    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
