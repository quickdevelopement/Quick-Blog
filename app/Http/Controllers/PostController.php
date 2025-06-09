<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category')->latest()->paginate(5);
    //    $posts = Post::latest()->get();
        return view('index', ['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $categories = Category::all();
       return view('posts.create', ['categories'=>$categories]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
        'title'=> 'required',
        'content'=> 'required',
        'category_id'=> 'nullable|exists:categories,id'
       ]);

       $image = null;
       if(isset($request->image)){
        $request->validate([
            'image'=> 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = time().'_'.$request->image->getClientOriginalName();
        $request->image->move(public_path('images'), $image);
       };

       $post = new Post();
       $post->title = $request->title;
       $post->content = $request->content;
       $post->image = $image;
       $post->category_id = $request->category_id;
       $post->user_id = Auth::user()->id;

       $post->save();

       flash()->success('Post Created Successfylly');
       return redirect()->route('dashboard.posts');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $user = User:: findOrFail($post->user_id);
        $post->user = $user;

        $post->load('comments', 'category');
        return view('postDetails', ['post'=>$post]);
        }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       $post = Post::findOrFail($id);
       $categories = Category::all();

       return view('posts.create', ['post'=> $post, 'categories'=>$categories]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
        'title'=> 'required',
        'content'=> 'required',
        'category_id'=> 'nullable|exists:categories,id'
       ]);

       $post = Post::findOrFail($id);


       

       $image = $post->image;


       if(isset($request->image)){
        $request->validate([
            'image'=> 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($post->imge && file_exists(public_path('images/'.$post->image))){
            unlink(public_path('images/'. $post->image));
        }

        $image = time().'_'.$request->image->getClientOriginalName();
        $request->image->move(public_path('images'), $image);
        
       };

       $post->title = $request->title;
       $post->content = $request->content;
       $post->image = $image;
       $post->category_id = $request->category_id;

       $post->save();

       flash()->success('Post Updated Successfylly');
       return redirect()->route('dashboard.posts');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $post = Post::findOrFail($id);
        if($post->imge && file_exists(public_path('images/'.$post->image))){
            unlink(public_path('images/'. $post->image));
        };

        $post->delete();
        flash()->success('Post Deleted Successfylly');
        return redirect()->route('dashboard.posts');
    }
}
