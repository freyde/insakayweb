@extends('layout.nav')
@section('content')

<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="/conductors">Conductors</a></li>
  <li class="breadcrumb-item"><a href="/buses">Buses</a></li>
  <li class="breadcrumb-item"><a href="/routes">Route</a></li>
  <li class="breadcrumb-item"><a href="/fare">Fare</a></li>
  <li class="breadcrumb-item"><a href="/reports">Reports</a></li>
</ol>

<input type="button" class="btn btn-success" value="Add Route" id="addRouteBtn">
<br><br>
<div class="view" id="" style="width: 60rem; margin-left: 3rem">
<table class="table table-hover">
@if($routes != null) 
  
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Coverage Count</th>
          <th>Landmark Count</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      @foreach($routes as $route)
        <tr>
          <td>{{ $route['routeID'] }}</td>
          <td>{{ $route['routeName'] }}</td>
          <td>{{ count($route['coverage']) }}</td>
          <td>{{ $route['landmarkCount'] }}</td>
          <td>
            <form action="{{URL::to('/routes/manage/'. $route['routeID'])}}" method="get">
              <input type="submit" class="btn btn-success map-btn" value="Manage"></input>
            </form>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
@else
  No Routes Found
@endif

<script type="text/javascript" src="{{URL::asset('js/firebase.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/routes.js')}}"></script>

</body>
@stop