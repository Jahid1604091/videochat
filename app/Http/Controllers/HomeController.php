<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function authenticate(Request $req){
        $socketId = $req->socket_id;
        $channelName = $req->channel_name;

        dd($req->all());

        $pusher = new Pusher('9405869a982199524847','64e66109926a598558ba', '1289433',[
            'cluster' => 'ap2',
            'encrypted'=>true
        ]);

        $presence_data = ['name'=>auth()->user()->name];
        $key = $pusher->presenceAuth($channelName,$socketId,auth()->id(),$presence_data);
        return response($key);
    }
}
