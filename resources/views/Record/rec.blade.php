@extends('master')
@section('content')
@include('Alerts::sweetalerts')
@if(!empty(Session::get('ada_error')))
<script>
$(function() {
    $('#myModal').modal('show');
});
</script>
@endif

<h1>Manage Hardware (Asset ID:<b>{{$hardware->hw_assetid}}</b>)</h1>

<div class="btn-group">
  <button type="button" class="btn btn-theme dropdown-toggle" data-toggle="dropdown" style="display:inline-block">
    Action <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    @if($hardware->hw_status == '1')
    <li><a href="{{action('RecordController@returnasset', $hardware->id)}}">Return to IT</a></li>
    @else
    <li><a href="{{action('RecordController@recform', $hardware->id)}}">Assign</a></li>
    @endif
    <li><a href="{{action('HardwareController@edit', $hardware->id)}}">Edit Hardware</a></li>

    <form class="delete" action="{{ route('hardware.destroy', $hardware->id) }}" method="POST">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="submit" value="Delete Hardware" class="btn btn-danger btn-sm" onclick="return confirm('are you sure?')">
    </form>
    <script>
      $(".delete").on("click", function(e){
        swal({
          title: "Are you sure?",
           text: "You will not be able to recover this imaginary file!",
           type: "warning",
           showCancelButton: true,
           confirmButtonColor: "#DD6B55",
           confirmButtonText: "Yes, delete it!",
           cancelButtonText: "No, cancel plx!",
           closeOnConfirm: false,
           closeOnCancel: false
        },
             function(isConfirm){
               if (isConfirm) {
                 swal("Deleted!", "Your imaginary file has been deleted.", "success");
                 delay(500);
                 var flag = true;

               } else {
                   swal("Cancelled", "Your imaginary file is safe :)", "error");
                   var flag = false;
               }
        });
          e.preventDefault();
          return flag;


      });

    </script>
  </ul>
</div>
<a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
  <!-- <script src="{{ URL::asset('js/swag.js') }}"></script> -->
<hr>

<!-- CURRENT STATUS SECTION -->

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
      <tr><td><b>Date Assigned</b></td><td>{{date('jS F Y', strtotime($latestuser->created_at))}}</td></tr>
      <tr><td><b>Remarks</b></td><td>{{$latestuser->remark}}</td></tr>
    </table>
  </div>
@else
  <div class="showback">
    <h2>Current Status: <button type="button" class="btn btn-round btn-primary">Available</button></h2>
    &nbsp&nbsp&nbsp&nbsp&nbsp<b>Stored at: </b>{{$hardware->hw_location}}
  </div>
@endif

<!-- FULL HARDWARE INFORMATION SECTION -->

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
      <tr><td><b>Price</b></td><td>RM {{$hardware->hw_price}}</td></tr>
      <tr><td><b>Type</b></td><td>{{$hardware->hw_type}}</td></tr>
      <tr><td><b>Date Supplied</b></td>
        @if(($hardware->hw_datesupp) == '0000-11-30 00:00:00')
        <td>Unspecified</td>
        @else
        <td>{{ $hardware->hw_datesupp->format('d/m/Y') }}</td>
        @endif</tr>
      <tr><td><b>Supplied By</b></td><td>{{DB::table('supplier')->where('id',$hardware->hw_supplier)->value('supp_name')}}</td></tr>
    </table>
  </div>

<!-- LIST OF SOFTWARE INSTALLED -->

<?php $installedsoftware = DB::table('software')
->where('installed_in', $hardware->hw_assetid)
->get();?>

@include('modal.addsoftware')
  @if($installedsoftware->isEmpty())
  <div class="alert alert-warning"><b>Note:</b> There are no software installed in this device.
    @if($hardware->hw_status == '1')
      <button class="btn btn-success pull-right" data-toggle="modal" data-target="#myModal">
        Add new software
      </button>
    @endif
  </div>
  @else
  <div class="showback" id="swlist">
    <h2>List of software installed</h2>
    <table class="table table-condensed">
      <thead><tr>
        <th>Software Name</th>
        <th>Category</th>
        <th>Product Key</th>
        <th>Asset ID</th>
        <th>Install Date</th>
        <th></th>
      </tr></thead>

      <tbody>
        @foreach($installedsoftware as $us)
        <?php $softwareinfo = DB::table('software')->where('sw_assetid', $us->sw_assetid)->first(); ?>
        <tr>
          <td> {{$softwareinfo->sw_model}} </td>
          <td> {{$softwareinfo->sw_type}} </td>
          <td> {{$softwareinfo->sw_prodkey}} </td>
          <td><a href="{{action('SwRecordController@show', $us->id)}}"> {{$softwareinfo->sw_assetid}} </a></td>
          <td> {{date('jS F Y', strtotime($us->created_at))}} </td>
          <td><a href="{{action('SwRecordController@uninstalllist', $softwareinfo->sw_assetid)}}" onclick="return confirm('are you sure?')"><button value="Delete" id="delete" class="btn btn-danger btn-sm">Uninstall</button></a> </td>
        </tr>
        @endforeach
      </tbody>
    </table>
      @if($hardware->hw_status == '1')
        <button class="btn btn-success" data-toggle="modal" data-target="#myModal">
          Add new software
        </button>
      @endif
    </div>
  @endif

<!-- TRANSFER LOG SECTION -->

    <?php $prevuser = DB::table('hwrecord')->where('fk_assetid', $hardware->hw_assetid)->get();?>
    @if($prevuser->isEmpty())
    <div class="alert alert-info"><b>Info:</b> There are no previous user recorded.</div>
    @else
  <div class="showback">
    <h2>Transfer Log</h2>
    <table class="table table-condensed">
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
          <td> {{date('jS F Y', strtotime($pu->created_at))}} </td>
          <td> {{ DB::table('staff')->where('staff_id', $pu->current_userid)->value('staff_name')}} </td>
          <td> {{$pu->current_userid}} </td>
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
