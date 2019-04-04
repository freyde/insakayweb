@extends('layout.loginnav')
@section('content')
<div clas="container">
<div class="card w-25 mx-auto">
  <div class="card-header">
		<h5 class="font-weight-bolder" align="center">Welcome to Insakay</h5>
</div>
  <div class="card-body">

		<div class="input-group form-group">
			<div class="input-group-prepend">
				<span class="input-group-text"><img src="{{ URL::asset('img/person_18.png') }}"></i></span>
			</div>
			<input type="email" class="form-control" id="email" placeholder="Email Address">
		</div>

		<div class="input-group form-group">
			<div class="input-group-prepend">
				<span class="input-group-text"><img src="{{ URL::asset('img/key_18.png') }}"></i></span>
			</div>
			<input type="password" class="form-control" id="password" placeholder="Password">
		</div>
  
    
    
    <input type="hidden" name="_token" value="{{ Session::token() }}">
  
    <input type="submit" class="btn btn-primary float-right" onclick="login()" value="Log in">

  </div>
</div>

<script type="text/javascript" src="{{URL::asset('js/index.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/firebase.js')}}"></script>

@stop
</html>