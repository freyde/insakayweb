@extends('layout.nav')
@section('content')

<ol class="breadcrumb">
<h5>Welcome {{ $uid }}</h5>
  <li class="breadcrumb-item"><a href="/conductors">Conductors</a></li>
  <li class="breadcrumb-item"><a href="/buses">Buses</a></li>
  <li class="breadcrumb-item"><a href="/routes">Route</a></li>
  <li class="breadcrumb-item"><a href="/fare">Fare</a></li>
  <li class="breadcrumb-item"><a href="/reports">Reports</a></li>
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
            <th>End Point 1</th>
            <th>End Point 2</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td>{{ $infos['routeID'] }}</td>
            <td>{{ $infos['routeName'] }}</td>
            <td>{{ count($infos['coverage']) }}</td>
            <td>{{ $infos['landmarkCount'] }}</td>
            <td>
              @if($infos['endPoint1'] == "none")
                <input class="form-control form-control-sm" readonly="true" type="text" placeholder="Click to choose end point 1" id="ep1"></input>
              @else
                <input class="form-control form-control-sm" readonly="true" type="text" placeholder="Click to choose end point 1" id="ep1" value="{{ $infos['endPoint1'] }}"></input>
              @endif
            </td>
            <td>
              @if($infos['endPoint2'] == "none")
                <input class="form-control form-control-sm" readonly="true" type="text" placeholder="Click to choose end point 2" id="ep2"></input>
              @else
              <input class="form-control form-control-sm" readonly="true" type="text" placeholder="Click to choose end point 1" id="ep2" value="{{ $infos['endPoint2'] }}"></input>
              @endif
            </td>
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
                @foreach($landmark['coordinate'] as $coord)
                <td>{{$coord}}</td>
                @endforeach
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
      <div style="float: left; width: 40%;">
        <div style="height: 15rem">
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
            <input type="hidden" value="{{ $routeID }}" id="routeID">
            <input type="hidden" value="{{ $uid }}" id="uid">
            @foreach($infos['coverage'] as $coverage)
              <tr>
                <td id="{{ $coverage['name'] }}" onclick="coverageSelected(this.id)" class="covContainer">{{ $coverage['name']}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
          
        </div>
        <div>
          <b>Landmark</b><br>
          <div style="padding-right: 1rem">
            <label class="col-form-label col-form-label-sm" for="inputSmall">Name</label>
            <input class="form-control form-control-sm" type="text" placeholder="Landmark Name" id="lmarkName"></input>
            <label class="col-form-label col-form-label-sm" for="inputSmall">Coordinate</label>
            <input class="form-control form-control-sm" type="text" placeholder="Latitude" id="lmarkLat" readonly="true"></input>
            <input class="form-control form-control-sm" type="text" placeholder="Longitude" id="lmarkLng" readonly="true"></input>
            <br>
            <button id="addLandClose" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button id="addLandmark" type="button" class="btn btn-primary">Add Landmark</button>
          </div>
        </div>
      </div>
      <div style="width: 100%; height: 100%">
        <div id="mapAddLandmark" style="background-color:gray; width: 60%; height: 30rem;"></div>
      </div>
    </div>
    <div class="modal-footer">
  
    </div>
  </div>
</div>

<div id='map' style=" top:0; bottom:0; width:100%; }"></div>

<div class="modal" id="ep1Modal">
  <div class="modal-content" style="width: 35rem">
    <div class="modal-header">
      <h5 class="modal-title">End Point 1</h5>
    </div>
    <div class="modal-body">
      <table id="coverageList" style="width: 100%;" class="table-hover">
        <thead>
          <tr>
            <th>List of Coverage</th>
          </tr>
        </thead>
        <tbody>
      @foreach($infos['coverage'] as $coverage)
        <tr>
          <td id="ep1-{{ $coverage['name'] }}" onclick="ep1Selected(this.id)" class="ep1Cov">{{ $coverage['name']}}</td>
        </tr>
      @endforeach
        </tbody>
      </table>
    </div>
    <div class="modal-footer">
      <button id="ep1ModalClose" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      <button id="ep1ModalDone" type="button" class="btn btn-primary">Done</button>
    </div>
  </div>
</div>

<div class="modal" id="ep2Modal">
  <div class="modal-content" style="width: 35rem">
    <div class="modal-header">
      <h5 class="modal-title">End Point 2</h5>
    </div>
    <div class="modal-body">
      <table id="coverageList" style="width: 100%;" class="table-hover">
        <thead>
          <tr>
            <th>List of Coverage</th>
          </tr>
        </thead>
        <tbody>
      @foreach($infos['coverage'] as $coverage)
        <tr>
          <td id="ep2-{{ $coverage['name'] }}" onclick="ep2Selected(this.id)" class="ep2Cov">{{ $coverage['name']}}</td>
        </tr>
      @endforeach
        </tbody>
      </table>
    </div>
    <div class="modal-footer">
      <button id="ep2ModalClose" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      <button id="ep2ModalDone" type="button" class="btn btn-primary">Done</button>
    </div>
  </div>
</div>


<script type="text/javascript" src="{{URL::asset('js/landmark.js')}}"></script>
<!-- <script type="text/javascript" src="{{URL::asset('js/manageRoute.js')}}"></script> -->
@stop