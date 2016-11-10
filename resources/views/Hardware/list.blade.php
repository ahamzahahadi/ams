@extends('mainmain.blank')

@section('content')



<div class="container">
    <div class="row">    
        <div class="col-xs-8 col-xs-offset-2">
            <div class="input-group">
                <div class="input-group-btn search-panel">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span id="search_concept">Filter by</span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#contains">Contains</a></li>
                      <li><a href="#its_equal">It's equal</a></li>
                      <li><a href="#greather_than">Greather than ></a></li>
                      <li><a href="#less_than">Less than < </a></li>
                      <li class="divider"></li>
                      <li><a href="#all">Anything</a></li>
                    </ul>
                </div>
                <input type="hidden" name="search_param" value="all" id="search_param">         
                <input type="text" class="form-control" name="x" placeholder="Search term...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
        </div>
    </div>
</div>
        





                <div class="row mt">
                    <div class="col-lg-12">
                      <div class="content-panel">
                      <h4><i class="fa fa-angle-right"></i>Hardware List</h4>
                          <section id="unseen">
                            <table class="table table-bordered table-sm table-inverse table-striped table-condensed">
                              <thead>
                              <tr>

                    
                        <tr>

                                <th class="numeric">ID</th>
                                  <th class="numeric">Asset ID</th>
                                  <th class="numeric">Serial No.</th>
                                  <th class="numeric">Model</th>
                                  <th class="numeric">PO No.</th>
                                  <th class="numeric">PO Date</th>
                                  <th class="numeric">Supplier</th>
                                  <th class="numeric">Part No.</th>
                                  <th class="numeric">Price</th>
                                  <th class="numeric">Type</th>
                                  <th class="numeric">Date Supplied</th>
                                  <th class="numeric">Date Transfered to Facility</th>

                        </tr>



                



                    
                    </thead>
                        @foreach ($allHardware as $hw)
                          
                              <tbody>
                              <tr>

                                <td class="numeric">{{ $hw->id }}</td>
                                <td class="numeric">{{ $hw->hw_assetid }}</td>
                                
                                <td class="numeric">{{ $hw->hw_serialno }}</td>

                                <td class="numeric">{{ $hw->hw_model }}</td>
                                <td class="numeric">{{ $hw->hw_po_no }}</td>
                                <td class="numeric">{{ $hw->hw_date_po }}</td>
                                <td class="numeric">{{ $hw->hw_supplier }}</td>
                                <td class="numeric">{{ $hw->hw_part_no }}</td>
                                <td class="numeric">{{ $hw->hw_price }}</td>
                                <td class="numeric">{{ $hw->hw_type }}</td>
                                <td class="numeric">{{ $hw->hw_datesupp }}</td>
                                <td class="numeric">{{ $hw->hw_datefac }}</td>
                               <td><a href="#" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a></td>
                               <td><a href="#" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></a></td>
                            </tr>
                        </tbody>
                
                        @endforeach
                         </tr>
                              
                







                          </table>
                          
                  </div><!-- /content-panel -->
               </div><!-- /col-lg-4 -->         
            </div><!-- /row -->
            

</div>
@stop