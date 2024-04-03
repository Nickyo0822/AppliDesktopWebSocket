<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        broadcast(new PusherBroadcast($request->get(key:'message')))->toOthers();
        
        return view('broadcast', ['message' => $request->get('message'), 'pp' => $pp]);
    }

    public function receive(Request $request)
    {
        return view('receive', ['message' => $request->get('message')]);
    }
}
