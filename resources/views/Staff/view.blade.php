@extends('master')
@section('content')
@include('Alerts::sweetalerts')
<h1>{{$staff->staff_name}} - {{$staff->staff_id}}
<div class="btn-group">
  <button type="button" class="btn btn-theme dropdown-toggle" data-toggle="dropdown" style="display:inline-block">
    Action <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="{{action('StaffController@edit', $staff->id)}}">Edit Staff Information</a></li>
    {!! Form::open(['method' => 'DELETE','route' => ['staff.destroy', $staff->id],'style'=>'display:inline-block','id'=>'deleteform']) !!}
    {!! Form::close() !!}
    <li role="separator" class="divider"></li>
    <li><a href="#"><button value="Delete" id="delete" class="btn btn-danger">Mark as Resigned</button></a></li>
  </ul>
</div></h1>
<hr>

<div class="showback">
  <h3>Staff Details</h3>
  <table class="table table-condensed table-bordered">
    <tr><td><b>Name</b></td><td>{{$staff->staff_name}}</td></tr>
    <tr><td><b>Staff ID</b></td><td>{{$staff->staff_id}}</td></tr>
    <tr><td><b>Designation</b></td><td>{{$staff->staff_title}}</td></tr>
    <tr><td><b>Email</b></td><td>{{$staff->staff_mail}}</td></tr>
    <tr><td><b>Mobile</b></td><td>{{$staff->staff_mobile}}</td></tr>
    <tr><td><b>Telephone no.</b></td><td>{{$staff->staff_telno}}</td></tr>
    <tr><td><b>Department</b></td><td>{{$staff->staff_dept}}</td></tr>
    <tr><td><b>Company</b></td><td>{{$staff->staff_company}}</td></tr>
    <tr><td><b>Office Location</b></td><td>{{$staff->staff_officeLocation}}</td></tr>
  </table>
</div>

@include('modal.assigntostaff')
<?php $hwrec = DB::table('hwrecord')->where('current_userid', $staff->staff_id)->get()?>
@if($hwrec->isEmpty() )
<div class="alert alert-warning"><b>Note:</b> This staff have not been assigned with any asset.
  <button class="btn btn-success pull-right" data-toggle="modal" data-target="#myModal">
    Assign hardware
  </button>
</div>
@else
<div class="showback">
  <h3>Hardware Usage History</h3>

  <table class="table table-condensed">
    <thead>
      <tr>
        <th> Ref# </th>
        <th> Hardware Model </th>
        <th> Hardware Type </th>
        <th> Asset ID </th>
        <th> S/N </th>
        <th> Date Taken </th>
        <th> Date Returned </th>
      </tr>
    </thead>
        @foreach($hwrec as $recku)
      <tr>
        <?php $idhw = DB::table('hardware')->where('id', $recku->fk_assetid)->first() ?>
        <td>{{$recku->id}}</td>
        <td>{{$idhw->hw_model}}</td>
        <td>{{$idhw->hw_type}}</td>
        <td>{{$idhw->hw_assetid}}</td>
        <td>{{$idhw->hw_serialno}}</td>
        @if(($recku->created_at) == '0000-00-00 00:00:00')
        <td> Date Missing </td>
        @else
        <td>{{date('jS F Y', strtotime($recku->created_at))}}</td>
        @endif
        @if($recku->status == 1)
          <td><a href="{{action('RecordController@show', $idhw->id)}}">In Use</a></td>
        @else
          <td>{{date('jS F Y', strtotime($recku->updated_at))}}</td>
        @endif
      </tr>
        @endforeach
  </table>
  <button class="btn btn-success pull-right" data-toggle="modal" data-target="#myModal">
    Assign another hardware
  </button>
</div>
@endif

@stop
