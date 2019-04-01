@extends('layout.nav')
@section('content')

<h3 class="font-weight-bolder ml-3 mt-3 mb-5">Conductors Daily Report</h3>

<input type="hidden" id="uid" value="{{ $uid }}">
<div class="container">
  @foreach($keys as $key)
  <div class="dropdown">
      <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">{{str_replace("_", " ",str_replace("-", ".", $key))}}</button>
      <div class="dropdown-menu mt-0">
      @foreach($reports[$key] as $cond)
      @php    
      $raw = explode("_", $cond['fileName']);
      $a = str_replace(".csv", "", $raw[3]);
      $fName = $a.'-'.$raw[1].'-'.$raw[2];
      $date = date("F j, Y", strtotime($fName));
      @endphp
          <label class="dropdown-item pr-2 pb-1" id="{{$cond['fileName']}}" onClick="download(this.id); return false" href="#">{{$date}}<img class="ml-4 mr-2 mb-0" src="{{ URL::asset('img/download.png') }}"></label>
      @endforeach
      </div>
  </div>
  @endforeach
</div>

<script type="text/javascript" src="{{URL::asset('js/reports.js')}}"></script>
<!-- <script type="text/javascript" src="{{URL::asset('js/firebase.js')}}"></script> -->
@stop
</html>