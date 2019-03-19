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

<div style="display: block">
  <h3>Route Information</h3>
  <button id="addCov" type="button" class="btn btn-secondary" style="float: right">Add Coverage</button>
</div>

<div style="display: block">
    <table class="table">
        <thead>
            <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Coverage Count</th>
            <th>Landmark Count</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td>{{ $infos['routeID'] }}</td>
            <td>{{ $infos['routeName'] }}</td>
            <td>{{ count($infos['coverage']) }}</td>
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
    @if($infos['landmarkCount'] > 0)
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

<div class="modal" id="addLandmarkModal">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Add Landmark</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <div style="width: 100%; height: 100%">
      <div style="float: left; width: 60%;">
        <div style="height: 25rem">
          <!-- <form action="#">
            <input class="form-control form-control-sm" type="text" placeholder="Search City or Municipality" id="searchbox" style="float: left; width: 80%"></input>
            <input type="submit" value="Search" style="margin-left: 1rem" id="searchBtn">
          </form> -->
          <table id="coverageList" style="width: 100%; margin-top: 1rem" class="table-hover">
            <thead>
              <tr>
                <th>List of Coverage</th>
              </tr>
            </thead>
            <tbody>
            @foreach($infos['coverage'] as $coverage)
              <tr>
                <td onclick="coverageSelected(this.id)" id="{{$coverage['name']}}">{{ $coverage['name'] }}</td>
                <input type="hidden" value="$coverage['name']">
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div style="width: 100%; height: 100%">
        <div id="mapAddLandmark" style="background-color:gray; width: 40%; height: 30rem;"></div>
      </div>
    </div>
    <div class="modal-footer">
      <button id="addLandmark" type="button" class="btn btn-primary">Add Landmark</button>
      <button id="addLandClose" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    </div>
  </div>
</div>

<div id='map' style=" top:0; bottom:0; width:100%; }"></div>


<script type="text/javascript" src="{{URL::asset('js/landmark.js')}}"></script>
<!-- <script type="text/javascript" src="{{URL::asset('js/manageRoute.js')}}"></script> -->
@stop