@extends('master')
@section('content')

<h1>Register New Staff</h1>
<hr>
{!! Form::open(array('action' => 'StaffController@store')) !!}
<div class="form-group">
    <!-- start pecahan kanan -->
    <div class="col-lg-6">
      @if($errors->has('staffid'))
      <div class="form-group has-error">
        {!! Form::label('staffid', 'Staff ID:', ['class' => 'col-sm-2 control-label col-lg-5']) !!}
        {!! Form::text('staffid', null, ['class' => 'form-control', 'required' => 'required']) !!}
      </div>
        <div class="alert alert-danger" >  {{ $errors->first('staffid')}}</div>

      @else
      {!! Form::label('staffid', 'Staff ID:', ['class' => 'col-sm-2 control-label col-lg-5']) !!}
      {!! Form::text('staffid', null, ['class' => 'form-control', 'required' => 'required']) !!}
      @endif

      {!! Form::label('staffname', 'Staff Name:', ['class' => 'control-label']) !!}
      {!! Form::text('staffname', null, ['class' => 'form-control', 'required' => 'required']) !!}

      {!! Form::label('staffmail', 'E-Mail:', ['class' => 'control-label']) !!}
      {!! Form::text('staffmail', null, ['class' => 'form-control']) !!}

      {!! Form::label('staffmobile', 'Mobile Number:', ['class' => 'control-label']) !!}
      {!! Form::text('staffmobile', null, ['class' => 'form-control', 'required' => 'required']) !!}

      {!! Form::label('stafftelno', 'Telephone number:', ['class' => 'control-label']) !!}
      {!! Form::text('stafftelno', null, ['class' => 'form-control']) !!}
    </div>
    <!-- start pecahan kiri -->
    <div class="col-lg-6">
      {!! Form::label('stafftitle', 'Title:', ['class' => 'control-label']) !!}
      {!! Form::text('stafftitle', null, ['class' => 'form-control']) !!}

      {!! Form::label('staffdept', 'Department:', ['class' => 'control-label']) !!}
      {!! Form::text('staffdept', null, ['class' => 'form-control']) !!}

      {!! Form::label('staffcompany', 'Company:', ['class' => 'control-label']) !!}
      {!! Form::text('staffcompany', null, ['class' => 'form-control']) !!}
      <span class="help-block"><sub><b>E.g:</b> <i>"Sapura Secured Technologies", "Sapura Advanced Systems Sdn Bhd" .</i></sub></span>

      {!! Form::label('staffOL', 'Office Location:', ['class' => 'control-label']) !!}
      {!! Form::text('staffOL', null, ['class' => 'form-control']) !!}
<span class="help-block"><sub><b>E.g:</b> <i>"Wangsa Maju" .</i></sub></span>

    </div>
    {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
    <a href="{{action('StaffController@index')}}" class="btn btn-default">Cancel</a>
    {!! Form::close() !!}
</div>



@stop
