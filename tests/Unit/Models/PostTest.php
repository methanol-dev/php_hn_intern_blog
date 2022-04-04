<?php

namespace Tests\Unit\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    const PENDING = 1;
    const APPROVED = 2;
    const REJECT = 3;

    protected $post;
    /**
     * This method is called before each test.
     */
    public function setup(): void
    {
        parent::setUp();
        $this->post = new Post();
    }

    /**
     * This method is called after each test.
     */
    public function tearDown(): void
    {
        unset($this->post);
        parent::tearDown();
    }

    public function testPrimaryKey()
    {
        $this->assertEquals('id', $this->post->getKeyName());
    }

    public function testValidFillableProperty()
    {
        $fillable = [
            'title',
            'user_id',
            'slug',
            'images',
            'content',
            'status',
        ];

        $this->assertEquals($fillable, $this->post->getFillable());
    }

    public function testStatusPending()
    {
        $status = static::PENDING;

        $this->post->setRawAttributes([
            'status' => static::PENDING,
        ]);

        $this->assertEquals($status, $this->post->status);
    }

    public function testStatusApproved()
    {
        $status = static::APPROVED;

        $this->post->setRawAttributes([
            'status' => static::APPROVED,
        ]);

        $this->assertEquals($status, $this->post->status);
    }

    public function testStatusReject()
    {
        $status = static::REJECT;

        $this->post->setRawAttributes([
            'status' => static::REJECT,
        ]);

        $this->assertEquals($status, $this->post->status);
    }

    public function testUserRelation()
    {
        $relation = $this->post->user();

        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getOwnerKeyName());
    }

    public function testCommentsRelation()
    {
        $relation = $this->post->comments();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('post_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getLocalKeyName());
    }
}
