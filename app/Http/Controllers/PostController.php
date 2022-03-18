<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($id)
    {
        return view('user.post.post');
    }

    public function create()
    {
        return view('user.post.create_post');
    }
}
