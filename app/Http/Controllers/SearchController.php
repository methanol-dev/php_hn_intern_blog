<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SearchRequest;

class SearchController extends Controller
{
    public function search(SearchRequest $request)
    {
        $input = $request->search;
        $results = DB::table('users')
            ->join('posts', 'users.id', '=', 'posts.user_id')
            ->select('users.*', 'posts.*')
            ->where('users.first_name', 'like', "%$input%")
            ->orWhere('users.last_name', 'like', "%$input%")
            ->orWhere('posts.title', 'like', "%$input%")
            ->orderByDesc('posts.created_at')
            ->paginate(config('constants.pagination'));

        foreach ($results->items() as $result) {
            $result->full_name = $result->first_name . ' ' . $result->last_name;
        }

        return view('user.search', compact('results', 'input'));
    }
}
