<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function chat($id){
        $receiver = User::findOrFail($id);
        $user = Auth::user();
        $messages = [];
        return view('messages.index', [
            'receiver' => $receiver,
            'user' => $user,
            'messages' => $messages,
        ]);
    }

    public function save(Request $request){
        $this->validate($request, [
            'text' => 'required'
        ]);

        $user_id = $request->user_id;
        $receiver_id = $request->receiver_id;
        $text = $request->text;

        Message::create([
            'sender_id' => $user_id,
            'receiver_id' => $receiver_id,
            'message' => $text
        ]);

        return redirect()->route('chat', ['id' => $receiver_id]);

    }
}
