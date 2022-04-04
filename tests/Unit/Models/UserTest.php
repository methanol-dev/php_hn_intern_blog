<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserTest extends TestCase
{
    const BLOCK = 1;
    const UN_BLOCK = 0;

    protected $user;

    /**
     * This method is called before each test.
     */
    public function setup(): void
    {
        parent::setUp();
        $this->user = new User();
    }

    /**
     * This method is called after each test.
     */
    public function tearDown(): void
    {
        unset($this->user);
        parent::tearDown();
    }

    public function testPrimaryKey()
    {
        $this->assertEquals('id', $this->user->getKeyName());
    }

    /**
     * This method test $fillable property
     */
    public function testValidGuardedProperty()
    {
        $guarded = [
            'status',
        ];

        $this->assertEquals($guarded, $this->user->getGuarded());
    }

    /**
     * This method test $hidden property
     */
    public function testValidHiddenProperty()
    {
        $hidden = [
            'password',
            'remember_token',
        ];

        $this->assertEquals($hidden, $this->user->getHidden());
    }

    /**
     * This method test $casts property
     */
    public function testValidCastsProperty()
    {
        $casts = [
            'email_verified_at' => 'datetime',
            'id' => 'int',
        ];

        $this->assertEquals($casts, $this->user->getCasts());
    }

    /**
     * This method test $appends property
     */
    public function testValidAppendsProperty()
    {
        $appends = [
            'full_name',
        ];

        $this->assertEquals($appends, $this->user->appends);
    }

    public function testGetFullNameAttribute()
    {
        $this->user->setRawAttributes([
            'first_name' => 'Trinh',
            'last_name' => 'Xuan Thong',
        ]);

        $this->assertEquals('Trinh Xuan Thong', $this->user->full_name);
    }

    public function testStatusBlock()
    {
        $status = static::BLOCK;

        $this->user->setRawAttributes([
            'status' => static::BLOCK,
        ]);

        $this->assertEquals($status, $this->user->status);
    }

    public function testStatusUnBlock()
    {
        $status = static::UN_BLOCK;

        $this->user->setRawAttributes([
            'status' => static::UN_BLOCK,
        ]);

        $this->assertEquals($status, $this->user->status);
    }

    public function testPostsRelation()
    {
        $relation = $this->user->posts();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getLocalKeyName());
    }

    public function testCommentsRelation()
    {
        $relation = $this->user->comments();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getLocalKeyName());
    }

    public function testRoleRelation()
    {
        $relation = $this->user->role();

        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('role_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getOwnerKeyName());
    }
}
