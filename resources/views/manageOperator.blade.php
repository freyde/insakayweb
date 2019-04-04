@extends('layout.adminnav')
@section('content')

@if($infos != null)
<input type="hidden" name="_token" value="{{ Session::token() }}">
<h3 class="font-weight-bolder  ml-3 mt-3">{{ $infos['operatorName'] }}</h3>
<div class="main-container mb-3">
    <div class="w-50 float-left p-3">
        <h4>Operator Details</h4>
        <input type="hidden" id="uid" value="{{ $infos['uid'] }}">
        Operator Name
        <input class="form-control" id="operatorName" type="text" disabled="" value="{{ $infos['operatorName'] }}">
        Owner Name
        <input class="form-control" id="ownerName" type="text" disabled="" value="{{ $infos['firstName']. ' ' .$infos['lastName']}}">
        Operator ID
        <input class="form-control" id="operatorID" type="text" disabled="" value="{{ $infos['operatorID'] }}">
     </div>


    <div class="w-50 float-right p-3">
        <h4>Operation Details</h4>
        <div class="operation-details">
            No. of Bus(es)
            <input class="form-control" id="disabledInput" type="text" disabled="" value="{{ $infos['busCount'] }}">
            No. of Conductor(s)
            <input class="form-control" id="disabledInput" type="text" disabled="" value="{{ $infos['conductorCount'] }}">
            No. of Route(s)
            <input class="form-control" id="routeCount" type="text" disabled="" value="{{ $infos['routeCount'] }}">
        </div>
    </div>
    <div class="float-right pr-3">
        <input id="delete" type="button" class="btn btn-danger" value="Delete"></input>
    </div>
</div>
@endif

<div class="modal modal-backdrop" id="loader">
    <div id="loader" class="spinner-border text-primary mx-auto fixed-top" style="margin-top: 15%;"></div>
</div>

<div class="modal modal-backdrop" id="deleteModal">
    <div id="dialog" class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Are you sure?</h5>
            </div>
            <div class="modal-body">
                <div class="float-right">
                    <input id="deleteCancel" type="button" class="btn btn-secondary" value="Cancel"></input>
                    <input id="deleteConfirm" type="button" class="btn btn-primary" value="Ok"></input>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{URL::asset('js/manageOperator.js')}}"></script>
@stop
</html>