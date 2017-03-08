@extends('master')
@section('content')

<?php $users = DB::table('users')->get();
?>
<h3> Administrative Section </h3> <hr>
<div >
  <h4><i class="fa fa-angle-right"></i>User Management</h4>
    <table class="table table-bordered table-striped" id="tableA">
      <thead><tr>
        <th>Name</th>
        <th>Email</th>
        <th>Privilege</th>
        <th>Edit</th>
        <th></th>
      </tr></thead>
      <tbody>
      @foreach ($users as $user)
        <tr>
           <td>{{ $user->name }}</td>
           <td>{{ $user->email }}</td>
           @if($user->AdminRole == 1)
           <td> Admin </td>
           @else
           <td> None</td>
           @endif
           <td><a href="{{action('AdminController@edit', $user->id)}}" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a></td>
           <td>{!! Form::open(['method' => 'DELETE','route' => ['user.destroy', $user->id], "onclick"=>"return confirm('Are you sure?')"]) !!}
               {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
               {!! Form::close() !!}</td>
        </tr>
      @endforeach
   </tbody>
      </table>
  </div><!-- /content-panel -->


@endsection
