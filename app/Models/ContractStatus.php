<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractStatus extends Model
{
    use HasFactory;

    protected $table = "contract_status";

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'status_id', 'id');
    }
}
