<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreReplyRequest;
use App\Http\Requests\StoreCommentRequest;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, $post_id)
    {
        Comment::create([
            'post_id' => $post_id,
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return redirect()->route('post.show', ['id' => $post_id]);
    }

    public function storeReply(StoreReplyRequest $request, $post_id, $paren_id)
    {
        Comment::create([
            'post_id' => $post_id,
            'user_id' => Auth::id(),
            'parent_id' => $paren_id,
            'content' => $request->content,
        ]);

        return redirect()->route('post.show', ['id' => $post_id]);
    }
}
