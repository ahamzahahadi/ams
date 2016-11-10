@extends('mainmain.blank')

@section('content')
<div><h1> Hardware List <h1>
                <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="tableA">
                    <thead>
                        <tr>
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
                        </tr>
                    </thead>
                        @foreach ($allHardware as $hw)
                           <tr>
                                <td>{{ $hw->id }}</td>
                                <td>{{ $hw->hw_assetid }}</td>
                                <td>{{ $hw->hw_serialno }}</td>
                                <td>{{ $hw->hw_model }}</td>
                                <td>{{ $hw->hw_po_no }}</td>
                                <td>{{ $hw->hw_date_po }}</td>
                                <td>{{ $hw->hw_supplier }}</td>
                                <td>{{ $hw->hw_part_no }}</td>
                                <td>{{ $hw->hw_price }}</td>
                                <td>{{ $hw->hw_type }}</td>
                                <td>{{ $hw->hw_datesupp }}</td>
                                <td>{{ $hw->hw_datefac }}</td>
                                <td>
                                       
                                </td>
                                <td>
                                       
                                </td>
                            </tr>
                        @endforeach
                    
                </table>
            </div>
</div>
@stop