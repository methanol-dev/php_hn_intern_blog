<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Http\Requests\StorePostRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $posts = User::find($user_id)->posts()->paginate(config('constants.pagination'));

        return view('user.post.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        $comments = Post::findOrFail($id)
            ->comments()
            ->with('user', 'getChilComment')
            ->orderBy('comments.created_at', 'DESC')
            ->simplePaginate(config('constants.simple_pagi'));

        return view('user.post.show_post', compact('post', 'comments'));
    }

    public function create()
    {
        return view('user.post.create_post');
    }

    public function store(StorePostRequest $request)
    {
        $slug = Str::slug($request->title, '-');
        $images = $request->images;
        $imageName = $slug . '-' . uniqid() . Carbon::now()->timestamp . '.' . $images->getClientOriginalExtension();

        if (!Storage::disk('public')->exists('post')) {
            Storage::disk('public')->makeDirectory('post');
        }

        // image Croped
        $img = Image::make($images->getRealPath())->resize(752, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->stream();

        Storage::disk('public')->put('post/' . $imageName, $img);

        $post = new Post();
        $post->title = $request->title;
        $post->user_id = Auth::id();
        $post->slug = $slug;
        $post->images = $imageName;
        $post->content = $request->content;
        $post->status = Post::PENDING;
        $post->save();

        return redirect()->route('home');
    }
}
