@extends('master')
@section('content')
<h1> Software Release Form </h1>
<hr>

{!! Form::open(array('action' => 'SwRecordController@uninstall')) !!}

<div class="form-group">
  {!! form::label('assetid', 'Software Asset ID:', ['class'=> 'control-label']) !!}
  {!! form::text('sw_assetid', "$software->sw_assetid", ['class'=> 'form-control', 'readonly'=>'readonly','value'=>"$software->sw_assetid" ]  )!!}

  {!! Form::label('uninstalldate', "Uninstalled on:", ['class' => 'control-label']) !!}<br>
  {!! form::text( '','' , ['class'=> 'form-control', 'placeholder'=> "$datenow", 'disabled'=>'disabled']  )!!}

  {!! form::label('remark', 'Remarks:', ['class'=> 'control-label'])!!}
  {!! form::textarea('remark',null, ['class'=> 'form-control']) !!}


</div>
{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
<a href="{{URL::previous()}}" class="btn btn-default">Cancel</a>
{!! Form::close() !!}

@stop
