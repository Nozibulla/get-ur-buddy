<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'tweet', 'user_id',
    ];

    public function user() {

      return $this->belongsTo('App\User');
  }

  // public function scopeLatest($query)
  // {
  //   return $query->orderBy('created_at', 'desc')->first();
  // }

}
