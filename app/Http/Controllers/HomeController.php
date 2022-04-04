<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::where('status', Post::APPROVED)
            ->orderByDesc('created_at')
            ->paginate(config('constants.pagination'));

        return view('update_ui.index', compact('posts'));
    }
}
