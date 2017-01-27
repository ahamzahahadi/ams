@extends('master')
@section('content')
<link href="{{ URL::asset('css/catesw.css') }}" rel="stylesheet">

<h1> Select software category to view </h1><hr>
<div class="row mt">
  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 desc">
    <div id="poptext">
      <a href="{{ action('SoftwareController@cat', 'Adobe Product')}}">
        <img src="{{URL::asset('img/software/adobe.png')}}" width=100 height=100 >
      </a>
      <p> Adobe Products </p>
    </div>
  </div>

  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 desc">
    <div id="poptext" >
      <a href="{{ action('SoftwareController@cat', 'Microsoft Office')}}">
        <img src="{{URL::asset('img/software/office.png')}}" width=100 height=100 >
      </a>
      <p> MS Office </p>
    </div>
  </div>

  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 desc">
    <div id="poptext" >
      <a href="{{ action('SoftwareController@cat', 'Geographic Information System')}}">
        <img src="{{URL::asset('img/software/mapinfo.png')}}" width=100 height=100 >
      </a>
      <p> Geographical Information System </p>
    </div>
  </div>

  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 desc">
    <div id="poptext">
      <a href="{{ action('SoftwareController@cat', 'Antivirus')}}">
        <img src="{{URL::asset('img/software/antivirus.png')}}" width=100 height=100 >
      </a>
      <p> Antivirus </p>
    </div>
  </div>
</div>
<!-- 2nd row -->
<br><br>
<div class="row mt">

  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 desc">
    <div id="poptext" >
      <a href="{{ action('SoftwareController@cat', 'Management Tool')}}">
        <img src="{{URL::asset('img/software/management.png')}}" width=100 height=100 >
      </a>
      <p> Management Tools </p>
    </div>
  </div>

  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 desc">
    <div id="poptext" >
      <a href="{{ action('SoftwareController@cat', 'Monitoring Software')}}">
        <img src="{{URL::asset('img/software/monitoring.png')}}" width=100 height=100 >
      </a>
      <p> Monitoring Tools </p>
    </div>
  </div>

  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 desc">
    <div id="poptext">
      <a href="{{ action('SoftwareController@cat', 'Development Tool')}}">
        <img src="{{URL::asset('img/software/development.png')}}" width=100 height=100 >
      </a>
      <p> Dev. Tools </p>
    </div>
  </div>

  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 desc">
    <div id="poptext" >
      <a href="{{ action('SoftwareController@cat', 'Operating System')}}">
        <img src="{{URL::asset('img/software/os.png')}}" width=100 height=100 >
      </a>
      <p> Operating System </p>
    </div>
  </div>
</div>
<br><br>

<div class="row mt">

  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 desc">
    <div id="poptext" >
      <a href="{{ action('SoftwareController@cat', 'Warranty')}}">
        <img src="{{URL::asset('img/software/warranty.png')}}" width=100 height=100 >
      </a>
      <p> Warranty </p>
    </div>
  </div>

  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 desc">
    <div id="poptext" >
      <a href="{{ action('SoftwareController@cat', 'Others')}}">
        <img src="{{URL::asset('img/software/others.png')}}" width=100 height=100 >
      </a>
      <p> Others </p>
    </div>
  </div>

</div>

<br><br><br>
<a  href="/software"><h2 style="text-align: center;"><b>List All Software</b></h2></a>

@stop
