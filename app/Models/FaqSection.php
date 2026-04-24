<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class FaqSection extends Model
{
        use HasFactory;

    protected $fillable = ['title', 'subtitle', 'description'];

    public function details()
    {
        return $this->hasMany(FaqDetail::class, 'faq_section_id');
    }

}
