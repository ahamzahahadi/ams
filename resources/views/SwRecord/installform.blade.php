@extends('master')
@section('content')
<h1> Software Installation Form </h1>
<hr>

{!! Form::open(array('action' => 'SwRecordController@store')) !!}

<div class="form-group">
  {!! form::label('assetid', 'Software Asset ID:', ['class'=> 'control-label']) !!}
  {!! form::text('sw_assetid', "$software->sw_assetid", ['class'=> 'form-control', 'readonly'=>'readonly','value'=>"$software->sw_assetid" ]  )!!}

  {!! form::label('assignto','Staff ID:', ['class'=> 'control-label'] )!!}
  {!! Form::text('current_userid', null, ['class' => 'form-control']) !!}
  <span class="help-block"><sup>&nbsp&nbsp&nbsp&nbspEnter staff ID to be assigned to.</sup></span>

  {!! form::label('installinto','Install into:', ['class'=> 'control-label'] )!!}
  {!! Form::text('hw_assetid', null, ['class' => 'form-control']) !!}
  <span class="help-block"><sup>&nbsp&nbsp&nbsp&nbspEnter the Device Asset ID to be installed to.</sup></span>

  {!! Form::label('assigndate', "Installed on:", ['class' => 'control-label']) !!}<br>
  {!! form::text( '','' , ['class'=> 'form-control', 'placeholder'=> "$datenow", 'disabled'=>'disabled']  )!!}

  {!! form::label('remark','Remarks:', ['class'=> 'control-label'] )!!}
  {!! Form::textarea('remark', null, ['class' => 'form-control']) !!}

</div>
{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
<a href="{{URL::previous()}}" class="btn btn-default">Cancel</a>
{!! Form::close() !!}
@stop
