<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class FaqDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'faq_section_id',
        'question',
        'answer'
    ];

    public function section()
    {
        return $this->belongsTo(FaqSection::class, 'faq_section_id');
    }

}
