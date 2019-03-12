@extends('layout.nav')
@section('content')

<ol class="breadcrumb">
<h5>Welcome {{ $uid }} </h5>
  <li class="breadcrumb-item"><a href="/conductors">Conductors</a></li>
  <li class="breadcrumb-item"><a href="/buses">Buses</a></li>
  <li class="breadcrumb-item"><a href="/routes">Route</a></li>
  <li class="breadcrumb-item"><a href="#">Fare</a></li>
  <li class="breadcrumb-item"><a href="#">Reports</a></li>
</ol>
<div style="width: 40rem">
  <label class="col-form-label col-form-label-sm" for="inputSmall">Route Name</label>
  <input class="form-control form-control-sm" type="text" placeholder="" id="number"></input>
  <label class="col-form-label col-form-label-sm" for="inputSmall">Coverage</label>
</div>



<!-- <div id="map"></div> -->
    <!-- <script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 11.5777785, lng: 113.5708112},
          zoom: 8
        });
      }
    </script> -->
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGVpkWk3EEyRicdXwr9lI5OhRi9yEndds&callback=initMap"
    async defer></script> -->


<script type="text/javascript" src="{{URL::asset('js/firebase.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/addroute.js')}}"></script>

@stop