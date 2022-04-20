<?php

namespace App\Repositories\Home;

use App\Repositories\RepositoryInterface;

interface HomeRepositoryInterface extends RepositoryInterface
{
    // Get post for home page with status post = APPROVED
    public function getPost();
}
