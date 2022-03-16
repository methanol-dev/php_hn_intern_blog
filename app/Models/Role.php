<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const IS_ADMIN = 1;
    const IS_USER = 2;

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
