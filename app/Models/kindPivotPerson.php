<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kindPivotPerson extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'kind_person_id',
        'created_by',
        'updated_by'
    ];

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }
    public function kind_person()
    {
        return $this->belongsTo(Person::class, 'kind_person_id', 'id');
    }
}
