<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use App\Models\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PusherController extends Controller
{
    public function index()
    {
        return view(view: 'index');
    }

    public function broadcast(Request $request)
    {
        broadcast(new PusherBroadcast($request->get(key:'message')))->toOthers();
        self::storeMessage( $request->input('message'));
        return view('broadcast', ['message' => $request->get('message')]);
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

