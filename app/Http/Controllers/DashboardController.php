<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        $users = User::all();
        $categories = Category::all();
        return view('dashboard.index', ['posts' => $posts, 'users' => $users, 'categories' => $categories]);
    }

    public function ownPost(){
        $posts = Post::where('user_id', auth()->id())->latest()->get();
        return view('posts.index', ['posts'=>$posts]);
    }


}
