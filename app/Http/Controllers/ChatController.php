<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{

    public function index(Request $request)
    {
        if(!$request->isMethod('POST')){
            return redirect(route('chat'));
        }

//        $result = OpenAI::completions()->create([
//            'model' => 'text-curie-001',
//            'prompt' => $request['search'],
//        ]);

        return  [
            '$request' => $request['search'],
            '$response' => str::random(10), //$result['choices'][0]['text'],
            ];
    }
}
