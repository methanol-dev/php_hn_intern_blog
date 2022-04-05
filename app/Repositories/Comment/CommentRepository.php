<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    //Get model
    public function getModel()
    {
        return Comment::class;
    }

    //Create new comment
    public function createComment(array $attributes, int $post_id)
    {
        $comment = $this->create($attributes);
        $comment->user_id = Auth::id();
        $comment->post_id = $post_id;
        $comment->save();

        return $comment;
    }

    //Create new reply comment
    public function createReplyComment(array $attributes, int $post_id, int $parent_id)
    {
        $reply = $this->create($attributes);
        $reply->user_id = Auth::id();
        $reply->post_id = $post_id;
        $reply->parent_id = $parent_id;
        $reply->save();

        return $reply;
    }

    public function deleteReply(int $id)
    {
        return $this->findOrFail($id)->getChilComment()->delete();
    }
}
