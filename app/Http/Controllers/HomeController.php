<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (session('logged_in')) {
            return redirect()->route('blogPostIndex');
        } else {
            return view('preview_post');
        }
    }

    public function showLoginPage()
    {
        return view('login');
    }

    public function showRegisterPage()
    {
        return view('register');
    }

    public function login(CheckUserRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            session(['logged_in' => true, 'user_id' => $user->id, 'name' => $user->name]);

            return redirect()->route('blogPostIndex');
        } else {
            return redirect()->route('loginPage')->with('error', 'The user is not registered yet :(');
        }
    }

    public function register(CheckUserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return redirect()->route('loginPage')->with('success', 'Successfully created account!');
    }

    public function logout()
    {
        session()->forget(['logged_in', 'user_id', 'name']);
        return redirect()->route('index');
    }
}
