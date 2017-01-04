<?php
  $statchg = DB::table('hwrecord')->where('id', '>', '1540')->get();
  //var_dump($statchg);
  //die();
  $x=0;
  $y=0;
  $z=0;
  $w=0;
  $v=0;
?>
@foreach($statchg as $chg)
  @if($chg->status == 1)
  <?php DB::table('hardware')->where('id', $chg->fk_assetid) ->update(['hw_status' => 1]);
  $x++;
  ?>
  @elseif($chg->status == 3)
  <?php DB::table('hardware')->where('id', $chg->fk_assetid) ->update(['hw_status' => 2]);
  $y++;
  ?>
  @elseif($chg->status == 4)
  <?php DB::table('hardware')->where('id', $chg->fk_assetid) ->update(['hw_status' => 3]);
  $z++;
  ?>
  @elseif($chg->status == 5)
  <?php DB::table('hardware')->where('id', $chg->fk_assetid) ->update(['hw_status' => 4]);
  $w++;
  ?>
  @endif
  <?php $v++; ?>
@endforeach

TOTAL record changed: {{$v}} <br>
Assigned: {{$x}} <br>
Faulty: {{$y}} <br>
BER: {{$z}} <br>
Stolen: {{$w}} <br>
