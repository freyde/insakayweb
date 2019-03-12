@extends('layout.nav')
@section('content')

<body>
<ol class="breadcrumb">
<h5>Welcome {{ $uid }}</h5>
  <li class="breadcrumb-item"><a href="/conductors">Conductors</a></li>
  <li class="breadcrumb-item"><a href="/buses">Buses</a></li>
  <li class="breadcrumb-item"><a href="/routes">Route</a></li>
  <li class="breadcrumb-item"><a href="#">Fare</a></li>
  <li class="breadcrumb-item"><a href="#">Reports</a></li>
</ol>

<div class="main-container">
  
</div>
<button onclick="logout()">Logout</button>


<script type="text/javascript" src="{{URL::asset('js/index.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/firebase.js')}}"></script>

@stop
</body>
