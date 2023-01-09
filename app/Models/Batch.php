<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'qty',
        'price',
        'total_prov',
    ];

    public function minerals()
    {
        return $this->belongsToMany(Mineral::class, 'mineral_id', 'batch_id');
    }
}
