<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KindPerson extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'spanish_name',
        'created_by',
        'updated_by'
    ];

    public function kind_pivot_people()
    {
        return $this->hasMany(kindPivotPerson::class, 'kind_person_id', 'id');
    }
    public function people()
    {
        return $this->belongsToMany(Person::class, 'kind_pivot_people', 'kind_person_id', 'person_id');
    }
}
