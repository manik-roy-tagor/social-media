<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $events = Event::all();
        $allUsers = User::all();
        $posts = Post::with('user', 'comments.user')->orderBy('created_at', 'desc')->get();
        

        return view('welcome', compact('posts', 'allUsers', 'events'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'post_description' => 'required|string|max:2000',
        ]);
    
        // Assuming the user is authenticated
        $validatedData['user_id'] = Auth::id();
    
        Post::create($validatedData);
    
        return redirect()->route('home')->with('success', 'Post created successfully!');
    }


}
