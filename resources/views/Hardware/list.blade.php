@extends('master')
@section('content')
<div >
  <div >
    <div >
      <h4><i class="fa fa-angle-right"></i>Hardware List</h4>
        <table class="table table-bordered table-striped table-hover" id="tableA">
          <thead><tr>
            <th>ID</th>
            <th>Asset ID</th>
            <th>Serial No.</th>
            <th>Model</th>
            <th>PO No.</th>
            <th>PO Date</th>
            <th>Supplier</th>
            <th>Part No.</th>
            <th>Price</th>
            <th>Type</th>
            <th>Date Supplied</th>
            <th>Date Transfered to Facility</th>
            <th></th>
            <th></th>
          </tr></thead>
          <tbody>
                @foreach ($allHardware as $hw)
            <tr>
            <td>{{ $hw->id }}</td>
            <td>{{ $hw->hw_assetid }}</td>
            <td>{{ $hw->hw_serialno }}</td>
            <td>{{ $hw->hw_model }}</td>
            <td>{{ $hw->hw_po_no }}</td>
            <td>{{ $hw->hw_date_po }}</td>
            <td>{{ DB::table('supplier')->where('supp_id',$hw->hw_supplier)->value('supp_name')}}</td>
            <td>{{ $hw->hw_part_no }}</td>
            <td>{{ $hw->hw_price }}</td>
            <td>{{ $hw->hw_type }}</td>
            <td>{{ $hw->hw_datesupp }}</td>
            <td>{{ $hw->hw_datefac }}</td>
           <td><a href="#" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a></td>
           <td><a href="#" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></a></td>
          </tr>  @endforeach
       </tbody>
          </table>
      </div><!-- /content-panel -->
   </div><!-- /col-lg-4 -->
</div><!-- /row -->
@stop
