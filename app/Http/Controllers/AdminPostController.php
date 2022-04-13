<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdatePostRequest;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderByDesc('created_at')->with('user')->paginate(config('constants.pagination'));

        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        Post::create([
            'title' => $request->title,
            'user_id' => Auth::id(),
            'slug' => $slug,
            'images' => $imageName,
            'content' => $request->content,
            'status' => Post::APPROVED,
        ]);

        return redirect()->route('admin.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('admin.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        return redirect()->route('admin.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        return redirect()->route('admin.post.index');
    }

    public function approval()
    {
        $posts = Post::where('status', Post::PENDING)
            ->orderByDesc('created_at')
            ->paginate(config('constants.pagination'));

        return view('admin.post.approval', compact('posts'));
    }

    public function eidtApproval($id)
    {
        $post = Post::findOrFail($id);

        return view('admin.post.edit_approval', compact('post'));
    }

    public function updateApproval(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->status = $request->status;
        $post->save();

        return redirect()->route('admin.post.approval');
    }

    public function statistics()
    {
        $year = Carbon::now()->year;
        $posts = Post::where('created_at', 'like', "%" . $year . "%")->get();

        $dates = $posts->map(function ($post, $index) {
            return $post->created_at->format('M');
        });

        $initChart = config('constants.init_chart');

        $results = json_encode(array_merge($initChart, array_count_values($dates->toArray())));

        return view('admin.post.post_statistics', compact('results'));
    }
}
