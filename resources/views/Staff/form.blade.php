@extends('master')
@section('content')

<h1>Register New Staff</h1>
<hr>
{!! Form::open(array('action' => 'StaffController@store')) !!}
<div class="form-group">
  <!-- start pecahan kanan -->
  <div class="col-lg-6">
    @if($errors->has('staff_id'))
    <div class="form-group has-error">
      {!! Form::label('staffid', 'Staff ID:', ['class' => 'col-sm-2 control-label col-lg-5']) !!}
      {!! Form::text('staff_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
      <div class="alert alert-danger" >  {{ $errors->first('staffid')}}</div>

    @else
    {!! Form::label('staffid', 'Staff ID:', ['class' => 'col-sm-2 control-label col-lg-5']) !!}
    {!! Form::text('staff_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
    @endif

    {!! Form::label('staffname', 'Staff Name:', ['class' => 'control-label']) !!}
    {!! Form::text('staff_name', null, ['class' => 'form-control', 'required' => 'required']) !!}

    {!! Form::label('staffmail', 'E-Mail:', ['class' => 'control-label']) !!}
    {!! Form::text('staff_mail', null, ['class' => 'form-control']) !!}

    {!! Form::label('staffmobile', 'Mobile Number:', ['class' => 'control-label']) !!}
    {!! Form::text('staff_mobile', null, ['class' => 'form-control']) !!}

    {!! Form::label('stafftelno', 'Telephone number:', ['class' => 'control-label']) !!}
    {!! Form::text('staff_telno', null, ['class' => 'form-control']) !!}

  </div>
  <!-- start pecahan kiri -->
  <div class="col-lg-6">
    {!! Form::label('stafftitle', 'Designation:', ['class' => 'control-label']) !!}
    {!! Form::text('staff_title', null, ['class' => 'form-control']) !!}

    {!! Form::label('staffdept', 'Department:', ['class' => 'control-label']) !!}
    {!! Form::text('staff_dept', null, ['class' => 'form-control']) !!}

    {!! Form::label('staffcompany', 'Company:', ['class' => 'control-label']) !!}
    {!! Form::text('staff_company', null, ['class' => 'form-control']) !!}
    <span class="help-block"><sub><b>E.g:</b> <i>"Sapura Secured Technologies", "Sapura Advanced Systems Sdn Bhd" .</i></sub></span>

    {!! Form::label('staffOL', 'Office Location:', ['class' => 'control-label']) !!}
    {!! Form::text('staff_officeLocation', null, ['class' => 'form-control']) !!}
<span class="help-block"><sub><b>E.g:</b> <i>"Wangsa Maju" .</i></sub></span>

    </div>
    {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
    <a href="{{action('StaffController@index')}}" class="btn btn-default">Cancel</a>
    {!! Form::close() !!}
</div>



@stop
