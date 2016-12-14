@extends('master')
@section('content')

<h1>Add New Supplier</h1>
<hr>
{!! Form::open(array('action' => 'SupplierController@store')) !!}
<div class="form-group">
  {!! Form::label('suppname', 'Supplier Company Name:', ['class' => 'control-label']) !!}
  {!! Form::text('supp_name', null, ['class' => 'form-control', 'required' => 'required']) !!}

  {!! Form::label('suppcontact', 'Supplier Contact Number:', ['class' => 'control-label']) !!}
  {!! Form::text('supp_contact', null, ['class' => 'form-control', 'required' => 'required']) !!}

  {!! Form::label('suppadd', 'Supplier Address:', ['class' => 'control-label']) !!}
  {!! Form::textarea('supp_address', null, ['class' => 'form-control']) !!}


</div>
  {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
  <a href="{{action('StaffController@index')}}" class="btn btn-default">Cancel</a>
  {!! Form::close() !!}
@stop
