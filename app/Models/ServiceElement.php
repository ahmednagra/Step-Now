<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceElement extends Model
{
    protected $fillable = [
        'service_id',
        'title',
        'subtitle',
        'description',
        'image',
        'icon',
    ];

    public function features()
    {
        return $this->hasMany(ServiceElementFeature::class, 'service_element_id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
