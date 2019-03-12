@extends('layout.adminnav')
@section('content')

<ol class="breadcrumb">
<h5>Welcome {{ $uid }} </h5>
  <li class="breadcrumb-item"><a href="/admin/operators">Operators</a></li>
</ol>
<h3>{{ $infos['shortName'] }}</h3>
<br>

@if($infos != null)
<div style="width: 50rem">
    <div class="operator-detials-main">
        <h4>Operator Details</h4>
        <div class="operator-details">
            Operator Name
            <input class="form-control" id="operatorName" type="text" disabled="" value="{{ $infos['operatorName'] }}">
            Owner Name
            <input class="form-control" id="ownerName" type="text" disabled="" value="{{ $infos['firstName']. ' ' .$infos['lastName']}}">
            Operator ID
            <input class="form-control" id="operatorID" type="text" disabled="" value="{{ $infos['operatorID'] }}">
            <br>
            <input type="button" class="btn btn-success" value="Edit"></input>
        </div>
    </div>

    <div class="operation-details-main">
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
</div>
@endif


@stop
</body>
</html>