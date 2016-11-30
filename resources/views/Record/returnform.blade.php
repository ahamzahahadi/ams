@extends('master')
@section('content')
<h1> Fixed Asset Return Form </h1>
<hr>

{!! Form::open(array('action' => 'RecordController@returnedit')) !!}

<div class="form-group">
  {!! form::label('assetid', 'Asset ID:', ['class'=> 'control-label']) !!}
  {!! form::text('fk_assetid', "$hardware->hw_assetid", ['class'=> 'form-control', 'readonly'=>'readonly','value'=>"$hardware->hw_assetid" ]  )!!}

  {!! Form::label('assigndate', "Returned on:", ['class' => 'control-label']) !!}<br>
  {!! form::text( '','' , ['class'=> 'form-control', 'placeholder'=> "$datenow", 'disabled'=>'disabled']  )!!}

  {!! form::label('location', 'Return location:', ['class'=> 'control-label'])!!}
  {!! form::text('location',null, ['class'=> 'form-control']) !!}

  {!! form::label('remark', 'Remarks:', ['class'=> 'control-label'])!!}
  {!! form::textarea('remark',null, ['class'=> 'form-control']) !!}



</div>
{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
<a href="{{URL::previous()}}" class="btn btn-default">Cancel</a>
{!! Form::close() !!}
@stop
