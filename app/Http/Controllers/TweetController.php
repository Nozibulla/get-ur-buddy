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

		$followers = count($user->followers);

        $following = count($user->following);

        $number_of_tweet = count($user->tweets);

		$tweets = Tweet::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

		return view('user/profile', compact('user', 'tweets', 'followers', 'following', 'number_of_tweet' ));
	}

	public function findFriendPage()
	{
		return view('user/find_friend');
	}

	public function findFriend(Request $request)
	{
		return $request->search;
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

	public function deleteTweet(Request $request)
	{
		$id = $request->id;

		$tweet = Tweet::findOrFail($id);

		$tweet->delete();
	}

	public function followerList($id)
	{
		$user = User::findOrFail($id);

		$followers = $user->followers;

		$number_of_followers = count($followers);

        $number_of_following = count($user->following);

        $number_of_tweet = count($user->tweets);

		return view('user/follower_list', compact('user', 'followers', 'number_of_followers', 'number_of_following', 'number_of_tweet'));
	}

	public function followingList($id)
	{
		$user = User::findOrFail($id);

		$followings = $user->following;

		// foreach ($followings as $following) {
			
		// 	$following_detail['name'] = $following->name;
		// 	$following_detail['username'] = $following->username;
		// 	$following_detail['latest_tweet'] = Tweet::select('tweet', 'created_at')->orderBy('created_at', 'desc')->where('user_id', $following->id)->first();

		// }

		$number_of_followers = count($user->followers);

        $number_of_following = count($followings);

        $number_of_tweet = count($user->tweets);

		return view('user/following_list', compact('user', 'followings', 'number_of_followers', 'number_of_following', 'number_of_tweet'));
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
