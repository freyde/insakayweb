@extends('layout.nav')
@section('content')

<div class="main-container p3 ml-3 mt-3" style="height: 85%; overflow-y: scroll">
<h3 class="font-weight-bolder">Route's Information</h3>
  <div>
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
  <hr>
  <div class="mt-4">
  <h3 class="font-weight-bolder float-left ml-3 mt-3 mb-2">List of Landmarks</h3>
      <button id="addLand" type="button" class="btn btn-success float-right mb-1">Add Landmark</button>
  </div>

  <div>
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
</div>


<!------------------------------------------- Modals ---------------------------------------------->
<div class="modal modal-backdrop" id="addLandmarkModal">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title font-weight-bolder">Add Landmark</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="row p-3">
        <div class="col-4">
          <div style="height: 37%; overflow-y:scroll">
            <table id="coverageList" class="table-hover">
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
                    <td id="{{ $coverage['name'] }}" onclick="coverageSelected(this.id)" class="covContainer font-weight-lighter small">{{ $coverage['name']}}</td>
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
              <input id="addLandClose" type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel">
              <button id="addLandmark" type="button" class="btn btn-primary">Add Landmark</button>
              <div id="loader" class="float-right mt-1 mr-5" style="display:none">
                <div class="spinner-border spinner-border-sm text-primary"></div>
                <label id="status" class="font-weight-bold text-primary">Saving...</label>
              </div>
              <div id="done" class="float-right mt-1 mr-5 pr-3" style="display:none">
                <label id="status" class="font-weight-bold text-success">Done!</label>
              </div>
            </div>
          </div>
        </div>

        <div class="col-8">
          <div id="mapAddLandmark" style="background-color:gray; width: 100%; height: 30rem;"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal modal-backdrop" id="ep1Modal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="width: 35rem">
      <div class="modal-header">
        <h4 class="modal-title font-weight-bolder">Set End Point-1</h4>
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
            <td id="ep1-{{ $coverage['name'] }}" onclick="ep1Selected(this.id)" class="ep1Cov pl-3">{{ $coverage['name']}}</td>
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
</div>

<div class="modal modal-backdrop" id="ep2Modal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="width: 35rem">
      <div class="modal-header">
        <h4 class="modal-title font-weight-bolder">Set End Point-2</h4>
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
              <td id="ep2-{{ $coverage['name'] }}" onclick="ep2Selected(this.id)" class="ep2Cov pl-3">{{ $coverage['name']}}</td>
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
</div>

<div id="epLoader" class="modal modal-backdrop">
  <div class="spinner-border text-primary mx-auto fixed-top" style="margin-top: 22%;"></div>
</div>


<script type="text/javascript" src="{{URL::asset('js/landmark.js')}}"></script>
<!-- <script type="text/javascript" src="{{URL::asset('js/manageRoute.js')}}"></script> -->
@stop
</html>