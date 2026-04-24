<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceFeature extends Model
{

    protected $fillable = [
        'service_id',
        'title',
        'subtitle',
        'description',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function details()
    {
        return $this->hasMany(ServiceFeatureDetail::class, 'service_feature_id');
    }
}
