@extends('layout.nav')
@section('content')
<input type="hidden" id="uid" value="{{ $uid }}">
<div class="main-container">
<div id="map" style="width: 100%; height: 85%"></div>
</div>
<script type="text/javascript" src="{{URL::asset('js/panel.js')}}"></script>
@stop
</body>
