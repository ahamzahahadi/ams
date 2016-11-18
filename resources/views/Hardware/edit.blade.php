@extends('master')

@section('content')

<h1>Update Asset</h1>
<hr>

{!! Form::model($hardware, ['method' => 'PATCH','route' => ['hardware.update', $hardware->id]]) !!}

<div class="form-group">
  <div class="col-lg-6">
    {!! Form::label('assetid', 'Asset ID:', ['class' => 'control-label']) !!}
    {!! Form::text('hw_assetid', null, ['class' => 'form-control']) !!}

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
    {!! Form::label('datepono', 'Purchase Order date:', ['class' => 'control-label']) !!}
    {!! Form::input('date','hw_date_po', null, ['class' => 'form-control']) !!}

    {!! Form::label('datesupp', 'Date Supplied:', ['class' => 'control-label']) !!}
    {!! Form::input('date','hw_datesupp', null, ['class' => 'form-control']) !!}

    {!! Form::label('datefac', 'Date Sent to Facility:', ['class' => 'control-label']) !!}
    {!! Form::input('date','hw_datefac', null, ['class' => 'form-control']) !!}

          <div class="col-lg-6">
            <br>
            {!! Form::label('supid', 'Supplier: ', ['class' => 'control-label']) !!} <br>
            {!! Form::select('hw_supplier', DB::table('supplier')->orderBy('supp_name', 'asc')->pluck('supp_name'), ['class' => 'form-control']) !!} <br><br>

            {!! Form::label('hw_type', 'Hardware Type: ', ['class' => 'control-label']) !!} <br>
            {!! Form::select('hw_type', DB::table('hwtype')->orderBy('type', 'asc')->pluck('type'), ['class' => 'form-control']) !!}
          </div>
          <div class="col-lg-6">
            <br>
            Supplier not listed? <br>
            {!! Form::button('Add Supplier') !!}

            <br><br>New asset type? <br>
            {!! Form::button('Add Asset Type') !!}
          </div>
    </div>

    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
    <a href="{{action('HardwareController@index')}}" class="btn btn-default">Cancel</a>
    {!! Form::close() !!}
</div>

@stop
