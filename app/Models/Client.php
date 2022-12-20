<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // const NATURAL = 1;
    // const COMPANY = 2;
    // const HARVESTER = 3; // ACOPIADOR

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function business_type()
    {
        return $this->belongsTo(BusinessType::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function status()
    {
        return $this->belongsTo(ClientStatus::class, 'status_id', 'id');
    }
}
