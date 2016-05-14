<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\TweetRequest;
use App\Tweet;
use App\User;
use App\Follower;

class TweetController extends Controller
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
	public function saveTweet(TweetRequest $request)
	{
		$tweets = new Tweet;

		$tweets->tweet = htmlentities($this->save_url_as_link($request->tweet));
		$tweets->user_id = $request->user_id;
		$tweets->save();

		return redirect('home');

	}

	public function userProfile(Request $request)
	{
		$username = $request->username;

    	// return $username;

		$user = User::where('username', $username)->first();

		$tweets = Tweet::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

		return view('user/profile', compact('user', 'tweets'));
	}

	public function followUser(Request $request)
	{
		$user_id = $request->user_id;
		$follow_id = $request->follow_id;

		// Find user with user_id
        $user1 = User::find($user_id);

        // Find user with follow_id
        $user2 = User::find($follow_id);

        if ($user1 && $user2) {
            $user1->following()->save($user2);
        }

		return 'success';
	}

	public function unfollowUser(Request $request)
	{
		$user_id = $request->user_id;

		$follow_id = $request->follow_id;

		$get_follower = Follower::where('user_id', $user_id)->where('follow_id', $follow_id)->first();

		if($get_follower){

			$get_follower->delete();
		}
 
        return 'success';
	}

	public function save_url_as_link($text)
	{
		// The Regular Expression filter
		$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

		// Check if there is a url in the text
		if(preg_match($reg_exUrl, $text, $url)) {

       		// make the urls hyper links
			return preg_replace($reg_exUrl, "<p><a href='{$url[0]}' target='_blank'>{$url[0]}</a></p>", $text);

		} else {

       		// if no urls in the text just return the text
			return $text;

		}
	}


}
