@extends('layouts.app')
@section('content')
<section class="user_login">
    <form class="form-horizontal" role="form" method="GET" action="{{ url('/find_friend_result') }}">
        {!! csrf_field() !!}

        <div class="container">
        <div class="row">
                <div class="col-md-8">
                    <div class="form-horizontal">
                        <div class="input-group">
                            <div class="ddl-select input-group-btn">
                                <select name="select_option" id="ddlsearch" class="selectpicker form-control" required data-style="btn-primary">
                                    <option value="" data-hidden="true" class="ddl-title">Select an Option</option>
                                    <option value="user">User</option>
                                    <option value="tweet">Tweet</option>
                                </select>
                            </div>
                            <input name="search" class="form-control imaginary_container" required placeholder="Enter here" aria-describedby="ddlsearch" type="text">
                            <span class="input-group-btn">
                                <button id="btn-search" class="btn btn-info btn_fix" type="submit"><i class="fa fa-search fa-fw"></i></button>
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
                                    Search Result for {{ $selected }}: {{ $query }}
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
                                            @endif
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
                                            @endforeach
                                        </ul>
                                        {!! $users->appends(Request::only('select_option', 'search', '_token'))->links() !!}
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
