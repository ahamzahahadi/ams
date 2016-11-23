@extends('master')

@section('content')

<h1>Register New Hardware</h1>
<hr>

{!! Form::open(array('action' => 'HardwareController@store', 'id'=> 'hwform')) !!}

<div class="form-group">
  <div class="col-lg-6">

    @if($errors->has('hw_assetid'))
    <div class="form-group has-error">
      {!! Form::label('assetid', 'Asset ID:', ['class' => 'col-sm-2 control-label col-lg-5']) !!}
      {!! Form::text('hw_assetid', null, ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
      <div class="alert alert-danger" >  {{ $errors->first('hw_assetid')}}</div>

    @else
    {!! Form::label('assetid', 'Asset ID:', ['class' => 'control-label']) !!}
    {!! Form::text('hw_assetid', null, ['class' => 'form-control', 'required' => 'required']) !!}
    @endif

    {!! Form::label('serialno', 'Serial number:', ['class' => 'control-label']) !!}
    {!! Form::text('hw_serialno', null, ['class' => 'form-control']) !!}

    {!! Form::label('model', 'Hardware model:', ['class' => 'control-label']) !!}
    {!! Form::text('hw_model', null, ['class' => 'form-control']) !!}

    {!! Form::label('partno', 'Part number:', ['class' => 'control-label']) !!}
    {!! Form::text('hw_part_no', null, ['class' => 'form-control']) !!}

    {!! Form::label('pono', 'Purchase Order number:', ['class' => 'control-label']) !!}
    {!! Form::text('hw_po_no', null, ['class' => 'form-control']) !!}

    {!! Form::label('price', 'Price:', ['class' => 'control-label']) !!} <br>RM
    {!! Form::input('number','hw_price', null, ['class' => 'form-control', 'class' =>'formsize-100', 'step' => 'any', 'min'=>'0', 'placeholder'=> '0.00']) !!}

  </div>
  <div class="col-lg-6">
    <!-- validation for PO date -->
    @if($errors->has('hw_date_po'))
    <div class="form-group has-error">
      {!! Form::label('datepono', 'Purchase Order date:', ['class' => 'control-label']) !!}
      {!! Form::input('date','hw_date_po', null, ['class' => 'form-control']) !!}
    </div>
        <div class="alert alert-danger" >  {{ $errors->first('hw_date_po')}}</div>
    @else
    {!! Form::label('datepono', 'Purchase Order date:', ['class' => 'control-label']) !!}
    {!! Form::input('date','hw_date_po', null, ['class' => 'form-control']) !!}
    @endif
    <!-- validation for date supplied  -->
    @if($errors->has('hw_datesupp'))
    <div class="form-group has-error">
      {!! Form::label('datesupp', 'Date Supplied:', ['class' => 'control-label']) !!}
      {!! Form::input('date','hw_datesupp', null, ['class' => 'form-control']) !!}
    </div>
        <div class="alert alert-danger" >  {{ $errors->first('hw_datesupp')}}</div>
    @else
    {!! Form::label('datesupp', 'Date Supplied:', ['class' => 'control-label']) !!}
    {!! Form::input('date','hw_datesupp', null, ['class' => 'form-control']) !!}
    @endif
    <!-- validation for date to facilities -->
    @if($errors->has('hw_datefac'))
    <div class="form-group has-error">
      {!! Form::label('datefac', 'Date Sent to Facility:', ['class' => 'control-label']) !!}
      {!! Form::input('date','hw_datefac', null, ['class' => 'form-control']) !!}
    </div>
        <div class="alert alert-danger" >  {{ $errors->first('hw_datefac')}}</div>
    @else
    {!! Form::label('datefac', 'Date Sent to Facility:', ['class' => 'control-label']) !!}
    {!! Form::input('date','hw_datefac', null, ['class' => 'form-control']) !!}
    @endif

      <div class="col-lg-6">

        <?php  $value = DB::table('supplier')->orderBy('supp_name', 'asc')->get();
               $value2 = DB::table('hwtype')->orderBy('type', 'asc')->pluck('type'); ?>

        {!! Form::label('supid', 'Supplier:', ['class' => 'col-sm-2 control-label col-lg-5']) !!}
        <select name='hw_supplier' required class = 'form-control' form="hwform">
            <option value=""> --Choose Supplier-- </option>
            @foreach ($value as $val)
            <option value="{{ $val-> supp_id}}"> {{ $val->supp_name }} </option>
            @endforeach
        </select>


        {!! Form::label('hw_type', 'Hardware Type: ', ['class' => 'control-label']) !!} <br>
        <select name='hw_type' required class = 'form-control' >
            <option value=""> --Choose Type-- </option>
            @foreach ($value2 as $val2)
            <option> {{ $val2 }} </option>
            @endforeach
        </select>

      </div>
      <div class="col-lg-6">
        <div class="row">
        Supplier not listed? <br>
      	<button type="button" class="btn btn-round btn-info">Add Supplier</button>
        </div>
        <div class="row">
        <br>New asset type? <br>
        <button type="button" class="btn btn-round btn-info">Add Asset Type</button>
        </div>
      </div>
  </div>
</div>
{!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
<a href="{{action('HardwareController@index')}}" class="btn btn-default">Cancel</a>
{!! Form::close() !!}

@stop
