<?php

namespace App\Http\Controllers;

use App\Events\SendMessage;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;

class ChatController extends Controller
{
    public function index(Request $req)
    {
        $data["friends"] = User::whereNot("id", auth()->user()->id)->get();

        return view("chat". $data);
    }

    public function saveMessage (Request $req) {
        $roomId = $req->roomId;
        $message = $req->message;
        $userId = auth()->user()->id;

        broadcast(new SendMessage($roomId, $userId, $message));

        Message::created([
            "room_id" => $roomId,
            "user_id" => $userId,
            "message" => $message,
        ]);

        return "Message success stored";
    }

    public function loadMessage ($roomId) {
        $message = Message::where('room_id', $roomId)->orderBy('updated_at', 'asc')->get();
        return $message;
    }
}
