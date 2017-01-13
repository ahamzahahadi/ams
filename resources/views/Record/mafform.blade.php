@extends('master')
@section('content')
<h1><font color=#63799b>Ownership Status Form for <strong> MAF </strong> </font></h1>
<hr>

{!! Form::open(array('action' => 'RecordController@changestatus')) !!}

<div class="form-group">
  {!! form::label('assetid', 'Asset ID:', ['class'=> 'control-label']) !!}
  {!! form::text('fk_assetid', "$hardware->hw_assetid", ['class'=> 'form-control', 'readonly'=>'readonly','value'=>"$hardware->id" ]  )!!}

  {!! Form::label('assigndate', "Switched status on:", ['class' => 'control-label']) !!}<br>
  {!! form::text( '','' , ['class'=> 'form-control', 'placeholder'=> "$datenow", 'disabled'=>'disabled']  )!!}

  {!! form::label('remark', 'Remarks:', ['class'=> 'control-label'])!!}
  {!! form::textarea('remark',null, ['class'=> 'form-control']) !!}

  {!! Form::hidden('hwid', "$hardware->id") !!}
  {!! Form::hidden('status', 6) !!}
  {!! Form::hidden('location', 'with MAF') !!}


</div>
{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
<a href="{{URL::previous()}}" class="btn btn-default">Cancel</a>
{!! Form::close() !!}
@stop
