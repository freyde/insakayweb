@extends('layout.nav')
@section('content')

<h3 class="font-weight-bolder  ml-3 mt-3">Routes List</h3>
<input type="button" class="btn btn-primary float-right mb-2 mr-3" value="Add Route" id="addRouteBtn">

<div class="main-container p-3">
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
@stop
</html>