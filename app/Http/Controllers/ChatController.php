<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;


class ChatController extends Controller
{


    public function index()
    {
        $user = auth()->user();
        $history = null;
        $chat = null;
        $allChats = null;

        if($user->history){
            $history =  $user->history;
            $chat = Chat::where('history_id', $history->id)->latest()->first();
            $chat->data = json_decode($chat->data);
            if($history->chats()->count() > 1) {
                $allChats = $history->chats;
            }
        }

        return Inertia::render('Chat', [
            "history" => $history,
            "chats" => $chat,
            "allChats" => $allChats
        ]);
    }

    public function addChat(Request $request)
    {
        if(!$request->isMethod('POST')){
            return redirect(route('chat'));
        }

//        $result = OpenAI::completions()->create([
//            'model' => 'text-curie-001',
//            'prompt' => $request['search'],
//        ]);


        $user = auth()->user();
        $history = null;
        $chat = null;
        $allChats = null;

        if(!$user->history){

           $history =  $user->history()->create();

           $data = json_encode([
            0 => [
                'request' => $request['message'],
                'response' => Str::random(10),
            ]
           ]);

           $chat =  $history->chats()->create([
            'data' => $data
           ]);


        }else {

            $history =  $user->history;
            $chat = $history->chats()->find($request->chats_id);
            $data = json_decode($chat->data);

            $data[] = [
                'request' => $request['message'],
                'response' => Str::random(10),
            ];

            $chat->data = json_encode($data);

            $chat->save();
        }

        if($history && $history->chats()->count() > 1) {
            $allChats = $history->chats;
        }

        $chat->data = json_decode($chat->data);

        return Inertia::render('Chat', [
            "history" => $history,
            "chats" => $chat,
            "allChats" => $allChats
        ]);
    }


    public function newChat(){

        auth()->user()->history->chats()->create([
            'data' => json_encode([]),
        ]);

        return to_route('chat');
    }
}
