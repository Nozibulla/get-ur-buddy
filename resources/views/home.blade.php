@extends('layouts.app')

<?php $logged_user = Auth::user() ?>

@section('content')
<section class="user_login">
    <div class="container main">
        <div class="row">
            <div class="col-md-8">

                <div class="row">
                    <div class="">
                        <!-- TWEET WRAPPER START -->
                        <div class="twt-wrapper">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    Timeline
                                </div>
                                <div class="panel-body tweet">

                                    {!! Form::open(['method' => 'POST', 'url' => '/tweet', 'data-remote'=>'data-remote','data-remote-success'=>'Student saved successfully', 'class' => 'form-horizontal']) !!}

                                    {!! Form::hidden('user_id', $logged_user->id) !!}

                                    <div class="form-group{{ $errors->has('tweet') ? ' has-error' : '' }}">
                                        {!! Form::textarea('tweet', null, ['class' => 'form-control', 'required' => 'required', 'placeholder'=>"Whats on your mind?...", 'rows'=>"2"]) !!}
                                        <small class="text-danger">{{ $errors->first('tweet') }}</small>
                                    </div>


                                    {!! Form::submit("Tweet", ['class' => 'btn btn-primary pull-right']) !!}


                                    {!! Form::close() !!}

                                    @if (count($tweets)>0)

                                    @if (count($latest)>0)
                                    
                                    <div class="clearfix">
                                        <div class=" panel panel-info panel-body col-md-11">
                                            <h3>Your Latest Tweet</h3>
                                            <strong class="text-primary">@<a href="user/{{ $logged_user->username }}">{{ $logged_user->username }}</a></strong> <?php echo nl2br(html_entity_decode($latest->tweet))?>
                                            <h6 style="color:#A194BB"> Tweeted at {{ $latest->created_at }}</h6 class="text-faded">
                                            </div>
                                        </div>
                                        @else
                                        <p>No Tweet yet.</p>
                                        @endif
                                        <hr />
                                        
                                        <ul class="media-list">
                                            @foreach ($tweets as $tweet)
                                            <li class="media">
                                                <div class="media-body">
                                                    @if ($logged_user->id == $tweet->user_id)
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

                                            </ul>
                                            {{ $tweets->links() }}
                                            @else <p>No tweets available</p>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <!-- TWEET WRAPPER END -->
                            </div>

                        </div>


                    </div>
                    <div class="col-md-4">
                        <p><strong class="text-primary adjust_username"><a href="{{ url('/user', $logged_user->username) }}">{{ $logged_user->name }}</a>
                        @<a href="{{ url('/user', $logged_user->username) }}">{{ $logged_user->username }}</a></strong></p>
                        <p>
                            <a href="{{ url('/followers_list', $logged_user->id) }}" class="btn btn-primary">{{ $followers }} Followers</a>
                            <a href="{{ url('/following_list', $logged_user->id) }}" class="btn btn-primary">{{ $following }} Following</a>
                        </p>
                        <div class="row">
                            <div class="col-md-6"><a href="{{ url('/user', $logged_user->username) }}" title="">Tweets</a></div>
                            <div class="col-md-6 ">{{ $number_of_tweet }}</div>
                        </div>
                    </div>

                </div>

            </div>

        </section>
        @endsection
