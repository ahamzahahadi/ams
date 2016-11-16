@extends('master')
@section('content')
<div >
  <div >
    <div >
      <h4><i class="fa fa-angle-right"></i>Supplier List</h4>
        <table class="table table-bordered table-striped table-hover" id="tableA">
          <thead><tr>
            <th>Supplier ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Contact</th>
            <th></th>
            <th></th>
          </tr></thead>
          <tbody>
                @foreach ($supplierList as $sp)
            <tr>
            <td>{{ $sp->supp_id }}</td>
            <td>{{ $sp->supp_name }}</td>
            <td>{{ $sp->supp_address }}</td>
            <td>{{ $sp->supp_contact }}</td>
           <td><a href="#" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a></td>
           <td><a href="#" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></a></td>
          </tr>  @endforeach
       </tbody>
          </table>
      </div><!-- /content-panel -->
   </div><!-- /col-lg-4 -->
</div><!-- /row -->
@stop
