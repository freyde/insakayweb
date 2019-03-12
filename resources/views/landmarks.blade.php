@extends('layout.nav')
@section('content')

<ol class="breadcrumb">
<h5>Welcome {{ $uid }}</h5>
  <li class="breadcrumb-item"><a href="/conductors">Conductors</a></li>
  <li class="breadcrumb-item"><a href="/buses">Buses</a></li>
  <li class="breadcrumb-item"><a href="/routes">Route</a></li>
  <li class="breadcrumb-item"><a href="#">Fare</a></li>
  <li class="breadcrumb-item"><a href="#">Reports</a></li>
</ol>

<div><h3>Route Information</h3></div>

<div class="modal" id="addLandmarkModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Landmark</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <label class="col-form-label col-form-label-sm" for="inputSmall">Landmark's Name</label>
        <input class="form-control form-control-sm" type="text" placeholder="Name" id="lName"></input>

        <label class="col-form-label col-form-label-sm" for="inputSmall">Coordinates</label>
        <input class="form-control form-control-sm" type="text" placeholder="Latitude" id="lat"></input>
        <input class="form-control form-control-sm" type="text" placeholder="Longitude" id="lng"></input>

        <label class="col-form-label col-form-label-sm" for="inputSmall">Coverage of</label>
        <input class="form-control form-control-sm" type="text" placeholder="Place" id="coverage"></input>

        <input type="hidden" name="_token" value="{{ $infos['routeID'] }}" id="rID">
        <input type="hidden" name="_token" value="{{ Session::token() }}">
      </div>
      <div class="modal-footer">
        <button id="addLandmark" type="button" class="btn btn-primary">Add Landmark</button>
        <button id="addLandClose" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div style="display: block">
    <table class="table">
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
            <td>{{ $infos['routeID'] }}</td>
            <td>{{ $infos['routeName'] }}</td>
            <td>{{ $infos['point1Name'] }}</td>
            <td>{{ $infos['point2Name'] }}</td>
            <td>{{ $infos['landmarkCount'] }}</td>
            </tr>
        </tbody>
    </table>
</div>
<div style="display: block">
    <h3 style="float: left">List of Landmarks</h3>
    <button id="addLand" type="button" class="btn btn-secondary" style="float: right">Add Landmark</button>
</div>

<div style="display: block; float: left: width:100%">
    @if($infos['landmarkCount'] != 0)
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Coverage of</th>
            </tr>
        </thead>
        <tbody>
            @foreach($landmarks as $landmark)
            <tr>
                <td>{{ $landmark['landmarkID'] }}</td>
                <td>{{ $landmark['landmarkName'] }}</td>
                <td>{{ $landmark['latitude'] }}</td>
                <td>{{ $landmark['longitude'] }}</td>
                <td>{{ $landmark['coverage'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <table class="table">
        <thead>
            <tr align="center">
                <th>No Landmarks Found</th>
            </tr>
        </thead>
    </table>
    @endif
</div>


<script type="text/javascript" src="{{URL::asset('js/landmark.js')}}"></script>
@stop