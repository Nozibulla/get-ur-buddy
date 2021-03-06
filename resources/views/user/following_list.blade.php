@extends('layouts.app')

@section('content')

<section class="user_login">

    <div class="container main">

        <div class="row">

            <div class="col-md-8">

                <div class="row ">

                    <div class="">

                        <!-- TWEET WRAPPER START -->
                        <div class="twt-wrapper">

                            <div class="panel panel-info">

                                <div class="panel-heading">

                                    {{ $user->name }} is Following {{ $number_of_following }} People 

                                </div>

                                <div class="panel-body tweet">

                                    <ul class="media-list">

                                        @if (count($followings))

                                        @foreach ($followings as $following)

                                        <li class="media">

                                            <div class="media-body">

                                             @if (Auth::user()->id != $following->id)

                                             <span class="text-muted pull-right" style="margin-top: 27px; margin-right: 12px">

                                                @if ($following->isFollowedBy(Auth::user()))

                                                <a href="#" class="btn btn-primary pull-right unfollow_user" data-user-id="{{ Auth::user()->id }}" data-follow-id ="{{ $following->id }}">Unfollow</a>

                                                @else 

                                                <a href="#" class="btn btn-primary pull-right follow_user" data-user-id="{{ Auth::user()->id }}" data-follow-id ="{{ $following->id }}">Follow</a>

                                                @endif
                                                
                                            </span>

                                            @endif

                                            <div class=" panel panel-info panel-body">

                                                <strong class="text-primary">@<a href="{{ url('/user', $following->username) }}">{{ $following->username }}</a></strong>

                                                @if (count($following['latest_tweet'])>0)
                                                
                                                {{ $following['latest_tweet']->tweet }}
                                                
                                                <h6 style="color:#A194BB">{{ $following['latest_tweet']->created_at }}</h6 class="text-faded">

                                                @else
                                                
                                                <p class="text-danger">No tweet yet!</p>
                                                
                                                @endif


                                                </div>

                                            </div>

                                        </li>

                                        @endforeach

                                    </ul>

                                    {!! $followings->links() !!}

                                    @else <p class="text-danger">No following found</p>

                                    @endif
                                    
                                </div>

                            </div>

                        </div>
                        <!-- TWEET WRAPPER END -->
                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <p>
                    <strong class="text-primary adjust_username">

                        <a href="{{ url('/user', $user->username) }}">{{ $user->name }}</a>

                        @<a href="{{ url('/user', $user->username) }}">{{ $user->username }}</a>

                    </strong>

                </p>

                <p>
                    <a href="{{ url('/followers_list', $user->id) }}" class="btn btn-primary">{{ $number_of_followers }} Followers</a>

                    <a href="{{ url('/following_list', $user->id) }}" class="btn btn-primary">{{ $number_of_following }} Following</a>

                </p>
                <div class="row">

                    <div class="col-md-6">

                        <a href="{{ url('/user', $user->username) }}" title="">Tweets</a>

                    </div>

                    <div class="col-md-6 ">{{ $number_of_tweet }}</div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection
