@extends('layout.nav')
@section('content')

<body>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="/conductors">Conductors</a></li>
  <li class="breadcrumb-item"><a href="/buses">Buses</a></li>
  <li class="breadcrumb-item"><a href="/routes">Route</a></li>
  <li class="breadcrumb-item"><a href="/fare">Fare</a></li>
  <li class="breadcrumb-item"><a href="/reports">Reports</a></li>
</ol>

<input type="hidden" id="uid" value="{{ $uid }}">
<div class="main-container">
<div id="map" style="width: 100%; height: 40rem"></div>
</div>
<script type="text/javascript" src="{{URL::asset('js/panel.js')}}"></script>

@stop
</body>
