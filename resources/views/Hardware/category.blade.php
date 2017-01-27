@extends('master')
@section('content')
<link href="{{ URL::asset('css/cate.css') }}" rel="stylesheet">

<h1> Select hardware category to view </h1><hr>
<div class="row mt">
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 desc">
    <div id="poptext">
      <a href="{{ action('HardwareController@cat', 'Desktop')}}">
        <img src="{{URL::asset('img/hardware/Desktop.png')}}" width=100 height=100 >
      </a>
      <p> Desktop </p>
    </div>
  </div>

  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 desc">
    <div id="poptext" >
      <a href="{{ action('HardwareController@cat', 'Notebook')}}">
        <img src="{{URL::asset('img/hardware/Laptop.png')}}" width=100 height=100 >
      </a>
      <p> Notebook </p>
    </div>
  </div>

  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 desc">
    <div id="poptext" >
      <a href="{{ action('HardwareController@cat', 'Gadget')}}">
        <img src="{{URL::asset('img/hardware/gadget.png')}}" width=100 height=100 >
      </a>
      <p> Gadgets </p>
    </div>
  </div>

</div>
<!-- 2nd row -->
<div class="row mt">
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 desc">
    <div id="poptext">
      <a href="{{ action('HardwareController@cat', 'HDD')}}">
        <img src="{{URL::asset('img/hardware/hdd.png')}}" width=100 height=100 >
      </a>
      <p> Hard Disk Drive </p>
    </div>
  </div>

  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 desc">
    <div id="poptext" >
      <a href="{{ action('HardwareController@cat', 'Peripheral')}}">
        <img src="{{URL::asset('img/hardware/mouse.png')}}" width=100 height=100 >
      </a>
      <p> Peripherals </p>
    </div>
  </div>

  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 desc">
    <div id="poptext" >
      <a href="{{ action('HardwareController@cat', 'Network')}}">
        <img src="{{URL::asset('img/hardware/network.png')}}" width=100 height=100 >
      </a>
      <p> Network </p>
    </div>
  </div>

</div>

<br><br><br>
<a  href="/hardware"><h2 style="text-align: center;"><b>List All Hardware</b></h2></a>

@stop
