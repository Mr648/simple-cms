<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $posts = $user->posts()->with('comments')->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->check($request);
        $post = new Post([
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'excerpt' => $request->input('excerpt'),
            'content' => $request->input('content'),
            'image_path' => $this->storeImage($request),
        ]);

        auth()->user()->posts()->save($post);
        return redirect()->back()->with(['success' => [
            'message' => 'Post created successfully',
            'link' => route('posts.show', $post->slug),
        ]]);
    }

    /**
     *
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Post $post)
    {
        $post->load(['comments', 'user']);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     */
    public function update(Request $request, Post $post)
    {
        $this->check($request);
        if ($request->hasFile('image') && File::exists($post->image)) {
            File::delete($post->image);
        }
        $post->update([
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'excerpt' => $request->input('excerpt'),
            'content' => $request->input('content'),
            'image_path' => $this->storeImage($request),
        ]);
        return redirect()->back()->with(['success' => [
            'message' => 'Post Updated successfully',
            'link' => route('posts.show', $post->slug),
        ]]);
    }

    /**
     * @param Post $post
     */
    public function destroy(Post $post)
    {
        if (auth()->user()->hasPost($post->slug)) {
            if (File::exists($post->image)) {
                File::delete($post->image);
            }
            $post->delete();
            return redirect(route('posts.index'));
        }
        abort(403);
    }


    /**
     *
     * Validation rules to be checked on post creation or updates.
     *
     * @param Request $request
     *
     */
    public function check(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:45',
            'slug' => 'required|string|max:20',
            'excerpt' => 'required|string|max:250',
            'content' => 'required|string|max:2000',
            'image' => 'image|mimes:jpeg,png,jpg',
        ]);
    }

    /**
     * If request contains image file for post, it will be stored.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\File\File|null
     */
    public function storeImage(Request $request)
    {
        $path = null;
        if ($request->hasFile('image')) {
            $extension = '.' . $request->image->extension();
            $path = $request->file('image')->move('images', md5(now() . '_img') . $extension);
        }
        return $path;
    }
}
