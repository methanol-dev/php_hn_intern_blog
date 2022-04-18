<?php

namespace App\Repositories\User;

use App\Models\Role;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    //Get model
    public function getModel()
    {
        return User::class;
    }

    public function getUserIsAdmin()
    {
        $users = $this->model->where('role_id', Role::IS_ADMIN)->get();

        return $users;
    }
}
