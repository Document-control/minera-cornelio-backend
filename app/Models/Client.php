<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'ruc',
        'social_reason',
        'commercial_name',
        'code',
        'is_harvester',
        'note',
        'status_id',
        'created_by',
        'updated_by',
    ];

    public function people()
    {
        return $this->hasMany(Person::class, 'client_id');
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function status()
    {
        return $this->belongsTo(ClientStatus::class, 'status_id', 'id');
    }

    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    public function business_types()
    {
        return $this->belongsToMany(BusinessType::class, 'business_clients', 'client_id', 'business_type_id');
    }

    public function business_clients()
    {
        return $this->hasMany(BusinessClient::class, 'client_id', 'id');
    }

    public function document_clients()
    {
        return $this->hasMany(DocumentClient::class, 'client_id');
    }

    public function documents()
    {
        return $this->belongsToMany(Document::class, 'document_clients');
    }
}
