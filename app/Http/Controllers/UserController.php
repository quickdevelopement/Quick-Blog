<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function users(){
        $users = User::latest()->get();
        $posts = Post::latest()->get();

        foreach($users as $user){
            $user->posts_count = $posts->where('user_id', $user->id)->count();
        };

        return view('users.index', ['users'=>$users]);
    }


    public function profile(){
        $user = Auth::user();
        return view('profile.index', ['user'=>$user]);
    }

    public function profilePicture(Request $request){
        $user = Auth::user();
        $request->validate(['avatar'=>'image|mimes:jpeg,png, jpg,gif,svg|max:2048']);

        if(isset($request->avatar)){
            $avatar = time().'_'. $request->avatar->getClientOriginalName();

            if($user->avatar && file_exists(public_path('/avatars/'. $user->avatar))){
                unlink(public_path('/avatars/'. $user->avatar));
            }
            $request->avatar->move(public_path('avatars'), $avatar);
            $user->avatar = $avatar;
            $user->save();

            flash()->success('Profile Picture Updated Successfully');
        }else{
            flash()->error('profile picture upload Fail');
        }

        return redirect()->route('profile');
    }

    public function editBio(){
        $user = Auth::user();
        return view('profile.editBio', ['user'=>$user]);
    }

    public function bioUpdate(Request $request){
        $user = Auth::user();
        $request->validate(['bio'=>'nullable|string']);

        $user->bio = $request->bio;
        $user->save();
         flash()->success('Bio Updated Successfully');

         return redirect()->route('profile');
    }
}
