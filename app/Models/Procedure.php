<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{

    protected $fillable = [
        'page_id',
        'image',
        'title',
        'subtitle',
        'description',
        'order_no',
        'status',
    ];


    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
