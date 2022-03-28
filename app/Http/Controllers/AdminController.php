<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::orderByDesc('created_at')->paginate(config('constants.pagination'));

        return view('admin.user.index', compact('users'));
    }
}
