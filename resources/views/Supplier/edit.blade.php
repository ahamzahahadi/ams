@extends('master')
@section('content')

<h1>Add New Supplier</h1>
<hr>
{!! Form::model($supplier, ['method' => 'PATCH','route' => ['supplier.update', $supplier->id]]) !!}
<div class="form-group">
  {!! Form::label('suppname', 'Supplier Company Name:', ['class' => 'control-label']) !!}
  {!! Form::text('supp_name', null, ['class' => 'form-control', 'required' => 'required']) !!}

  {!! Form::label('suppadd', 'Supplier Address:', ['class' => 'control-label']) !!}
  {!! Form::text('supp_address', null, ['class' => 'form-control']) !!}

  {!! Form::label('suppcontact', 'Supplier Contact Number:', ['class' => 'control-label']) !!}
  {!! Form::text('supp_contact', null, ['class' => 'form-control']) !!}
</div>
  {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
  <a href="{{action('SupplierController@index')}}" class="btn btn-default">Cancel</a>
  {!! Form::close() !!}
@stop
