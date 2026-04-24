<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceElementFeature extends Model
{
    protected $fillable = [
        'service_element_id',
        'title',
        'description',
        'order_no',
    ];

    public function serviceElement()
    {
        return $this->belongsTo(ServiceElement::class, 'service_element_id');
    }
}
