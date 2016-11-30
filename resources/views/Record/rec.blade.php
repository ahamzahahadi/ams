@extends('master')
@section('content')

<h1>Manage Hardware (Asset ID:{{$hardware->hw_assetid}})</h1>

<div class="btn-group">
  <button type="button" class="btn btn-theme dropdown-toggle" data-toggle="dropdown" style="display:inline-block">
    Action <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="{{action('RecordController@recform', $hardware->id)}}">Assign</a></li>
    <li><a href="{{action('HardwareController@edit', $hardware->id)}}">Edit Hardware</a></li>
    <li><a href="{{action('RecordController@returnasset', $hardware->id)}}">Return to IT</a></li>
    {!! Form::open(['method' => 'DELETE','route' => ['hardware.destroy', $hardware->id],'style'=>'display:inline-block','id'=>'deleteform']) !!}
    {!! Form::close() !!}
    <li><a href="#"><button value="Delete" id="delete" class="btn btn-danger btn-sm">Delete Hardware</button></a></li>
  </ul>
</div>
<a href="{{action('HardwareController@index')}}" class="btn btn-default">Back</a>
<script>
$('button#delete').on('click', function(){
  swal({
    title: "Are you sure?",
     text: "You will not be able to recover this asset record!",
     type: "warning",
     showCancelButton: true,
     confirmButtonColor: "#DD6B55",
     confirmButtonText: "Yes, delete it!",
     cancelButtonText: "Cancel Please!",
     closeOnConfirm: false,
     closeOnCancel: false
  },
       function(isConfirm){
         if (isConfirm) {
           swal("Deleted!", "The asset record has been removed from the database.", "success");
           delay(500);
           $("#deleteform").submit();

         } else {
             swal("Cancelled", "No changes committed", "error");
         }
  });
})
</script>
<hr>
@if($hardware->hw_status== '1')
  <?php $latestuser = DB::table('hwrecord')->where('fk_assetid', "$hardware->hw_assetid")->orderBy('created_at', 'desc')->first(); //get record of latest user
        $userstaffdb = DB::table('staff')->where('staff_id', "$latestuser->current_userid")->first();?>
  <h2>Current Status: <button type="button" class="btn btn-round btn-warning">Assigned</button></h2>
  <div class="showback">
    <h3>Current User Details</h3>
    <table class="table table-condensed table-bordered">
      <tr><td><b>Name</b></td><td>{{$userstaffdb->staff_name}}</td></tr>
      <tr><td><b>Staff ID</b></td><td>{{$userstaffdb->staff_id}}</td></tr>
      <tr><td><b>Email</b></td><td>{{$userstaffdb->staff_mail}}</td></tr>
      <tr><td><b>Mobile</b></td><td>{{$userstaffdb->staff_mobile}}</td></tr>
      <tr><td><b>Department</b></td><td>{{$userstaffdb->staff_dept}}</td></tr>
      <tr><td><b>Designation</b></td><td>{{$userstaffdb->staff_title}}</td></tr>
      <tr><td><b>Date Assigned</b></td><td>{{$latestuser->created_at}}</td></tr>
      <tr><td><b>Remarks</b></td><td>{{$latestuser->remark}}</td></tr>
    </table>
  </div>
@else
  <div class="showback">
    <h2>Current Status: <button type="button" class="btn btn-round btn-primary">Available</button></h2>
    &nbsp&nbsp&nbsp&nbsp&nbsp<b>Located at: </b>{{$hardware->hw_location}}
  </div>
@endif
  <div class="showback">
    <h2>Full Hardware Information</h2>
    <table class="table table-condensed table-bordered">
      <tr><td><b>Asset ID</b></td><td>{{$hardware->hw_assetid}}</td></tr>
      <tr><td><b>Serial Number</b></td><td>{{$hardware->hw_serialno}}</td></tr>
      <tr><td><b>Model</b></td><td>{{$hardware->hw_model}}</td></tr>
      <tr><td><b>Purchase Order Number</b></td><td>{{$hardware->hw_po_no}}</td></tr>
      <tr><td><b>Purchase Order Date</b></td>
        @if(($hardware->hw_date_po) == '0000-11-30 00:00:00')
        <td>Unspecified</td>
        @else
        <td>{{ $hardware->hw_date_po->format('d/m/Y') }}</td>
        @endif</tr>
      <tr><td><b>Part Number</b></td><td>{{$hardware->hw_part_no}}</td></tr>
      <tr><td><b>Price</b></td><td>{{$hardware->hw_price}}</td></tr>
      <tr><td><b>Type</b></td><td>{{$hardware->hw_type}}</td></tr>
      <tr><td><b>Date Supplied</b></td>
        @if(($hardware->hw_datesupp) == '0000-11-30 00:00:00')
        <td>Unspecified</td>
        @else
        <td>{{ $hardware->hw_datesupp->format('d/m/Y') }}</td>
        @endif</tr>
    </table>
  </div>

  <div class="showback">
    <!-- if ada software installed -->
    <!-- <h3>List of software installed</h3>
    <table class="table table-condensed">
      <tr>
        <th>Name</th>
        <th>Software Category</th>
        <th>Serial Key</th>
        <th>Asset ID</th>
        <th>Installation Date</th>
      <tr>

    </table> -->
    <!-- if no software installed -->
    <div class="alert alert-warning"><b>Note:</b> There are no software installed in this device.</div>
    <!-- alert no software installed in this hardware -->

  </div>

    <?php $prevuser = DB::table('hwrecord')->where('fk_assetid', $hardware->hw_assetid)->get();?>
    @if($prevuser->isEmpty())
    <div class="alert alert-info"><b>Info:</b> There are no previous user recorded.</div>
    @else
  <div class="showback">
    <h2>Previous Users</h2>
    <table class="table table-condensed table-bordered">
      <thead><tr>
        <th>Ref#</th>
        <th>Date Taken</th>
        <th>User</th>
        <th>Staff ID</th>
        <th>Remark</th>
        <th>Date Returned</th>
      </tr></thead>
      <tbody>
        @foreach($prevuser as $pu)
        <tr>
          <td> {{$pu->id}} </td>
          <td> {{$pu->created_at}} </td>
          <td> {{ DB::table('staff')->where('staff_id', $pu->current_userid)->value('staff_name')}} </td>
          <td> {{$pu->current_userid}} </td>
          <td> {{$pu->remark}} </td>
          <td> {{$pu->updated_at}} </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @endif
  </div>
</div>
@stop
