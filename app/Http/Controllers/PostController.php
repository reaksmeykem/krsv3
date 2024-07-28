<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class PostController extends Controller
{
    public function index(){
        $posts = Post::latest()->get();
        return view('dashboard.post.index', compact('posts'));
    }

    public function create(){
        $categories = Category::get();
        // $tags = Tag::get();
        return view('dashboard.post.create', ['categories' => $categories]);
    }

    public function store(Request $request){
        dd($request->thumbnail);
    }

    public function edit($id){
        $post = Post::findOrFail($id);
        return view('dashboard.post.edit', ['post' => $post]);
    }
}
