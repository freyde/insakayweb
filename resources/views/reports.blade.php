@extends('layout.nav')
@section('content')

<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="/conductors">Conductors</a></li>
  <li class="breadcrumb-item"><a href="/buses">Buses</a></li>
  <li class="breadcrumb-item"><a href="/routes">Route</a></li>
  <li class="breadcrumb-item"><a href="/fare">Fare</a></li>
  <li class="breadcrumb-item"><a href="/reports">Reports</a></li>
</ol>

<input type="hidden" id="uid" value="{{ $uid }}">

@foreach($keys as $key)
<div class="report-dropdown">
    <button class="report-dropbtn">{{$key}}</button>
    <div class="report-dropdown-content">
    @foreach($reports[$key] as $cond)
        <label id="{{$cond['fileName']}}" onClick="download(this.id); return false" href="#">{{$cond['fileName']}}</label>
    @endforeach
    </div>
</div>
@endforeach

<script type="text/javascript" src="{{URL::asset('js/reports.js')}}"></script>
<!-- <script type="text/javascript" src="{{URL::asset('js/firebase.js')}}"></script> -->
@stop