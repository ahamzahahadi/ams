@extends('master')
@section('content')

<h1>Update User</h1>
<hr>
{!! Form::model($users, ['method' => 'PATCH','route' => ['user.update', $users->id]]) !!}

{!! Form::label('name', 'Name:', ['class' => 'control-label']) !!}
{!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}

{!! Form::label('email', 'Email (Login ID):', ['class' => 'control-label']) !!}
{!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
<br>
{!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
<button class="btn btn-success" data-toggle="modal" data-target="#confirmModal" >
  Grant Administrative Privilege
</button>
{!! Form::close() !!}


@include('modal.grantadmin')
@stop
