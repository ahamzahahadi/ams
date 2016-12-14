@extends('master')
@section('content')

<h1>Register New Software</h1>
<hr>

{!! Form::open(array('action' => 'SoftwareController@store')) !!}

<div class="form-group">
  <div class="col-lg-6">

    @if($errors->has('sw_assetid'))
    <div class="form-group has-error">
      {!! Form::label('assetid', 'Software Asset ID:', ['class' => 'col-sm-2 control-label col-lg-5']) !!}
      {!! Form::text('sw_assetid', null, ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
      <div class="alert alert-danger" >  {{ $errors->first('sw_assetid')}}</div>

    @else
    {!! Form::label('assetid', 'Software Asset ID:', ['class' => 'control-label']) !!}
    {!! Form::text('sw_assetid', null, ['class' => 'form-control', 'required' => 'required']) !!}
    @endif

    {!! Form::label('serialno', 'Software Serial number:', ['class' => 'control-label']) !!}
    {!! Form::text('sw_serialno', null, ['class' => 'form-control']) !!}

    {!! Form::label('pono', 'Purchase Order number:', ['class' => 'control-label']) !!}
    {!! Form::text('sw_po_no', null, ['class' => 'form-control']) !!}

    {!! Form::label('model', 'Software Name:', ['class' => 'control-label']) !!}
    {!! Form::text('sw_model', null, ['class' => 'form-control']) !!}

    {!! Form::label('prodkey', 'Product Key:', ['class' => 'control-label']) !!}
    {!! Form::text('sw_prodkey', null, ['class' => 'form-control']) !!}

    {!! Form::label('price', 'Price:', ['class' => 'control-label']) !!} <br>RM
    {!! Form::input('number','sw_price', null, ['class' => 'form-control', 'class' =>'formsize-100', 'step' => 'any', 'min'=>'0', 'placeholder'=> '0.00']) !!}

  </div>
  <div class="col-lg-6">
    <!-- validation for PO date -->
    @if($errors->has('sw_date_po'))
    <div class="form-group has-error">
      {!! Form::label('datepono', 'Purchase Order date:', ['class' => 'control-label']) !!}
      {!! Form::input('date','sw_date_po', null, ['class' => 'form-control']) !!}
    </div>
        <div class="alert alert-danger" >  {{ $errors->first('sw_date_po')}}</div>
    @else
    {!! Form::label('datepono', 'Purchase Order date:', ['class' => 'control-label']) !!}
    {!! Form::input('date','sw_date_po', null, ['class' => 'form-control']) !!}
    @endif

    <!-- validation for date supplied  -->
    @if($errors->has('sw_datesupp'))
    <div class="form-group has-error">
      {!! Form::label('datesupp', 'Date Supplied:', ['class' => 'control-label']) !!}
      {!! Form::input('date','sw_datesupp', null, ['class' => 'form-control']) !!}
    </div>
        <div class="alert alert-danger" >  {{ $errors->first('sw_datesupp')}}</div>
    @else
    {!! Form::label('datesupp', 'Date Supplied:', ['class' => 'control-label']) !!}
    {!! Form::input('date','sw_datesupp', null, ['class' => 'form-control']) !!}
    @endif

    <!-- validation for date to facilities -->
    @if($errors->has('sw_datefac'))
    <div class="form-group has-error">
      {!! Form::label('datefac', 'Date Sent to Facility:', ['class' => 'control-label']) !!}
      {!! Form::input('date','sw_datefac', null, ['class' => 'form-control']) !!}
    </div>
        <div class="alert alert-danger" >  {{ $errors->first('sw_datefac')}}</div>
    @else
    {!! Form::label('datefac', 'Date Sent to Facility:', ['class' => 'control-label']) !!}
    {!! Form::input('date','sw_datefac', null, ['class' => 'form-control']) !!}
    @endif

    <div class="col-lg-6">

      <?php  $value = DB::table('supplier')->orderBy('supp_name', 'asc')->get();
             $value2 = DB::table('hwtype')->where('flag', 2)->orderBy('type', 'asc')->pluck('type'); ?>

      {!! Form::label('supid', 'Supplier:', ['class' => 'col-sm-2 control-label col-lg-5']) !!}
      <select name='sw_supplier' required class = 'form-control'>
          <option value=""> --Choose Supplier-- </option>
          @foreach ($value as $val)
          <option value="{{ $val-> id}}"> {{ $val->supp_name }} </option>
          @endforeach
      </select>


      {!! Form::label('sw_type', 'Software Category: ', ['class' => 'control-label']) !!} <br>
      <select name='sw_type' required class = 'form-control' >
          <option value=""> --Choose Category-- </option>
          @foreach ($value2 as $val2)
          <option> {{ $val2 }} </option>
          @endforeach
      </select>

    </div>
    <div class="col-lg-6">
      <div class="row">
        Supplier not listed? <br>
        <button class="btn btn-round btn-info" data-toggle="modal" data-target="#myModal1">Add Supplier</button>
      </div>
      <div class="row">
        <br>New Software Category? <br>
            <button class="btn btn-round btn-info" data-toggle="modal" data-target="#myModal2">Add Software Category</button>
      </div>
    </div>

  </div>
</div>
{!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
<a href="{{action('SoftwareController@index')}}" class="btn btn-default">Cancel</a>
{!! Form::close() !!}
@include('modal.addsupplier')
@include('modal.addswtype')
@stop
