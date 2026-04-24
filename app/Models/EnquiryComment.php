<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnquiryComment extends Model
{
    use HasFactory;

    public function enquiry()
    {
        return $this->belongsTo(Enquiry::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
