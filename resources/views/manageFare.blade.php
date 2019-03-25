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
<input type="hidden" id="routeID" value="{{ $infos['routeID'] }}">

FARE MATRIX
<table id="matrix" style="table-layout: fixed; max-width: 100%">
    <thead>
    </thead>
    <tbody>
@if($haveFare)
    
        <tr>
            <td></td>
            @foreach($fareKeys as $key)
                <td>{{ $key }}</td>
            @endforeach
        </tr>
        @foreach($fares as $a)
            @foreach($a as $b)
            <tr>
            <td>{{ $fareKeys[($loop->iteration)-1] }}</td>
                @foreach($b as $c)
                    <td><input type="text" readonly="true" value="{{ $c }}" style='width:6rem'></td>
                @endforeach
            </tr>
            @endforeach
        @endforeach
    

<script type="text/javascript" src="{{URL::asset('js/havefare.js')}}"></script>
@else
    
    
@endif
</tbody>
</table>
<button id="saveMatrix" type="button" class="btn btn-primary" style="float: right; margin: 3rem">Save</button>

@if($haveFare)

@else
<script type="text/javascript" src="{{URL::asset('js/fare.js')}}"></script>
@endif
@stop