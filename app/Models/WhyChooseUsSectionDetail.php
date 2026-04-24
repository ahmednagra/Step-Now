<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WhyChooseUsSectionDetail extends Model
{
            use HasFactory;

    protected $fillable = [
        'why_choose_us_section_id',
        'title',
        'icon',
        'description'
    ];

        public function section()
    {
        return $this->belongsTo(WhyChooseUsSection::class, 'why_choose_us_section_id');
    }

}
