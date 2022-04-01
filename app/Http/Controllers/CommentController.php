<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreReplyRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

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

    public function update(UpdateCommentRequest $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->content = $request->content;
        $comment->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        try {
            DB::beginTransaction();

            $comment->getChilComment()->delete();
            $comment->delete();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            throw $th;
        }

        return response()->json([
            'status' => 200,
        ]);
    }

    public function destroyReply($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json([
            'status' => 200,
        ]);
    }
}
