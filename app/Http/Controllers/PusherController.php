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
        return view('receive', ['message' => $request->get('message')]);
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

