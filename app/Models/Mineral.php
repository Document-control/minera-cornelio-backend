<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mineral extends Model
{
    use HasFactory;

    public function business_types()
    {
        return $this->belongsToMany(BusinessType::class);
    }
    public function business_mineral()
    {
        return $this->hasMany(BusinessMineral::class);
    }
}
