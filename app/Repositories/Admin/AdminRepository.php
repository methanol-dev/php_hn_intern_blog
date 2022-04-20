<?php

namespace App\Repositories\Admin;

use App\Models\User;
use App\Repositories\BaseRepository;
use Psy\Command\ListCommand\FunctionEnumerator;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{
    //Get model
    public function getModel()
    {
        return User::class;
    }

    public function getUser()
    {
        $users = User::orderByDesc('created_at')->paginate(config('constants.pagination'));

        return $users;
    }

    public function updateUserStatus($id, $status)
    {
        try {
            $user = $this->findOrFail($id);
            $user->status = $status;
            $user->save();
        } catch (\Throwable $th) {
            return false;
        }

        return $user;
    }
}
