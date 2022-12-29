<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'ruc',
        'code',
        'social_reason',
        'commercial_name',
        'address_id',
        'created_by',
        'updated_by',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $with = ['address'];

    public function addresses()
    {
        return $this->belongsTo(Address::class, 'profile_id', 'id');
    }

    public function people()
    {
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }

    public function phones()
    {
        return $this->belongsTo(Phone::class, 'phone_id', 'id');
    }
}
