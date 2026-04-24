<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoBlock extends Model
{
        public function features()
    {
        return $this->hasMany(InfoBlockFeature::class);
    }

}
