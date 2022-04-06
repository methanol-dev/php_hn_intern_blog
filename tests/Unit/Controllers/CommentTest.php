<?php

namespace Tests\Unit\Controllers;

use Exception;
use Mockery as m;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreReplyRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Controllers\CommentController;
use App\Http\Requests\UpdateCommentRequest;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\Comment\CommentRepositoryInterface;

class CommentTest extends TestCase
{
    protected $commentRepo;
    protected $commentController;

    public function setup(): void
    {
        parent::setUp();
        $this->commentRepo = m::mock(CommentRepositoryInterface::class)->makePartial();
        $this->commentController = new CommentController($this->commentRepo);
    }

    /**
     * This method is called after each test.
     */
    public function tearDown(): void
    {
        unset($this->commentRepo);
        unset($this->commentController);
        m::close();
        parent::tearDown();
    }

    public function testMethodStore()
    {
        $post_id = rand();
        $comment = m::mock(Comment::class)->makePartial();
        $comment->id = rand();
        $comment->post_id = $post_id;
        $data = [
            'content' => str_random(20),
        ];

        $request = new StoreCommentRequest($data);

        $this->commentRepo->shouldReceive('createComment')->andReturn($comment);
        $response = $this->commentController->store($request, $post_id);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals($response->getTargetUrl(), route('post.show', ['id' => $post_id]));
    }

    public function testMethodStoreReply()
    {
        $post_id = rand();
        $parent_id = rand();
        $comment = m::mock(Comment::class)->makePartial();
        $comment->id = rand();
        $comment->post_id = $post_id;
        $comment->parent_id = $parent_id;

        $data = [
            'content' => str_random(20),
        ];

        $request = new StoreReplyRequest($data);

        $this->commentRepo->shouldReceive('createReplyComment')->andReturn($comment);
        $response = $this->commentController->storeReply($request, $post_id, $parent_id);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals($response->getTargetUrl(), route('post.show', ['id' => $post_id]));
    }

    public function testMethodUpdate()
    {
        $post_id = rand();
        $comment = m::mock(Comment::class)->makePartial();
        $comment->id = rand();
        $comment->post_id = $post_id;

        $data = [
            'content' => str_random(20),
        ];

        $url = request()->url();
        $request = new UpdateCommentRequest($data);

        $this->commentRepo->shouldReceive('update')->andReturn($comment);
        $response = $this->commentController->update($request, $post_id);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals($response->getTargetUrl(), $url);
    }

    public function testMethodDestroy()
    {
        $post_id = rand();
        $comment = m::mock(Comment::class)->makePartial();
        $comment->id = rand();
        $comment->post_id = $post_id;

        DB::shouldReceive('beginTransaction')->andReturnTrue();
        $this->commentRepo->shouldReceive('deleteReply')->with($comment->id)->andReturn(true);
        $this->commentRepo->shouldReceive('delete')->with($comment->id)->andReturn(true);
        DB::shouldReceive('commit')->andReturnTrue();

        $response = $this->commentController->destroy($comment->id);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($response->status(), 200);
        $this->assertEquals($response->getData()->status, 200);
    }

    public function testMethodDestroyFail()
    {
        $exception = new Exception();

        $post_id = rand();
        $comment = m::mock(Comment::class)->makePartial();
        $comment->id = rand();
        $comment->post_id = $post_id;

        $this->commentRepo->shouldReceive('deleteReply')->with($comment->id)->andThrow($exception);
        $this->commentRepo->shouldReceive('delete')->with($comment->id)->andThrow($exception);
        $response = $this->commentController->destroy($comment->id);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($response->status(), 500);
        $this->assertEquals($response->getData()->status, 500);
    }

    public function testDeleteReply()
    {
        $post_id = rand();
        $comment = m::mock(Comment::class)->makePartial();
        $comment->id = rand();
        $comment->post_id = $post_id;

        $this->commentRepo->shouldReceive('delete')->with($comment->id)->andReturn(true);
        $response = $this->commentController->destroyReply($comment->id);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($response->status(), 200);
        $this->assertEquals($response->getData()->status, 200);
    }
}
