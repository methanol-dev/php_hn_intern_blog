<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreReplyRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Repositories\Comment\CommentRepositoryInterface;

class CommentController extends Controller
{
    protected $commentRepo;

    public function __construct(CommentRepositoryInterface $commentRepo)
    {
        $this->commentRepo = $commentRepo;
    }

    public function store(StoreCommentRequest $request, $post_id)
    {
        $data = $request->all();
        $this->commentRepo->createComment($data, $post_id);

        return redirect()->route('post.show', ['id' => $post_id]);
    }

    public function storeReply(StoreReplyRequest $request, $post_id, $paren_id)
    {
        $data = $request->all();
        $this->commentRepo->createReplyComment($data, $post_id, $paren_id);

        return redirect()->route('post.show', ['id' => $post_id]);
    }

    public function update(UpdateCommentRequest $request, $id)
    {
        $data = $request->all();
        $this->commentRepo->update($id, $data);

        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $this->commentRepo->deleteReply($id);
            $this->commentRepo->delete($id);

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
        $this->commentRepo->delete($id);

        return response()->json([
            'status' => 200,
        ]);
    }
}
