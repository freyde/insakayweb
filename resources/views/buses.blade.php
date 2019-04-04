@extends('layout.nav')
@section('content')

<h3 class="font-weight-bolder ml-3 mt-3">Buses List</h3>
<input type="submit" class="btn btn-primary float-right mb-2 mr-3" value="＋Bus" id="addBs">

<div class="main-container p-3">
@if($buses != null)
<table class="table">
  <thead>
  <tr>
      <th scope="col">Bus No.</th>
      <th scope="col">Driver Name</th>
      <th scope="col">Plate No.</th>

  </tr>
  </thead>
  <tbody>
  @foreach($buses as $bus)
      <tr>
          <td>{{ $bus['busNo'] }}</td>
          <td>{{ $bus['driverName'] }}</td>
          <td>{{ $bus['plateNo'] }}</td>
      </tr>  
  @endforeach
  </tbody>
</table> 
</div>
@else
<table class="table">
  <thead>
      <tr align="center">
          <th>No Registered Bus</th>
      </tr>
  </thead>
</table>
@endif

<div class="modal modal-backdrop" id="addBusModal">
  <div id="loader" class="spinner-border text-primary mx-auto fixed-top" style="margin-top: 13%; display: none"></div>
  <div id="dialog" class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Bus</h5>
        <button id="addBUsClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <label class="col-form-label col-form-label-sm" for="inputSmall">Driver's Name</label>
        <input class="form-control form-control-sm" type="text" placeholder="Full Name" id="dName">

        <label class="col-form-label col-form-label-sm" for="inputSmall">Bus Plate Number</label>
        <input class="form-control form-control-sm" type="text" placeholder="Registered Plate Number" id="pNumber">
      </div>
      <div class="modal-footer">
        <button id="addBus" type="button" class="btn btn-primary">Add</button>
        <button id="addBusClose" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="{{URL::asset('js/bus.js')}}"></script>
@stop
</html>

