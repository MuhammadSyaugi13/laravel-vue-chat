<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Http\Controllers\ChatController;
use GuzzleHttp\Promise\Create;

class RoomController extends Controller
{
    public function create(Request $request){
        $me = auth()->user()->id;
        $friend = $request->friend_id;

        $room = Room::where("users", "$me:$friend")->orWhere("users", "$friend:$me")->first();

        if($room){
            $dataRoom = $room;
        }else {
            $dataRoom = Room::create([
                "users" => "$me:$friend"
            ]);
        }

        // dd($dataRoom->id);

        $dataMessage = ChatController::loadMessage($dataRoom->id);

        return ["dataRoom" => $dataRoom, "dataMessage" => $dataMessage];
    }
}
