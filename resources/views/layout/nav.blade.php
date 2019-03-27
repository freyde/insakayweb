<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Insakay - {{ $opName }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="{{URL::asset('css/sandstone.min.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{URL::asset('css/loader.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{URL::asset('css/custom.css')}}">
    <link rel="stylesheet" href="{{URL::asset('leaflet/leaflet.css')}}" />

    <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css' rel='stylesheet' />
    
    <!-- <script src="https://npmcdn.com/leaflet-geometryutil"></script> -->
    <script src="{{URL::asset('leaflet/leaflet.js')}}"></script>
    
    <script src="https://www.gstatic.com/firebasejs/5.8.1/firebase.js"></script>
    <script src="https://cdn.firebase.com/libs/firebaseui/3.1.1/firebaseui.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="/"><h2>Insakay</h2></a>
  <div class="btn-group" role="group" aria-label="Button group with nested dropdown" style="position: absolute; right: 0px; padding-right: 1rem">
    <h5 style="color: white">{{ $opName }} </h5>
      <div class="dropdown" style="float:right;">
        <button class="dropbtn">▼</button>
        <div class="dropdown-content">
          <a onClick="logout(); return false" href="#">Logout</a>
        </div>
      </div>
    </div>
  </div>
</nav>
  @yield('content')
</body>
<script type="text/javascript" src="{{URL::asset('js/menu.js')}}"></script>
</html>