@extends('master')

@section('content')

<h1>Update Asset</h1>
<hr>

{!! Form::model($hardware, ['method' => 'PATCH','route' => ['hardware.update', $hardware->id]]) !!}

<div class="form-group">
  <div class="col-lg-6">
    @if($errors->has('hw_assetid'))
    <div class="form-group has-error">
      {!! Form::label('assetid', 'Asset ID:', ['class' => 'col-sm-2 control-label col-lg-5']) !!}
      {!! Form::text('hw_assetid', null, ['class' => 'form-control']) !!}
    </div>
    <div class="alert alert-danger" >  {{ $errors->first('hw_assetid')}}</div>

    @else
    {!! Form::label('assetid', 'Asset ID:', ['class' => 'control-label']) !!}
    {!! Form::text('hw_assetid', null, ['class' => 'form-control']) !!}
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
    {!! Form::input('number','hw_price', null, ['class' => 'form-control', 'class' => 'formsize-100', 'step' => 'any', 'min'=>'0']) !!}

  </div>
  <div class="col-lg-6">
    <!-- validation for PO date -->
    @if($errors->has('hw_date_po'))
    <div class="form-group has-error">
      {!! Form::label('datepono', 'Purchase Order date:', ['class' => 'control-label']) !!}
      {!! Form::input('date','hw_date_po', $hardware->hw_date_po->format('Y-m-d'), ['class' => 'form-control']) !!}
    </div>
    <div class="alert alert-danger" >  {{ $errors->first('hw_date_po')}}</div>
    @else
    {!! Form::label('datepono', 'Purchase Order date:', ['class' => 'control-label']) !!}
    {!! Form::input('date','hw_date_po', $hardware->hw_date_po->format('Y-m-d'), ['class' => 'form-control']) !!}
    @endif
    <!-- validation for date supplied  -->
    @if($errors->has('hw_datesupp'))
    <div class="form-group has-error">
      {!! Form::label('datesupp', 'Date Supplied:', ['class' => 'control-label']) !!}
      {!! Form::input('date','hw_datesupp', $hardware->hw_datesupp->format('Y-m-d'), ['class' => 'form-control']) !!}
    </div>
    <div class="alert alert-danger" >  {{ $errors->first('hw_datesupp')}}</div>
    @else
    {!! Form::label('datesupp', 'Date Supplied:', ['class' => 'control-label']) !!}
    {!! Form::input('date','hw_datesupp', $hardware->hw_datesupp->format('Y-m-d'), ['class' => 'form-control']) !!}
    @endif
    <!-- validation for date to facilities -->
    @if($errors->has('hw_datefac'))
    <div class="form-group has-error">
      {!! Form::label('datefac', 'Date Sent to Facility:', ['class' => 'control-label']) !!}
      {!! Form::input('date','hw_datefac', $hardware->hw_fac->format('Y-m-d'), ['class' => 'form-control']) !!}
    </div>
    <div class="alert alert-danger" >  {{ $errors->first('hw_datefac')}}</div>
    @else
    {!! Form::label('datefac', 'Date Sent to Facility:', ['class' => 'control-label']) !!}
    {!! Form::input('date','hw_datefac', $hardware->hw_datefac->format('Y-m-d'), ['class' => 'form-control']) !!}
    @endif

    <?php  $value = DB::table('supplier')->orderBy('supp_name', 'asc')->get();
    $value2 = DB::table('hwtype')->where('flag', 1)->orderBy('type', 'asc')->pluck('type'); ?>

    <div class="col-sm-6">
      {!! Form::label('hw_companylel', 'Owner Company: ', ['class' => 'control-label']) !!} <br>
      <?php $arraycomp = ['SAS','SST', 'STB', 'SDSB', 'SRSB', 'SLCT'];
            $arrayclass = ['Standard', 'Service', 'SAILS'];?>
      <select name='hw_company' class = 'form-control'>
        <option value=""> --Choose Company-- </option>
        @foreach($arraycomp as $comp)
          @if($comp == $hardware->hw_company)
          <option value={{$comp}} selected="selected"> {{$comp}} </option>
          @else
          <option value={{$comp}}> {{$comp}} </option>
          @endif
        @endforeach
      </select>
    </div>
    <div class="col-sm-6">
      {!! Form::label('hw_classlel', 'Class: ', ['class' => 'control-label']) !!} <br>
      <select name='hw_class' class = 'form-control'>
        @foreach($arrayclass as $class)
          @if($hardware->hw_class == $class)
          <option value={{$class}} selected="selected"> {{$class}} </option>
          @else
          <option value={{$class}}> {{$class}} </option>
          @endif
        @endforeach
      </select>
    </div>

    <div class="col-lg-6">
      {!! Form::label('supid', 'Supplier:', ['class' => 'col-sm-2 control-label col-lg-5']) !!}
      <select name='hw_supplier' required class = 'form-control'>
        <option value=""> --Choose Supplier-- </option>
        @foreach ($value as $val)
          @if($hardware->hw_supplier == $val->id)
          <option value= "{{ $val-> id }}" selected="selected"> {{$val->supp_name}} </option>
          @else
          <option value= "{{ $val-> id }}"> {{$val->supp_name}} </option>
          @endif
        @endforeach
      </select>


      {!! Form::label('hw_type', 'Hardware Type: ', ['class' => 'control-label']) !!} <br>
      <select name='hw_type' required class = 'form-control'>
        <option value=""> --Choose Type-- </option>
        @foreach ($value2 as $val2)
          @if($hardware->hw_type == $val2)
          <option selected="selected"> {{$val2}} </option>
          @else
          <option> {{$val2}} </option>
          @endif
        @endforeach
      </select>

    </div>
    <div class="col-lg-6">
      <div class="row">
        Supplier not listed? <br>
        <button class="btn btn-round btn-info" data-toggle="modal" data-target="#myModal1">Add Supplier</button>
      </div>
      <div class="row">
        <br>New asset type? <br>
        <button class="btn btn-round btn-info" data-toggle="modal" data-target="#myModal2">Add Asset Type</button>
      </div>
    </div>
  </div>
</div>
<div class="col-md-12 centered">
  {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
  <a href="{{URL::previous()}}" class="btn btn-default">Cancel</a>
  {!! Form::close() !!}
</div>
@include('modal.addsupplier')
@include('modal.addassettype')
@stop
