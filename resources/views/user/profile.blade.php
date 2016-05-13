@extends('layouts.app')

@section('content')
<section class="user_login">
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <div class="row">
                    <div class="">
                        <!-- TWEET WRAPPER START -->
                        <div class="twt-wrapper">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    Timeline of {{ $user->name }} 
                                    @if (Auth::user()->username != $user->username)
                                    <a href="#" class="btn btn-primary pull-right">Follow</a>
                                    @endif
                                </div>
                                <div class="panel-body tweet">
                                    <ul class="media-list">
                                        @foreach ($tweets as $tweet)
                                        <li class="media">
                                            <div class="media-body">
                                               @if (Auth::user()->id == $tweet->user_id)
                                               <span class="text-muted pull-right">
                                                <a href="#" title="">
                                                    <small class="text-muted">
                                                        <h4><i class="fa fa-trash" ></i></h4>
                                                    </small>
                                                </a>
                                            </span>
                                            @endif
                                            <div class=" panel panel-info panel-body">
                                                <strong class="text-primary">@<a href="user/{{ $tweet->user->username }}">{{ $tweet->user->username }}</a></strong> <?php echo nl2br(html_entity_decode($tweet->tweet))?>
                                                <h6 style="color:#A194BB"> Tweeted at {{ $tweet->created_at }}</h6 class="text-faded">
                                            </div>
                                                
                                            </div>
                                        </li>
                                        @endforeach

                                    </ul>
                                    <span class="text-danger">237K users active</span>
                                </div>
                            </div>
                        </div>
                        <!-- TWEET WRAPPER END -->
                    </div>
                </div>


            </div>
            <div class="col-md-4">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                </p>
            </div>

        </div>

    </div>

</section>
@endsection
