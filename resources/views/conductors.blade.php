@extends('layout.nav')
@section('content')

<h3 class="font-weight-bolder  ml-3 mt-3">Conductors List</h3>
<input type="button" class="btn btn-primary float-right mb-2 mr-3" value="＋Conductor" id="addCond">
<div class="main-container p-3">
@if($conductors != null)
<table class="table">
  <thead>
  <tr>
      <th scope="col">Conductor ID</th>
      <th scope="col">First Name</th>
      <th scope="col">Phone Number</th>

  </tr>
  </thead>
  <tbody>
  @foreach($conductors as $conductor)
      <tr>
          <td>{{ $conductor['conductorNo'] }}</td>
          <td>{{ $conductor['name'] }}</td>
          <td>{{ $conductor['phoneNo'] }}</td>
      </tr>  
  @endforeach
  </tbody>
</table> 
@else
<table class="table">
  <thead>
      <tr align="center">
          <th>No Registered Conductor</th>
      </tr>
  </thead>
</table>
@endif
</div>

<div class="modal modal-backdrop" id="addCondModal">
  <div id="loader" class="spinner-border text-primary mx-auto fixed-top" style="margin-top: 13%; display: none"></div>
  <div id="dialog" class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Conductor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label class="col-form-label col-form-label-sm" for="inputSmall">Conductor's Name</label>
        <input class="form-control form-control-sm" type="text" placeholder="Full Name" id="name"></input>

        <label class="col-form-label col-form-label-sm" for="inputSmall">Conductor's Number</label>
        <input class="form-control form-control-sm" type="text" placeholder="Cellphone Number" id="number"></input>

        <label class="col-form-label col-form-label-sm" for="inputSmall">Conductor's Password</label>
        <input class="form-control form-control-sm" type="password" placeholder="Password" id="password"></input>
        <input class="form-control form-control-sm" type="password" placeholder="Confirm Password" id="confirmPass"></input>

        <input type="hidden" name="_token" value="{{ Session::token() }}">
      </div>
      <div class="modal-footer">
        <button id="addConductor" type="button" class="btn btn-primary">Add</button>
        <button id="addCondClose" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
</body>
<script type="text/javascript" src="{{URL::asset('js/conductor.js')}}"></script>
@stop
</html>