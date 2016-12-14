@extends('master')
@section('content')
<h1> Fixed Asset Requisition Form </h1>
<hr>

{!! Form::open(array('action' => 'RecordController@store')) !!}

<div class="form-group">
  {!! form::label('assetid', 'Asset ID:', ['class'=> 'control-label']) !!}
  {!! form::text('fk_assetid', "$hardware->hw_assetid", ['class'=> 'form-control', 'readonly'=>'readonly','value'=>"$hardware->hw_assetid" ]  )!!}

  {!! form::label('assignto','For Staff ID:', ['class'=> 'control-label'] )!!}
  {!! Form::text('current_userid', null, ['class' => 'form-control']) !!}
  <span class="help-block"><sup>&nbsp&nbsp&nbsp&nbspEnter staff ID to be assigned to.</sup></span>

  {!! Form::label('assigndate', "Handed on:", ['class' => 'control-label']) !!}<br>
  {!! form::text( '','' , ['class'=> 'form-control', 'placeholder'=> "$datenow", 'disabled'=>'disabled']  )!!}

  {!! form::label('remark','Remarks:', ['class'=> 'control-label'] )!!}
  {!! Form::textarea('remark', null, ['class' => 'form-control']) !!}

  {!! Form::hidden('id', "$hardware->id") !!}


</div>
{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
<a href="{{URL::previous()}}" class="btn btn-default">Cancel</a>
{!! Form::close() !!}
@stop
