<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function role_user()
    {
        return $this->hasMany(RoleUser::class);
    }

    public function permission_user()
    {
        return $this->hasMany(PermissionUser::class);
    }
}
