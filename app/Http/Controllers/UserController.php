<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('status', Post::APPROVED)
            ->orderByDesc('created_at')
            ->paginate(config('constants.pagination'));

        return view('user.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showProfile()
    {
        return view('update_ui.profile');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        if ($request->avatar != null) {
            //image
            $avatar = $request->avatar;
            $avatarName = Auth::user()->username . uniqid() . '.' . $avatar->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('user')) {
                Storage::disk('public')->makeDirectory('user');
            }
            //delete old image
            $avatarDefault = config('constants.avatar');
            if ($user->avatar !== $avatarDefault && Storage::disk('public')->exists('user/' . $user->avatar)) {
                Storage::disk('public')->delete('user/' . $user->avatar);
            }
            $avatarImg = Image::make($avatar)->fit(200, 200)->stream();
            Storage::disk('public')->put('user/' . $avatarName, $avatarImg);
        } else {
            $avatarName = $user->avatar;
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->avatar = $avatarName;
        $user->save();

        return redirect()->back();
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $oldPassword = Auth::user()->password;
        if (Hash::check($request->old_password, $oldPassword)) {
            if (!Hash::check($request->password, $oldPassword)) {
                $user =  Auth::user();
                $user->password = Hash::make($request->password);
                $user->save();
                Auth::logout();

                return redirect()->route('home');
            } else {
                return redirect()->route('profile');
            }
        } else {
            return redirect()->back();
        }
    }
}
