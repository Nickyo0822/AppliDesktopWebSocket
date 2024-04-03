<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use App\Models\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PusherController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function broadcast(Request $request)
    {
        $pp = DB::table('users')
            ->where('id', '=', Auth::id())
            ->get();

        if (!$pp[0]->profilepic) {
            $pp[0]->profilepic = 'nopp.png';
        }

        broadcast(new PusherBroadcast($request->get(key:'message')))->toOthers();
        self::storeMessage( $request->input('message'));
      
        return view('broadcast', ['message' => $request->get('message'), 'pp' => $pp]);
    }

    public function receive(Request $request)
    {
        Log::debug('Received message content: ' . $request);
        Log::debug('test : ' . $request->get('message'));
        $message = explode('|', $request->get('message'));
        $user_id = $message[1];
        $user_id = explode('=', $user_id);
        $user_id = $user_id[1];

        $pp_user = DB::table('users')
                    ->where('id', '=', $user_id)
                    ->get();

        if (!$pp_user[0]->profilepic) {
            $pp_user[0]->profilepic = '/images/profilepic/nopp.png';
        }

        return view('receive', ['message' => $message[0], 'pp_user' => $pp_user[0]->profilepic]);
    }

    public function storeMessage(string $message)
        {
            Messages::create([
                'content' => $message,
                'user_id' => Auth::id(),
                'rooms_id' => 1
            ]);
        }
}

