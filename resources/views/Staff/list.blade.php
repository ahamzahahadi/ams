@extends('master')
@section('content')
@include('Alerts::sweetalerts')
<div >
    <div >
      <h4><i class="fa fa-angle-right"></i>Staff List</h4>
        <table class="table table-bordered table-striped table-condensed" id="tableA">
          <thead><tr>
            <th>Staff ID</th>
            <th>Name</th>
            <th>E-mail</th>
            <th>Mobile</th>
            <th>Tel no.</th>
            <th>Designation</th>
            <th>Department</th>
            <th>Company</th>
            <th>Location</th>
            <th></th>
            <th></th>
            <th></th>
          </tr></thead>
          <tbody>
                @foreach ($staffList as $staff)
            <tr>
            <td>{{ $staff->staff_id }}</td>
            <td>{{ $staff->staff_name }}</td>
            <td>{{ $staff->staff_mail }}</td>
            <td>{{ $staff->staff_mobile }}</td>
            <td>{{ $staff->staff_telno }}</td>
            <td>{{ $staff->staff_title }}</td>
            <td>{{ $staff->staff_dept }}</td>
            <td>{{ $staff->staff_company }}</td>
            <td>{{ $staff->staff_officeLocation }}</td>
            <td><a href="{{action('StaffController@show', $staff->id)}}" class="btn btn-theme"><i class="fa fa-info"></i> Info</button></a></td>
           <td><a href="{{action('StaffController@edit', $staff->id)}}" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a></td>
           <td>{!! Form::open(['method' => 'DELETE','route' => ['staff.destroy', $staff->id], "onclick"=>"return confirm('Are you sure?')"]) !!}
               {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
               {!! Form::close() !!}</td>
          </tr>  @endforeach
       </tbody>
          </table>
      </div><!-- /content-panel -->
</div><!-- /row -->
@stop
