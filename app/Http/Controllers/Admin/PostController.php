<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category')->orderby("id", "desc")->get();
        $categories = Category::all();
        return view("admin.post", compact("posts", "categories"));
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
        //dd($request->all());
        $request->validate([
            "title" => "required|string",
            "description" => "required|string",
            "category_id" => "required"
        ]);
        $slug = Str::slug($request->title);
        $data = [
            "title" => $request->title,
            "slug" => $slug,
            "description" => $request->description,
            "category_id" => $request->category_id,
            "status" => $request->status,
        ];
        if ($request->hasFile('thumbnail'))
        {
            $file = $request->thumbnail;
            $extension = $file->getClientOriginalExtension();
            $fileName = 'post'.'-'.time().'.'.$extension;
            //$file->move('uploads/post/', $fileName);

            // Image Resize
            $manager = new ImageManager(new Driver());
            $thumbnail = $manager->read($file);
            $thumbnail->resize(600,360)->save(public_path('uploads/post/'.$fileName));

            $data['thumbnail'] = $fileName;
        }
        Post::create($data);
        $notify = [
            'message' => 'Post created successfully!',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notify);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);
        if ($post->slug == $request->slug){
            $request->validate([
                "title" => "required|string",
                "slug" => "required|string",
                "description" => "required|string",
                "category_id" => "required"
            ]);
        }else{
            $request->validate([
                "title" => "required|string",
                "slug" => "required|string|unique:posts",
                "description" => "required|string",
                "category_id" => "required"
            ]);
        }
        $slug = Str::slug($request->slug);
        $data = [
            "title" => $request->title,
            "slug" => $slug,
            "description" => $request->description,
            "category_id" => $request->category_id,
            "status" => $request->status,
        ];
        if ($request->hasFile('thumbnail'))
        {
            if ($request->old_thumbnail){
                File::delete(public_path('uploads/post/'.$request->old_thumbnail));
            }
            $file = $request->thumbnail;
            $extension = $file->getClientOriginalExtension();
            $fileName = 'post'.'-'.time().'.'.$extension;
            // $file->move('uploads/post/', $fileName);
            // Image Resize
            $manager = new ImageManager(new Driver());
            $thumbnail = $manager->read($file);
            $thumbnail->resize(600,360)->save(public_path('uploads/post/'.$fileName));
            $data['thumbnail'] = $fileName;
        }
        $post->update($data);
        $notify = [
            'message' => 'Post updated successfully!',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notify);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        if($post->thumbnail){
            File::delete(public_path('uploads/post/'.$post->thumbnail));
        }
        $post->delete();

        $notify = [
            'message' => 'Post deleted successfully!',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notify);
    }
}
