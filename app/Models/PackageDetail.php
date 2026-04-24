<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageDetail extends Model
{
        use SoftDeletes;

    protected $fillable = [
        'package_id', 'title', 'status', 'order_no'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

}
