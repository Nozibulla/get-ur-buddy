<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'password', 'remember_token',
    ];
    /**
     * This function allows us to get a list of tweets by this user
     * @return [type] [description]
     */
    public function tweets() {

        return $this->hasMany('App\Tweet');
    }

    // This function allows us to get a list of users following us
    public function followers()
    {
        return $this->belongsToMany('App\User', 'followers', 'follow_id', 'user_id')->withTimestamps();
    }

// Get all users we are following
    public function following()
    {
        return $this->belongsToMany('App\User', 'followers', 'user_id', 'follow_id')->withTimestamps();
    }

    /**
     * Determine if current user follows another user.
     *
     * @param User $otherUser
     * @return bool
     */
    public function isFollowedBy(User $otherUser)
    {
        $idsWhoOtherUserFollows = $otherUser->following()->lists('follow_id')->toArray();

        return in_array($this->id, $idsWhoOtherUserFollows);
    }
}
