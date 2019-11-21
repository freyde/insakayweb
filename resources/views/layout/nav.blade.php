<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Insakay - {{ $opName }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{URL::asset('img/inSakay.ico')}}" >
    <link rel="stylesheet" href="{{URL::asset('css/custom.css')}}">
    <link rel="stylesheet" href="{{URL::asset('leaflet/leaflet.css')}}" />
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

    <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css' rel='stylesheet' />
    
    <!-- <script src="https://npmcdn.com/leaflet-geometryutil"></script> -->
    <script src="{{URL::asset('leaflet/leaflet.js')}}"></script>
    <script src="{{URL::asset('routing/leaflet-routing-machine.js')}}"></script>
    <script src="{{URL::asset('routing/leaflet-routing-machine.min.js')}}"></script>
    <link rel="stylesheet" href="{{URL::asset('routing/leaflet-routing-machine.css')}}">
    
    <script src="https://www.gstatic.com/firebasejs/5.8.1/firebase.js"></script>
    <script src="https://cdn.firebase.com/libs/firebaseui/3.1.1/firebaseui.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>

<body>
<div class="fixed-top">
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark shadow">
    <a class="navbar-brand" href="/"><h2>Insakay</h2></a>
    <div class="navbar-item float-right mt-0 mb-0 mr-3" style="margin-left: 75%">
      <li class="dropdown">
        <a class="dropdown-toggle font-weight-bold" href="#" data-toggle="dropdown">
          {{ $opName }}
        </a>
        <div class="dropdown-menu mt-0">
          <a class="dropdown-item" href="#">Change Password</a>
          <a class="dropdown-item" href="#" onClick="logout(); return false">Logout</a>
        </div>
      </li>
    </div>
  </nav>
</div>

<!-- <div class="wrapper"> -->
  <nav id="sidebar" class="sidebar h-100 bg-secondary" style="max-height: 100%">
    <ul class="list-group m-1">
      <li class="list-group-item"><a href="/conductors"><img class="mr-2 mb-0" src="{{ URL::asset('img/person.png') }}">Conductors</a></li>
      <li class="list-group-item"><a href="/buses"><img class="mr-2 mb-0" src="{{ URL::asset('img/bus.png') }}">Buses</a></li>
      <li class="list-group-item"><a href="/routes"><img class="mr-2 mb-0" src="{{ URL::asset('img/road.png') }}">Route</a></li>
      <li class="list-group-item"><a href="/fare"><img class="mr-2 mb-0" src="{{ URL::asset('img/receipt.png') }}">Fare</a></li>
      <li class="list-group-item"><a href="/reports"><img class="mr-2 mb-0" src="{{ URL::asset('img/document.png') }}">Reports</a></li>
    </ul>
  </nav>
<!-- </div> -->
  <div id="content">
    @yield('content')
  </div>
</div>
</body>
<script type="text/javascript" src="{{URL::asset('js/menu.js')}}"></script>
