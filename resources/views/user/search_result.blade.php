@extends('layouts.app')
@section('content')
<section class="user_login">
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/find_friend') }}">
        {!! csrf_field() !!}
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div id="imaginary_container"> 
                        <div class="input-group stylish-input-group">
                            <input type="text" class="form-control" name="search"  placeholder="Search for Friends" >
                            <span class="input-group-addon">
                                <button type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>  
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <hr>
    <div class="container main">
        <div class="row">
            <div class="col-md-8">
                <div class="row ">
                    <div class="">
                        <!-- TWEET WRAPPER START -->
                        <div class="twt-wrapper">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    Search Result for {{ $query }}
                                </div>
                                <div class="panel-body tweet">
                                    <ul class="media-list">
                                        @if (count($users)) 
                                        @foreach ($users as $user)
                                        <li class="media">
                                            <div class="media-body">
                                               @if (Auth::user()->id != $user->id)
                                               <span class="text-muted pull-right" style="margin-top: 27px; margin-right: 12px">
                                                @if (!$user->isFollowedBy(Auth::user()))
                                                <a href="#" class="btn btn-primary pull-right follow_user" data-user-id="{{ Auth::user()->id }}" data-follow-id ="{{ $user->id }}">Follow</a>
                                                @else 
                                                <a href="#" class="btn btn-primary pull-right unfollow_user" data-user-id="{{ Auth::user()->id }}" data-follow-id ="{{ $user->id }}">Unfollow</a>
                                                @endif
                                            </span>
                                            <div class=" panel panel-info panel-body">
                                                <strong class="text-primary">
                                                @<a href="{{ url('/user', $user->username) }}">
                                                {{ $user->username }}
                                                </a></strong> 
                                                @if (count($user['latest_tweet'])>0)
                                                
                                                {{ $user['latest_tweet']->tweet }}
                                                
                                                <h6 style="color:#A194BB">{{ $user['latest_tweet']->created_at }}</h6 class="text-faded">

                                                @else
                                                
                                                <p class="text-danger">No tweet yet!</p>
                                                
                                                <h6 style="color:#A194BB"></h6 class="text-faded">
                                                
                                                @endif
                                                
                                                </div>
                                            </div>
                                        </li> 
                                        @endif
                                        @endforeach
                                    </ul>
                                    {!! $users->links() !!}
                                    @else <p class="text-danger">The Target User not Found</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- TWEET WRAPPER END -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
