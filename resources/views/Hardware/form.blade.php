@extends('master')

@section('content')

<h1>Add new Hardware</h1>
<hr>

{!! Form::open(array('action' => 'HardwareController@store')) !!}

<div class="form-group">
    {!! Form::label('assetid', 'Asset ID:', ['class' => 'control-label']) !!}
    {!! Form::text('hw_assetid', null, ['class' => 'form-control']) !!}

    {!! Form::label('serialno', 'Serial number:', ['class' => 'control-label']) !!}
    {!! Form::text('hw_serialno', null, ['class' => 'form-control']) !!}

    {!! Form::label('model', 'Hardware model:', ['class' => 'control-label']) !!}
    {!! Form::text('hw_model', null, ['class' => 'form-control']) !!}

    {!! Form::label('pono', 'Purchase Order no.:', ['class' => 'control-label']) !!}
    {!! Form::text('hw_po_no', null, ['class' => 'form-control']) !!}

    {!! Form::label('datepono', 'Purchase Order date:', ['class' => 'control-label']) !!}
    {!! Form::text('hw_date_po', null, ['class' => 'form-control']) !!}

    {!! Form::label('supid', 'Supp ID dlu, nanti tukar/dropdown nama diorang/search:', ['class' => 'control-label']) !!}
    {!! Form::text('hw_supplier', null, ['class' => 'form-control']) !!}
</div>
{!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

@stop