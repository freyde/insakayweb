@extends('layout.nav')
@section('content')

<body>

<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="/conductors">Conductors</a></li>
  <li class="breadcrumb-item"><a href="/buses">Buses</a></li>
  <li class="breadcrumb-item"><a href="/routes">Route</a></li>
  <li class="breadcrumb-item"><a href="/fare">Fare</a></li>
  <li class="breadcrumb-item"><a href="/reports">Reports</a></li>
</ol>
<h5>Buses List</h5>
<hr>
<div class="contents" style="float: right; right: 1rem">
<input type="submit" class="btn btn-success" value="＋Bus" id="addBs">
</div>

<div class="modal" id="addBusModal">
  <div class="modal-dialog" role="document">
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

<div class="main-container">
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
          <th>No Operators Found</th>
      </tr>
  </thead>
</table>
@endif
</body>
<script type="text/javascript" src="{{URL::asset('js/bus.js')}}"></script>
@stop
</html>

