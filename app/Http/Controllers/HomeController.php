<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\TweetRequest;
use App\Tweet;

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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tweets = Tweet::orderBy('created_at', 'desc')->get();

        $latest = Tweet::orderBy('created_at', 'desc')->where('user_id', $request->user()->id)->first();

        return view('home', compact('tweets', 'latest'));
    }
}
