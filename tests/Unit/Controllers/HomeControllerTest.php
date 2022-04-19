<?php

namespace Tests\Unit\Controllers;

use Mockery as m;
use Tests\TestCase;
use App\Models\Post;
use Illuminate\View\View;
use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Testing\WithFaker;
use App\Repositories\Home\HomeRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeControllerTest extends TestCase
{
    protected $homeRepo;
    protected $homeController;

    public function setup(): void
    {
        parent::setUp();
        $this->homeRepo = m::mock(HomeRepositoryInterface::class)->makePartial();
        $this->homeController = new HomeController($this->homeRepo);
    }

    /**
     * This method is called after each test.
     */
    public function tearDown(): void
    {
        unset($this->homeRepo);
        unset($this->homeController);
        m::close();
        parent::tearDown();
    }

    public function testMethodIndex()
    {
        $post = new Post();
        $posts = collect()->push($post);
        
        $this->homeRepo->shouldReceive('getPost')->andReturn($posts);

        $view = $this->homeController->index();

        $this->assertInstanceOf(View::class, $view);
        $this->assertEquals('update_ui.index', $view->getName());
    }
}
