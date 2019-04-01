@extends('layout.nav')
@section('content')

<input type="hidden" id="uid" value="{{ $uid }}">
<input type="hidden" id="routeID" value="{{ $infos['routeID'] }}">


<h3 class="font-weight-bolder ml-3 mt-3">{{ $routeName }} - FARE MATRIX</h3>
<div class="container">
<table id="matrix" class="table table-sm" style="table-layout: fixed; max-width: 100%">
    <thead>
    </thead>
    <tbody>
@if($haveFare)
    
        <tr>
            <td></td>
            @foreach($fareKeys as $key)
                <td class="font-weight-bold">{{ $key }}</td>
            @endforeach
        </tr>
        @foreach($fares as $a)
            @foreach($a as $b)
            <tr>
            <td  class="font-weight-bold">{{ $fareKeys[($loop->iteration)-1] }}</td>
                @foreach($b as $c)
                    <td><input type="text" readonly="true" value="{{ $c }}" style='width:6rem'></td>
                @endforeach
            </tr>
            @endforeach
        @endforeach
    

<script type="text/javascript" src="{{URL::asset('js/havefare.js')}}"></script>
@else
    
<button id="saveMatrix" type="button" class="btn btn-primary" style="float: right; margin: 3rem">Save</button>
@endif
</tbody>
</table>

</div>

@if($haveFare)

@else
<script type="text/javascript" src="{{URL::asset('js/fare.js')}}"></script>
@endif
@stop
</html>