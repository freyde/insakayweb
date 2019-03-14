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
    <!--The div element for the map -->
    <input id="count" value="{{ $count }}" type="hidden">
<select id="routes" class="dropdown-list">
  <option value="">-Select Route-</option>
  @if($routes != null) 
    @foreach($routes as $route)
      <option value="{{ $route['routeName'] }}">{{ $route['routeName'] }}</option>
    @endforeach
</select>

<input type="button" class="btn btn-success" value="Add Route" id="addRouteBtn">

<br>
  @foreach($routes as $route)
    <input class="name" value="{{ $route['routeName'] }}" type="hidden">
    <input id="{{ $route['routeName'] }}_p1Lat" value="{{ $route['point1Lat'] }}" type="hidden">
    <input id="{{ $route['routeName'] }}_p1Long" value="{{ $route['point1Long'] }}" type="hidden">
    <input id="{{ $route['routeName'] }}_p2Lat" value="{{ $route['point2Lat'] }}" type="hidden">
    <input id="{{ $route['routeName'] }}_p2Long" value="{{ $route['point2Long'] }}" type="hidden">
  @endforeach

<div id="map" class="route-map-view" style="width: 60rem; margin-left:3rem"></div>

  @foreach($routes as $route)
  <div class="view" id="{{ $route['routeName'] }}" style="width: 60rem; margin-left: 3rem; display: none">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>EP-1</th>
          <th>EP-2</th>
          <th>Landmark Count</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ $route['routeID'] }}</td>
          <td>{{ $route['routeName'] }}</td>
          <td>{{ $route['point1Name'] }}</td>
          <td>{{ $route['point2Name'] }}</td>
          <td>{{ $route['landmarkCount'] }}</td>
          <td>
            <form action="{{URL::to('/routes/manage/'. $route['routeID'])}}" method="get">
              <input type="submit" class="btn btn-success map-btn" value="Manage"></input>
            </form>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  @endforeach
@endif

<script type="text/javascript" src="{{URL::asset('js/firebase.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/routes.js')}}"></script>

</body>
@stop