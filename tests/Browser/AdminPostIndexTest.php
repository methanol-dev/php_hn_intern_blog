<?php

namespace Tests\Browser;

use App\Models\Post;
use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminPostIndexTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testUIAdminPostIndex()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(5))
                ->visitRoute('admin.post.index')
                ->assertSee(trans('me.posts'))
                ->assertSee(trans('me.users'))
                ->assertSee(trans('me.post_approval'))
                ->assertSee(trans('me.logout'))
                ->assertSee(trans('me.title'))
                ->assertSee(trans('me.author'))
                ->assertSee(trans('me.status'))
                ->assertSee(trans('me.action'));
        });
    }

    public function testClickUsers()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(5))
                ->visitRoute('admin.post.index')
                ->click('.fa-user')
                ->pause(1000)
                ->assertRouteIs('admin.index');
        });
    }

    public function testClickPosts()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(5))
                ->visitRoute('admin.post.index')
                ->click('.fa-bars')
                ->pause(1000)
                ->assertRouteIs('admin.post.index');
        });
    }

    public function testClickPostApproval()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(5))
                ->visitRoute('admin.post.index')
                ->click('.fa-check')
                ->pause(1000)
                ->assertRouteIs('admin.post.approval');
        });
    }

    public function testClickLogout()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(5))
                ->visitRoute('admin.post.index')
                ->click('#logout')
                ->pause(1000)
                ->assertRouteIs('login');
        });
    }

    public function testClickEn()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(5))
                ->visitRoute('admin.post.index')
                ->click('#en')
                ->pause(1000)
                ->assertSee('Users');
        });
    }

    public function testClickVi()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(5))
                ->visitRoute('admin.post.index')
                ->click('#vi')
                ->pause(1000)
                ->assertSee('Người dùng');
        });
    }

    public function testClickIconCreate()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(5))
                ->visitRoute('admin.post.index')
                ->click('.fa-plus')
                ->waitForRoute('admin.post.create', [], 7)
                ->assertRouteIs('admin.post.create');
        });
    }

    public function testClickIconShow()
    {
        $this->browse(function (Browser $browser) {
            $post = Post::orderByDesc('created_at')->first();

            $browser->loginAs(User::find(5))
                ->visitRoute('admin.post.index')
                ->click('#show-' . $post->id)
                ->waitForRoute('admin.post.show', ['id' => $post->id], 7)
                ->assertRouteIs('admin.post.show', ['id' => $post->id]);
        });
    }

    public function testClickIconEdit()
    {
        $this->browse(function (Browser $browser) {
            $post = Post::orderByDesc('created_at')->first();

            $browser->loginAs(User::find(5))
                ->visitRoute('admin.post.index')
                ->click('#edit-' . $post->id)
                ->waitForRoute('admin.post.edit', ['id' => $post->id], 7)
                ->assertRouteIs('admin.post.edit', ['id' => $post->id]);
        });
    }

    public function testClickIconDelete()
    {
        $this->browse(function (Browser $browser) {
            $post = Post::orderByDesc('created_at')->first();

            $browser->loginAs(User::find(5))
                ->visitRoute('admin.post.index')
                ->click('#delete-' . $post->id)
                ->acceptDialog()
                ->assertDontSee($post->title);
        });
    }
}
