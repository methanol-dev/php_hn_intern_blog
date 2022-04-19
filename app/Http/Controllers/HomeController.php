<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Repositories\Home\HomeRepositoryInterface;

class HomeController extends Controller
{
    protected $homeRepo;

    public function __construct(HomeRepositoryInterface $homeRepo)
    {
        $this->homeRepo = $homeRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = $this->homeRepo->getPost();

        return view('update_ui.index', compact('posts'));
    }
}
