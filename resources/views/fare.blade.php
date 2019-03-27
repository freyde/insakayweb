@extends('layout.nav')
@section('content')

<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="/conductors">Conductors</a></li>
  <li class="breadcrumb-item"><a href="/buses">Buses</a></li>
  <li class="breadcrumb-item"><a href="/routes">Route</a></li>
  <li class="breadcrumb-item"><a href="/fare">Fare</a></li>
  <li class="breadcrumb-item"><a href="/reports">Reports</a></li>
</ol>
<h5>Fare Management</h5>
<hr>
List of routes
<div class="main-container">
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
              <form action="{{URL::to('/fare/manage/'. $route['routeID'])}}" method="get">
                <input type="submit" class="btn btn-success map-btn" value="Fare Matrix"></input>
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
</div>

@stop

