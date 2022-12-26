<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'direction',
        'department',
        'district',
        'province',
        'reference',
        'main',
        'created_by',
        'updated_by'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function person()
    {
        return $this->hasOne(Person::class, 'address_id', 'id');
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'address_id', 'id');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'address_id', 'id');
    }
}
