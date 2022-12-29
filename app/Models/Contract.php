<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

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
}
