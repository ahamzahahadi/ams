@extends('layouts.app')

@section('content')

<h1>Add new Hardware</h1>
<p class="lead">Use the form below to add new hardware to store.</p>
<hr>

{!! Form::open([
    'route' => 'hardware.store'
]) !!}

<div class="form-group">
    {!! Form::label('title', 'Title:', ['class' => 'control-label']) !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}

    {!! Form::label('description', 'Description:', ['class' => 'control-label']) !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>
{!! Form::submit('Create New Task', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

@stop