<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class TestimonialDetail extends Model
{
        use HasFactory;

    protected $fillable = [
        'testimonial_id',
        'name',
        'image',
        'designation',
        'feedback',
        'rating',
    ];

    // Relationship: Each detail belongs to a testimonial section
    public function testimonial()
    {
        return $this->belongsTo(TestimonialSection::class);
    }
}
