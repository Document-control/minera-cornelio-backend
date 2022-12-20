<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buninessMineral extends Model
{
    use HasFactory;

    public function business_type()
    {
        return $this->belongsTo(BusinessType::class);
    }
    public function mineral()
    {
        return $this->belongsTo(Mineral::class);
    }
}
