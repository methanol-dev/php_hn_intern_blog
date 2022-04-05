<?php

namespace App\Repositories\Comment;

use App\Repositories\RepositoryInterface;

interface CommentRepositoryInterface extends RepositoryInterface
{
    //Create new comment
    public function createComment(array $attributes, int $post_id);

    //Create new reply comment
    public function createReplyComment(array $attributes, int $post_id, int $parent_id);

    //Delete reply of comment
    public function deleteReply(int $id);
}
