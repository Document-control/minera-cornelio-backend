<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $appends = [
        'type_name',
        'status_name'
    ];

    protected $hidden = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function ope_requi_ope_type()
    {
        return $this->belongsTo(OpeRequiOpeType::class);
    }

    public function status()
    {
        return $this->belongsTo(ContractStatus::class, 'status_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo(ContractType::class, 'type_id', 'id');
    }

    public function getTypeNameAttribute()
    {
        return ContractType::where('id', $this->type_id)->first()->description;
    }

    public function getStatusNameAttribute()
    {
        return ContractStatus::where('id', $this->status_id)->first()->name;
    }
}
