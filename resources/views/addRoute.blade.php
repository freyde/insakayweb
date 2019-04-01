@extends('layout.nav')
@section('content')


<!-------------------------------------MAIN DIV------------------------------------------>
<div class="container">
  <h3 class="font-weight-bolder ml-3 mt-3">Add Route</h3>

  <div class="row">
<!------------------------------------ LEFT DIV ---------------------------------------->
    <div class="col-md-4">
      <label class="col-form-label col-form-label-sm" for="inputSmall">Route Name</label>
      <input class="form-control form-control-sm" type="text" placeholder="" id="routeName"></input>
      <hr>
      <label class="col-form-label col-form-label-sm" for="inputSmall">Coverage</label>
      <table id="coverage">
        <thead>
          <tr>
            <th class="w-100">
            <input class="btn btn-success p-1" type="button" id="addRow" value="add">
            </th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
<!------------------------------------- RIGHT DIV ------------------------------------------------>
    <div class="col-md-8">
      <div id="mapMain" style="background-color:gray ;width: 100%; height: 70%;"></div>
    </div>
  </div>

  <div class="float-right mt-2">
      <input type="button" class="btn btn-secondary" value="Cancel" id="cancelAddRoute"></input>
      <input type="button" class="btn btn-success" value="Save Route" id="saveRoute"></input>
  </div>
</div>

<!-- The Modal -->
<div id="addCoverage" class="modal modal-backdrop">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Add Coverage to Route</h3>
        <span class="close">&times;</span>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-5">
            <input class="form-control form-control-sm w-75 float-left" type="text" placeholder="Search Barangay" id="searchbox">
            <input class="btn btn-success ml-2 pt-0 pb-0" type="button" value="Search"  id="searchBtn">
            <table id="searchResult" class="table-hover float-left mt-3">
              <tbody>
              </tbody>
            </table>
          </div>

          <div class="col-md-7">
            <div id="mapAdd" style="background-color:gray; width: 100%; height: 65%;"></div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="addCov" type="button" class="btn btn-primary">Save</button>
        <button id="addCovClose" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div id="loader" class="modal modal-backdrop">
  <div class="spinner-border text-primary mx-auto fixed-top" style="margin-top: 20%;"></div>
</div>

<script type="text/javascript" src="{{URL::asset('js/firebase.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/addroute.js')}}"></script>
@stop
</html>