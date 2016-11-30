{{ DB::table('supplier')->where('id',2)->value('supp_name')}}
{{DB::table('hardware')->where('hw_assetid', 'recordcontrollertest')->update(['hw_status' => 0, 'hw_location'=> 'dalam kasut'])}}
