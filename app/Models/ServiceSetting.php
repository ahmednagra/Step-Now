<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSetting extends Model
{
    protected $fillable = ['service_id', 'reference_id', 'reference_type', 'order_no'];

    public function reference()
    {
        return $this->morphTo();
    }
}
