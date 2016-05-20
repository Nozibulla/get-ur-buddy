@extends('layouts.app')

@section('content')

<form class="form-horizontal" role="form" method="GET" action="{{ url('/find_friend_result') }}">
	{!! csrf_field() !!}

	<div class="container">
	<div class="row top_space">
			<div class="col-md-6 col-md-offset-3">
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

@endsection