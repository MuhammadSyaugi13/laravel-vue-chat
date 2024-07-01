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
        // $data["friends"] = User::whereNot("id", auth()->user()->id)->get();
        
        // return view("chat". $data);

        $data = User::whereNot("id", auth()->user()->id)->get();
        return $data;
    }

    public function saveMessage (Request $req) {
        $roomId = $req->roomId;
        $message = $req->message;
        $userId = auth()->user()->id;

        broadcast(new SendMessage($roomId, $userId, $message));

        Message::create([
            "room_id" => $roomId,
            "user" => $userId,
            "message" => $message,
        ]);

        return "Message success stored";
    }

    public static function loadMessage ($roomId) {
        $message = Message::where('room_id', $roomId)->orderBy('updated_at', 'asc')->get();
        return $message;
    }
}
