@extends('master')
@section('content')

<link href="{{ URL::asset('css/to-do.css') }}" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Home</div>

                <div class="panel-body">
                    You are logged in! this is home.blade
                </div>


            </div>
            </div>
        </div>
        <!-- SORTABLE LOAN LIST -->
        <div class="row">
                    <div class="col-md-5">
                        <section class="task-panel tasks-widget">
                      <div class="panel-heading">
                            <div class="pull-left"><h5><i class="fa fa-pencil-square-o"></i>  Quick Loan Log </h5></div>
                            <br>
                      </div>
                            <div class="panel-body">
                                <div class="task-content">
                                    <ul id="sortable" class="task-list">
                                      <?php $rekodpeminjam = DB::table('loan')->get(); ?>
                                      @foreach($rekodpeminjam as $peminjam)
                                        <li class="list-primary">
                                            <div class="task-checkbox">
                                                <input type="checkbox" class="list-child" value=""  />
                                            </div>
                                            <div class="task-title">
                                                <span class="badge bg-theme">Yesterday</span>
                                                <span class="task-title-sp">{{$peminjam->borrower}} borrowed {{$peminjam->item}}</span>
                                                <div class="pull-right hidden-phone">
                                                    {!! Form::open(['method' => 'DELETE','route' => ['loan.padam', $peminjam->id]]) !!}
                                                    {!! Form::button('', ['type' => 'submit', 'class' => 'btn btn-danger', 'class'=>'fa fa-trash-o'] )  !!}
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </li>
                                      @endforeach
                                    </ul>
                                </div>
                                <div class=" add-task-row">
                                  <button class="btn btn-success btn-sm pull-left" data-toggle="modal" data-target="#myModal">Add New Record</button>
                                </div>
                            </div>
                        </section>
                    </div><!--/col-md-12 -->

                    <div class="col-md-5">
                        <div class="content-panel">
              <h4><i class="fa fa-angle-right"></i> Pie</h4>
                            <div class="panel-body text-center">
                                <canvas id="pie" height="300" width="400"></canvas>
                            </div>
                        </div>
                    </div>


          </div> <!--penutup row untuk quick loan-->
        <!-- end of sortable loan list -->
    </div>

@include('modal.addloaner')
<!-- page-specific scripting -->
<script src={{ url('http://code.jquery.com/ui/1.10.3/jquery-ui.js') }} </script>
<script src="{{ URL::asset('js/tasks.js') }}" type="text/javascript"></script>
<script>
  jQuery(document).ready(function() {
      TaskList.initTaskWidget();
  });
  $(function() {
      $( "#sortable" ).sortable();
      $( "#sortable" ).disableSelection();
  });
</script>
<script>
    $(function(){
        $('select.styled').customSelect();
    });
</script>
@endsection
