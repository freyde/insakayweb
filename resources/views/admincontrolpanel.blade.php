@extends('layout.adminnav')
@section('content')

<body>
<ol class="breadcrumb">
<h5>Welcome {{ $uid }}</h5>
  <li class="breadcrumb-item"><a href="/admin/operators">Operators</a></li>
</ol>





<button onclick="adminlogout()">Logout</button>

<script type="text/javascript" src="{{URL::asset('js/index.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/firebase.js')}}"></script>
@stop
</body>
