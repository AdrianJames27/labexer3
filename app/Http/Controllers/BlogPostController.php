<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogPostRequest;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function index() {
        if (session('logged_in')) {
            return view('index');
        } else {
            return redirect()->route('index');
        }
    }

    // get all blog posts
    public function getPosts()
    {
        $blogPosts = BlogPost::with('user')->orderBy('created_at', 'desc')->get();

        return view('post_list', compact('blogPosts'));
    }

    // store the blog post
    public function store(StoreBlogPostRequest $request)
    {
        if (session('logged_in')) {
            $blogPost = BlogPost::create([
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => session('user_id')
            ]);

            $retrievedPost = BlogPost::with('user')
                            ->where('user_id', $blogPost->user_id)
                            ->orderBy('created_at', 'desc')
                            ->first();

            return response()->json([
                'status' => 200,
                'message' => 'Successfully Uploaded!',
                'data' => $retrievedPost
            ]);
        } else {
            return response()->json([
                'message' => 'Not logged to the system!'
            ]);
        }
    }
}
