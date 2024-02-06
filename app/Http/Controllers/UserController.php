<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllPostRecord(){
        $posts = Post::with('category')->get()->where('status', 1)->sortByDesc('created_at');
        $categories = Category::all()->where('status', 1)->sortByDesc('created_at');
        return view('pages.index', compact('posts', 'categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function getSinglePostRecord(string $slug)
    {
        $post = Post::with('category')->get()->where('slug', $slug)->first();
        return view('pages.singlePost', compact('post'));
        //return $post;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function getFilterCategoryPost(string $category_slug)
    {
        $posts = Category::with('post')->where('slug', $category_slug)->where('status', 1)->orderBy('created_at','desc')->get();
        //$posts = Post::with('category')->where('id', $category_id)->where('status', 1)->orderBy('created_at','desc')->get();
        return view('pages.filterByCategory', compact('posts'));
        //return $posts;
        //return $category;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
