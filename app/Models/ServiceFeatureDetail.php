<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceFeatureDetail extends Model
{
    protected $fillable = [
        'service_feature_id',
        'title',
        'description',
        'image',
    ];

    public function serviceFeature()
    {
        return $this->belongsTo(ServiceFeature::class, 'service_feature_id');
    }
}
