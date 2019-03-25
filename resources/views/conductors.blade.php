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


<div class="contents">
<input type="button" class="btn btn-success" value="＋Conductor" id="addCond">
</div>

<div class="modal" id="addCondModal">
  <div class="modal-dialog" role="document">
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

<div class="main-container">
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
          <th>No Conductors Found</th>
      </tr>
  </thead>
</table>
@endif
</div>

</body>
<script type="text/javascript" src="{{URL::asset('js/conductor.js')}}"></script>
@stop
</html>

