<?php

namespace Tests\Unit\Controllers;

use Exception;
use Mockery as m;
use Tests\TestCase;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\AdminController;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\Admin\AdminRepositoryInterface;

class AdminControllerTest extends TestCase
{
    protected $adminRepo;
    protected $adminController;
    protected $users;

    public function setup(): void
    {
        parent::setUp();
        $this->adminRepo = m::mock(AdminRepositoryInterface::class)->makePartial();
        $this->adminController = new AdminController($this->adminRepo);
        $this->users = factory(User::class, 10)->make();
    }

    /**
     * This method is called after each test.
     */
    public function tearDown(): void
    {
        unset($this->adminRepo);
        unset($this->adminController);
        unset($this->users);
        m::close();
        parent::tearDown();
    }

    public function testMethodIndex()
    {

        $this->adminRepo->shouldReceive('getUser')->andReturn($this->users);

        $view = $this->adminController->index();

        $this->assertInstanceOf(View::class, $view);
        $this->assertEquals('admin.user.index', $view->getName());
    }

    public function testMethodEdit()
    {
        $user = $this->users->first();
        $user->id = rand();

        $this->adminRepo->shouldReceive('findOrFail')->with($user->id)->andReturn($user);

        $view = $this->adminController->edit($user->id);

        $this->assertInstanceOf(View::class, $view);
        $this->assertEquals('admin.user.update', $view->getName());
    }

    public function testMethodUpdateFail()
    {
        $exception = new Exception();
        $user = $this->users->first();
        $user->id = rand();

        $data = [
            'status' => rand(0, 1),
        ];

        $url = request()->url();
        $request = new UpdateUserRequest($data);

        $this->adminRepo->shouldReceive('updateUserStatus')->with($user->id, $request)->andThrow($exception);

        $response = $this->adminController->update($request, $user->id);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals($response->getTargetUrl(), $url);
    }

    public function testMethodUpdateSuccess()
    {
        $user = $this->users->first();
        $user->id = rand();

        $data = [
            'status' => rand(0, 1),
        ];

        $url = request()->url();
        $request = new UpdateUserRequest($data);

        $this->adminRepo->shouldReceive('updateUserStatus')->andReturn($user);

        $response = $this->adminController->update($request, $user->id);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals($response->getTargetUrl(), $url);
    }
}
