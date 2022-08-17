<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessType extends Model
{
    use HasFactory;

    public function minerals()
    {
        return $this->belongsToMany(Mineral::class);
    }
    public function clients()
    {
        return $this->hasMany(Client::class);
    }
    public function business_mineral()
    {
        return $this->hasMany(BusinessMineral::class);
    }
}
