<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessType extends Model
{
    use HasFactory;

    protected $table = "business_types";

    protected $fillable = [
        'name',
        'code',
        'many_minerals',
        'created_by',
        'updated_by'
    ];

    public function minerals()
    {
        return $this->belongsToMany(Mineral::class);
    }

    public function business_clients()
    {
        return $this->hasMany(BusinessClient::class, 'business_type_id', 'id');
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'business_clients', 'business_type_id', 'client_id');
    }
}
