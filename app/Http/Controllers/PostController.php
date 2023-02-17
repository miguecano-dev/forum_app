<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $posts = Post::when($search, function ($query, $search) {
                return $query->where('title', 'like', "%$search%");
            })
            ->with(['user' => function ($query) {
                $query->select('id', 'username');
            }])
            ->latest()
            ->paginate(10);
        return view('post.index',compact('posts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'problem' => 'required',
            'image' => 'image|max:2048'
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public');
        } else {
            $imagePath = null;
        }
    
        $post = Post::create([
            'title' => $validated['title'],
            'problem' => $validated['problem'],
            'image' => $imagePath,
            'user_id' => Auth::id()
        ]);
        
        return redirect('/')->with('status', 'Post created successfully');
    }

    public function show(Post $post)
    {
        $responses = $post->responses()->latest()->paginate(3);
        return view('post.show', compact('post', 'responses'));
    }
}
