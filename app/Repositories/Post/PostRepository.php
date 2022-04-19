<?php

namespace App\Repositories\Post;

use App\Models\Post;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    //Get model
    public function getModel()
    {
        return Post::class;
    }

    public function getPostPending()
    {
        $posts = $this->model->where('status', Post::PENDING)->count();

        return $posts;
    }
}
