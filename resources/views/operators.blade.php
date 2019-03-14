@extends('layout.adminnav')
@section('content')

<body>
<ol class="breadcrumb">
<h5>Welcome {{ $uid }} </h5>
  <li class="breadcrumb-item"><a href="/admin/operators">Operators</a></li>
</ol>
<div class="content">
<input type="button" class="btn btn-secondary" value="＋Operator" id="addOp">
</div>

<div class="modal" id="addOpModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Conductor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <label class="col-form-label col-form-label-sm" for="inputSmall">Operator's Name</label>
        <input class="form-control form-control-sm" type="text" placeholder="Full Name" id="fName"></input>
        <input class="form-control form-control-sm" type="text" placeholder="Short Name" id="sName"></input>

        <label class="col-form-label col-form-label-sm" for="inputSmall">Owner's Name</label>
        <input class="form-control form-control-sm" type="text" placeholder="First Name" id="firstName"></input>
        <input class="form-control form-control-sm" type="text" placeholder="Last name" id="lastName"></input>

        <label class="col-form-label col-form-label-sm" for="inputSmall">Email</label>
        <input class="form-control form-control-sm" type="text" placeholder="Email Address" id="email"></input>

        <label class="col-form-label col-form-label-sm" for="inputSmall">Password</label>
        <input class="form-control form-control-sm" type="password" placeholder="Password" id="pass"></input>

        <label class="col-form-label col-form-label-sm" for="inputSmall">Confirm Password</label>
        <input class="form-control form-control-sm" type="password" placeholder="Confirm Password" id="cpass"></input>

        <label class="col-form-label col-form-label-sm" for="inputSmall">Management Key</label>
        <input class="form-control form-control-sm" type="password" placeholder="Confirm Password" id="key"></input>
        
        <input type="hidden" name="_token" value="{{ Session::token() }}">
      </div>
      <div class="modal-footer">
        <button id="addOperator" type="button" class="btn btn-primary">Add Operator</button>
        <button id="addOpClose" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="main-container">
@if($operators != null)
<table class="table table-hover">
  <thead>
  <tr>
      <th scope="col">Email Address</th>
      <th scope="col">User ID</th>
      <th></th>
  </tr>
  </thead>
  <tbody>
  @foreach($operators as $operator)
      <tr>
        @if($operator[0]['uid'] != 'kNZ24FppcNS7o8fp2lev7b7zIet1') 
          <td>{{ $operator[0]['email'] }}</td>
          <td>{{ $operator[0]['uid'] }}</td>
          <form action="{{URL::to('/admin/manage/'. $operator[0]['uid'])}}" method="get">
          <td><input type="submit" class="btn btn-success" value="Manage"></input></td>
          </form>
        @endif
      </tr>  
  @endforeach
  </tbody>
</table> 
else
<table class="table">
  <thead>
      <tr align="center">
          <th>No Operators Found</th>
      </tr>
  </thead>
</table>
@endif
</div>


<script type="text/javascript" src="{{URL::asset('js/index.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/firebase.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/operator.js')}}"></script>
@stop
</body>
</html>
