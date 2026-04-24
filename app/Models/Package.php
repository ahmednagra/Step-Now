<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'destination', 'subtitle', 'icon', 'amount','discount_percentage', 'discounted_amount',
        'status', 'publish', 'order_no','package_category_id',
    ];
        public function details()
    {
        return $this->hasMany(PackageDetail::class)->orderBy('order_no');
    }

    public function packageCategory()
    {
        return $this->belongsTo(PackageCategory::class);
    }

}
