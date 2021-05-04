<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user' => function ($query) {
            $query->select('id','name')->get('name');
        }])->withCount('comments')->simplePaginate(10);
        return view('welcome', compact('posts'));
    }

    public function about()
    {
        return view('about');
    }

}
