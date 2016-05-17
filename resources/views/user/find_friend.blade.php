@extends('layouts.app')

@section('content')

<form class="form-horizontal" role="form" method="POST" action="{{ url('/find_friend') }}">
	{!! csrf_field() !!}
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div id="top_space"> 
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

@endsection