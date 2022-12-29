<?php

namespace App\Models;

use COM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocSecondary extends Model
{
    use HasFactory;

    protected $table = "doc_secondaries";

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
    public function history()
    {
        return $this->hasMany(HistoryDocSeconday::class, 'doc_secondary_id', 'id');
    }
    public function contracts()
    {
        return $this->belongsToMany(Contract::class, 'history_doc_secondaries', 'doc_secondary_id', 'contract_id');
    }
}
