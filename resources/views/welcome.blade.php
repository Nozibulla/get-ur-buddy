@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Joined in Tweeter</h1></div>

                <div class="panel-body">

                    Welcome you have just joined in Twitter Please click on login into Twitter and Tweet  

                    <a href="{{ url('/login') }}" class="btn btn-primary">LogIn Now</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
