<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buninessMineral extends Model
{
    use HasFactory;

    public function business_type()
    {
        $this->belongsTo(BusinessType::class);
    }
    public function mineral()
    {
        $this->belongsTo(Mineral::class);
    }
}
