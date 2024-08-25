<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    public function edit($id){
        $post = Post::findOrFail($id);
        return view('dashboard.post.edit', ['post' => $post]);
    }

    public function getPostByCategory($categorySlug){
        $category = Category::where('slug', $categorySlug)->first();
        return view('front.getPostByCategory', ['categorySlug' => $categorySlug]);
    }

    public function postDetail($categorySlug, $postSlug){
        $category = Category::where('slug', $categorySlug)->first();
        $post = Post::where('slug', $postSlug)
            ->where('category_id', $category->id)
            ->with(['category','user'])
            ->first();
        return view('front.postDetail', [
            'post' => $post,
            'category' => $category,
        ]);
    }
}
