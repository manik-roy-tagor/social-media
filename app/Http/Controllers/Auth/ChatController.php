<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        $messages = Message::where(function($query) use ($user) {
                $query->where('sender_id', Auth::id())
                      ->where('receiver_id', $user->id);
            })
            ->orWhere(function($query) use ($user) {
                $query->where('sender_id', $user->id)
                      ->where('receiver_id', Auth::id());
            })
            ->orderBy('created_at', 'asc')
            ->get();

            
        $allUsers = User::all();

            
        return view('auth.chat.index', compact('user', 'allUsers', 'messages'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:255',
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        $senderName = Auth::user()->name;

        return response()->json(['message' => $message, 'sender_name' => $senderName]);
    }

    public function fetchMessages($receiver_id)
    {
        $messages = Message::where(function ($query) use ($receiver_id) {
                $query->where('sender_id', Auth::id())
                      ->where('receiver_id', $receiver_id);
            })
            ->orWhere(function ($query) use ($receiver_id) {
                $query->where('sender_id', $receiver_id)
                      ->where('receiver_id', Auth::id());
            })
            ->orderBy('created_at', 'desc')
            ->take(10) // Limit number of messages for each fetch
            ->get();
    
        return response()->json(['messages' => $messages]);
    }
    

    public function getUnreadMessageCount()
{
    $unreadCount = Message::where('receiver_id', Auth::id())
                          ->where('is_read', false)
                          ->count();

    return response()->json(['unread_count' => $unreadCount]);
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
        //
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
