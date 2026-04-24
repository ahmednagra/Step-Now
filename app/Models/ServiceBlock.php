<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceBlock extends Model
{
    protected $fillable = [
        'service_id',
        'title',
        'subtitle',
        'description',
        'type',
        'image',
        'icon',
    ];

    public function features()
    {
        return $this->hasMany(ServiceBlockFeature::class, 'service_block_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
