<?php

namespace App\Repositories\Home;

use App\Models\Post;
use App\Repositories\BaseRepository;
use Psy\Command\ListCommand\FunctionEnumerator;

class HomeRepository extends BaseRepository implements HomeRepositoryInterface
{
    //Get model
    public function getModel()
    {
        return Post::class;
    }

    public function getPost()
    {
        $posts = $this->model->where('status', Post::APPROVED)
            ->orderByDesc('created_at')
            ->paginate(config('constants.pagination'));

        return $posts;
    }
}
