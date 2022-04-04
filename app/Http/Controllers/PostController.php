<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $posts = User::find($user_id)->posts()->orderByDesc('created_at')->paginate(config('constants.pagination'));

        return view('update_ui.post.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        $comments = Post::findOrFail($id)
            ->comments()
            ->where('parent_id', null)
            ->with('user', 'getChilComment')
            ->orderBy('comments.created_at', 'DESC')
            ->simplePaginate(config('constants.simple_pagi'));

        return view('update_ui.post.show', compact('post', 'comments'));
    }

    public function create()
    {
        return view('update_ui.post.create');
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

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('update_ui.post.update', compact('post'));
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $slug = Str::slug($request->title, '-');
        if (isset($request->images)) {
            $images = $request->images;
            $imageName = $slug . '-' . uniqid() . Carbon::now()->timestamp . '.'
                . $images->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('post')) {
                Storage::disk('public')->makeDirectory('post');
            }

            if (Storage::disk('public')->exists('post/' . $post->images)) {
                Storage::disk('public')->delete('post/' . $post->images);
            }

            $postImage = Image::make($images->getRealPath())->resize(752, 353, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->stream();

            Storage::disk('public')->put('post/' . $imageName, $postImage);
        } else {
            $imageName = $post->images;
        }
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->images = $imageName;
        $post->content = $request->content;
        $post->save();

        return redirect()->route('post.index');
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        try {
            DB::beginTransaction();

            if (Storage::disk('public')->exists('post/' . $post->images)) {
                Storage::disk('public')->delete('post/' . $post->images);
            }
            $post->comments()->delete();
            $post->delete();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            throw $th;
        }

        return redirect()->route('post.index');
    }
}
