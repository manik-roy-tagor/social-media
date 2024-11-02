<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use Auth;
use Illuminate\Http\Request;
use URL;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $validatedData = $request->validate([
            'post_description' => 'required|string|max:255',
        ]);

        // Assuming the user is authenticated
        $validatedData['user_id'] = Auth::id();

        Post::create($validatedData);
        // Determine the redirect path
        $currentUrl = URL::current();
        return redirect()->route($currentUrl)->with('success', 'Post created successfully!');

    }

    public function likePost($id)
{
    $post = Post::findOrFail($id);
    $user = Auth::user();

    // Check if the post is already liked by this user
    $existingLike = Like::where('post_id', $post->id)->where('user_id', $user->id)->first();

    if ($existingLike) {
        // If liked, unlike it
        $existingLike->delete();
        $liked = false;
    } else {
        // Otherwise, like it
        Like::create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);
        $liked = true;
    }

    return response()->json([
        'success' => true,
        'liked' => $liked,
        'likesCount' => $post->likes()->count(),
    ]);
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
