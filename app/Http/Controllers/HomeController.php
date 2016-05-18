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
     * Show the Users Timeline with Tweets and follower and following lists and Number of Tweets.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $tweets = Tweet::orderBy('created_at', 'desc')->simplePaginate(10);

        $latest = Tweet::orderBy('created_at', 'desc')->where('user_id', $request->user()->id)->first();

        $followers = count($request->user()->followers);

        $following = count($request->user()->following);

        $followings = $request->user()->following;

        $tweets = Tweet::where('user_id', $request->user()->id)
        ->orWhere(function($query) use ($followings) {
            foreach ($followings as $following) {

                $query->orwhere('user_id',$following->id );
            }
        })
        ->orderBy('created_at', 'desc')->simplePaginate(10);

        // foreach ($followings as $follow) {


        //    $tweets[] = $follow->tweets()->orderBy('created_at', 'desc')->simplePaginate(10);


        // }

        // $tweets = $tweets->orderBy('created_at', 'desc');

        $number_of_tweet = count($request->user()->tweets);

        return view('home', compact('tweets', 'latest', 'followers', 'following', 'number_of_tweet' ));
    }
}
