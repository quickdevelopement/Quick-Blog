<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function register()  {
    return view('auth.register');
  }  

  public function registerStor(Request $request){
     $request->validate([
        'name'=>'required|string|max:200',
        'email'=> 'required|string|email|max:255|unique:users',
        'password'=>'required',
    ]);

    $user = new User();
    $user->name = $request->name;
    $user->email= $request->email;
    $user->password = bcrypt($request->password);

    $existendUser = User::latest()->get();

    if($existendUser->isEmpty()){
        $user->role = 'admin';
    }else{
        $user->role= 'user';
    };

    $user->save();
    flash()->success('Regostration successfully!');
    Auth::login($user);

    return redirect('/');
  }
  
  
  public function login(){
    return view('auth.login');
  }

  public function loginStor( Request $request){
     $request->validate([
        'email'=> 'required|email',
        'password'=>'required',
    ]);

    if(Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))){
        $request->session()->regenerate();
        flash()->success('Login successfully!');
        return redirect()->intended('/');
    }

    return back()->withErrors([
        'email'=> 'The provided credentials do not match our records',
    ]);
  }

  public function logout(Request $request){
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();
    flash()->success('Logout successfully!');
    return redirect('/');
  }



}
