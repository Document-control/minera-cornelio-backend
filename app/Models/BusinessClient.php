<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessClient extends Model
{
    use HasFactory;

    protected $table = 'business_clients';

    protected $fillable = [
        'client_id',
        'business_type_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function business_type()
    {
        return $this->belongsTo(BusinessType::class, 'business_type_id', 'id');
    }
}
