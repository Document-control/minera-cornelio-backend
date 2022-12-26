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

    protected $fillable = [
        'ruc',
        'code',
        'is_harvester',
        'note',
        'status_id',
        'person_id',
        'company_id',
        'created_by',
        'updated_by',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function status()
    {
        return $this->belongsTo(ClientStatus::class, 'status_id', 'id');
    }

    public function business_types()
    {
        return $this->belongsToMany(BusinessType::class, 'business_clients', 'client_id', 'business_type_id');
    }

    public function business_clients()
    {
        return $this->hasMany(BusinessClient::class, 'client_id', 'id');
    }
}
