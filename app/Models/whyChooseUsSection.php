<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyChooseUsSection extends Model
{
    public function details()
    {
        return $this->hasMany(WhyChooseUsSectionDetail::class);
    }

}
