@extends('master')
@section('content')

<h1>Software Information (Asset ID: <b>{{$software->sw_assetid}}</b> ) </h1>

<div class="btn-group">
  <button type="button" class="btn btn-theme dropdown-toggle" data-toggle="dropdown" style="display:inline-block">
    Action <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    @if($software->sw_status == '1')
    <li><a href="{{action('SwRecordController@uninstallform', $software->id)}}">Uninstall from current device</a></li>
    @else
    <li><a href="{{action('SwRecordController@installform', $software->id)}}">Install to device</a></li>
    @endif
    <li><a href="{{action('SoftwareController@edit', $software->id)}}">Edit Software Information</a></li>

    {!! Form::open(['method' => 'DELETE','route' => ['software.destroy', $software->id],'style'=>'display:inline-block','id'=>'deleteform']) !!}
    {!! Form::close() !!}
    <li><a href="#"><button value="Delete" id="delete" class="btn btn-danger btn-sm">Delete Software</button></a></li>
  </ul>
</div>
<a href="{{ action('SoftwareController@index') }}" class="btn btn-default">Back</a>
<hr>

<!-- CURRENT STATUS SECTION -->

@if($software->sw_status == 0)
<div class="showback">
  <h2>Current Status: <button type="button" class="btn btn-round btn-primary">Available</button></h2>
</div>
@else
<?php $latestuser = DB::table('swrecord')->where('sw_assetid', $software->id)->orderBy('created_at', 'desc')->first(); //get record of latest user
      $hardware = DB::table('hardware')->where('id',$latestuser->hw_assetid)->first()?>
<h2>Current Status: <button type="button" class="btn btn-round btn-warning">In Use</button></h2>
<div class="showback">
  <h3>Installed in</h3>
  <table class="table table-condensed table-bordered">
    <tr><td><b>Device Name</b></td><td>{{$hardware->hw_model}}</td></tr>
    <tr><td><b>Serial Number</b></td><td><a href="{{action('RecordController@show', $hardware->id)}}">{{$hardware->hw_serialno}}</a></td></tr>
    <tr><td><b>Device Asset ID</b></td><td>{{$hardware->hw_assetid}}</td></tr>
    <tr><td><b>Date Installed</b></td><td>{{date('jS F Y', strtotime($latestuser->created_at))}}</td></tr>
    <tr><td><b>Remarks</b></td><td>{{$latestuser->remark}}</td></tr>
  </table>
</div>
@endif

<!-- FULL SOFTWARE INFORMATION SECTION -->
<div class="showback">
  <h2>Full Software Information</h2>
  <table class="table table-condensed table-bordered">
      <tr><td><b>Asset ID</b></td><td>{{$software->sw_assetid}}</td></tr>
      <tr><td><b>Serial Number</b></td><td>{{$software->sw_serialno}}</td></tr>
      <tr><td><b>Product Key</b></td><td>{{$software->sw_prodkey}}</td></tr>
      <tr><td><b>Software Name</b></td><td>{{$software->sw_model}}</td></tr>
      <tr><td><b>Software Type</b></td><td>{{$software->sw_type}}</td></tr>
      <tr><td><b>Price</b></td><td>RM {{$software->sw_price}}</td></tr>
      <tr><td><b>Purchase Order Number</b></td><td>{{$software->sw_po_no}}</td></tr>
      <tr><td><b>Purchase Order Date</b></td>
        @if(($software->sw_date_po) == '0000-11-30 00:00:00')
        <td>Unspecified</td>
        @else
        <td>{{ $software->sw_date_po->format('d/m/Y') }}</td>
        @endif</tr>

      <tr><td><b>Date Supplied</b></td>
        @if(($software->sw_datesupp) == '0000-11-30 00:00:00')
        <td>Unspecified</td>
        @else
        <td>{{ $software->sw_datesupp->format('d/m/Y') }}</td>
        @endif</tr>

      <tr><td><b>Date Received by GIT</b></td>
        @if(($software->sw_datefac) == '0000-11-30 00:00:00')
        <td>Unspecified</td>
        @else
        <td>{{ $software->sw_datefac->format('d/m/Y') }}</td>
        @endif</tr>

      <tr><td><b>Supplied By</b></td><td>{{DB::table('supplier')->where('id',$software->sw_supplier)->value('supp_name')}}</td></tr>
      <tr><td><b>Remarks</b></td><td>{{$software->sw_remark}}</td></tr>
      @if($software->sw_variation == 1)
      <tr><td><b>Package</b></td><td>OEM</td></tr>
      @else
      <tr><td><b>Package</b></td><td>Retail</td></tr>
      @endif
  </table>
</div>

<!-- TRANSFER LOG SECTION -->
<?php $prevuser = DB::table('swrecord')->where('sw_assetid', $software->id)->where('status',1)->get();?>
@if($prevuser->isEmpty())
<div class="alert alert-info"><b>Info:</b> There are no previous user recorded.</div>
@else
<div class="showback">
<h2>Previous Installation</h2>
<table class="table table-condensed">
  <thead><tr>
    <th>Ref#</th>
    <th>Date Installed</th>
    <th>Installed in</th>
    <th>Remark</th>
    <th>Date Software Released</th>
  </tr></thead>
  <tbody>
    @foreach($prevuser as $pu)
    <tr>
      <td> {{$pu->id}} </td>
      <td> {{date('jS F Y', strtotime($pu->created_at))}} </td>
      <td> {{ DB::table('hardware')->where('id', $pu->hw_assetid)->value('hw_model')}} </td>
      <td> {{$pu->remark}} </td>
      @if($pu->created_at == $pu->updated_at)
        <td></td>
      @else
      <td> {{date('jS F Y', strtotime($pu->updated_at))}} </td>
      @endif
    </tr>
    @endforeach
  </tbody>
</table>
@endif
</div>

@stop
