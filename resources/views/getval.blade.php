<?php     $getFirstSwAvailble = DB::table('software')
                          ->where('sw_model', 'Microsoft AMES')
                          ->where('sw_status', 0)
                          ->first();

 ?>
@if($getFirstSwAvailble == null)
kosong
@else
{{print_r($assetid)}}
{{die()}}
@endif
