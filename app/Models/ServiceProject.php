<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceProject extends Model
{
        protected $fillable = [
        'title',
        'description',
        'thumbnail',
        'image_gallery',
        'is_feature',
        'show_on_home',
        'service_id',
    ];
        public function service()
    {
        return $this->belongsTo(Service::class);
    }


}
