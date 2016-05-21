@extends('layouts.app')

@section('content')
<section class="user_login">
    <div class="container main">
        <div class="row">
            <div class="col-md-8">

                <div class="">
                    <div class="">
                        <!-- TWEET WRAPPER START -->
                        <div class="twt-wrapper">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    Timeline of {{ $user->name }} 
                                    @if (Auth::user()->username != $user->username)

                                    @if ($user->isFollowedBy(Auth::user()))

                                    <a href="#" class="btn btn-primary pull-right unfollow_user" data-user-id="{{ Auth::user()->id }}" data-follow-id ="{{ $user->id }}">Unfollow</a>

                                    @else 

                                    <a href="#" class="btn btn-primary pull-right follow_user" data-user-id="{{ Auth::user()->id }}" data-follow-id ="{{ $user->id }}">Follow</a>

                                    @endif

                                    @endif
                                    
                                </div>
                                <div class="panel-body tweet">
                                    <ul class="media-list">
                                    @if (count($tweets)>0)
                                    
                                        @foreach ($tweets as $tweet)
                                        <li class="media">
                                            <div class="media-body">
                                               @if (Auth::user()->id == $tweet->user_id)
                                               <span class="text-muted pull-right">
                                                <a href="#" title="" class="delete_tweet" data-id = "{{ $tweet->id }}">
                                                    <small class="text-muted">
                                                        <h4><i class="fa fa-trash" ></i></h4>
                                                    </small>
                                                </a>
                                            </span>
                                            @endif
                                            <div class=" panel panel-info panel-body">
                                                <strong class="text-primary">@<a href="{{ url('/user', $tweet->user->username) }}">{{ $tweet->user->username }}</a></strong> <?php echo nl2br(html_entity_decode($tweet->tweet))?>
                                                <h6 style="color:#A194BB"> Tweeted at {{ $tweet->created_at }}</h6 class="text-faded">
                                                </div>

                                            </div>
                                        </li>
                                        @endforeach

                                        @else <p class="text-danger">No Tweet Yet!</p>

                                        @endif

                                    </ul>
                                
                                </div>
                            </div>
                        </div>
                        <!-- TWEET WRAPPER END -->
                    </div>
                </div>


            </div>
            <div class="col-md-4">
                        <p><strong class="text-primary adjust_username"><a href="{{ url('/user', $user->username) }}">{{ $user->name }}</a>
                        @<a href="{{ url('/user', $user->username) }}">{{ $user->username }}</a></strong></p>
                        <p>
                            <a href="{{ url('/followers_list', $user->id) }}" class="btn btn-primary">{{ $followers }} Followers</a>
                            <a href="{{ url('/following_list', $user->id) }}" class="btn btn-primary">{{ $following }} Following</a>

                        </p>
                        <div class="">
                            <div class="col-md-6"><a href="{{ url('/user', $user->username) }}" title="">Tweets</a></div>
                            <div class="col-md-6 ">{{ $number_of_tweet }}</div>
                        </div>
                    </div>

        </div>

    </div>

</section>
@endsection
