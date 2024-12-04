<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (session('logged_in')) {
            return redirect()->route('blogPostIndex');
        } else {
            return view('login');
        }
    }

    public function login(CheckLoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            session(['logged_in' => true, 'user_id' => $user->id, 'name' => $user->name]);

            return redirect()->route('blogPostIndex');
        } else {
            return redirect()->route('index');
        }
    }

    public function logout()
    {
        session()->forget(['logged_in', 'user_id', 'name']);
        return redirect()->route('index');
    }
}
