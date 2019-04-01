@extends('layout.nav')
@section('content')

<h3 class="font-weight-bolder ml-3 mt-3">Fare Management</h3>

<div class="main-container p-3">
  <table class="table table-hover">
  @if($routes != null) 
    
        <thead>
          <tr>
            <th>Route ID</th>
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
</html>