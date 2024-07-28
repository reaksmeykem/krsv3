<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class ArticleController extends Controller
{
    public function detail($categorySlug, $slug){
        $category = Category::where('slug', $categorySlug)->first();
        $post = Post::where('category_id', $category->id)->where('slug', $slug)->first();

        // about me
        if($post->id == 15){
            return view('about-me', ['post' => $post]);
        }

        if($post){
            return view('article-detail', ['post' => $post]);
        }else{
            return view('error404');
        }


    }
}
