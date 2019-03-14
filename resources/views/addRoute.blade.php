@extends('layout.nav')
@section('content')

<ol class="breadcrumb">
<h5>Welcome {{ $uid }} </h5>
  <li class="breadcrumb-item"><a href="/conductors">Conductors</a></li>
  <li class="breadcrumb-item"><a href="/buses">Buses</a></li>
  <li class="breadcrumb-item"><a href="/routes">Route</a></li>
  <li class="breadcrumb-item"><a href="#">Fare</a></li>
  <li class="breadcrumb-item"><a href="#">Reports</a></li>
</ol>

<!-- The Modal -->
<div id="addCoverage" class="modal">

  <!-- Modal content -->
  <div class="modal-content" style="height: 40rem; z-index: 2">
    <span class="close">&times;</span>
    <div style="width: 100%; height: 100%">
    test
      <div id="mapAdd" style="background-color:gray; width: 100%; height: 40rem; z-index: 1;"></div>
      test
    </div>
  </div>

</div>


<div style="width: 100%; height: 100%">
<!------------------------------------ LEFT DIV ---------------------------------------->
  <div style="width: 35rem; border: solid; padding: 1rem; margin: 1rem; float: left">
    <label class="col-form-label col-form-label-sm" for="inputSmall">Route Name</label>
    <input class="form-control form-control-sm" type="text" placeholder="" id=""></input>
    <hr>
    <label class="col-form-label col-form-label-sm" for="inputSmall">Coverage</label>
    <table id="coverage">
      <thead>
        <tr>
          <th>
          <input type="button" height="20" width="20" id="addRow" value="add" style="border-radius: 10px">
          </th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>

<!------------------------------------- RIGHT DIV ------------------------------------------------>
  <div style="width: 45rem; height: 35rem; border: solid; padding: 1rem; margin: 1rem; float: left; z-index: 1">
    <div id="mapMain" style="background-color:gray ;width: 100%; height: 100%;"></div>
  </div>
</div>
<script type="text/javascript" src="{{URL::asset('js/firebase.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/addroute.js')}}"></script>

@stop