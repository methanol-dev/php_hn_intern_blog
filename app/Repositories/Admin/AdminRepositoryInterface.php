<?php

namespace App\Repositories\Admin;

use App\Repositories\RepositoryInterface;

interface AdminRepositoryInterface extends RepositoryInterface
{
    public function getUser();

    // Update status of user
    public function updateUserStatus($id, $status);
}
