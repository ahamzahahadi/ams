//assigned own asset id
<?php
        $noid = DB::table('hardware')
                ->where('hw_assetid', '')
                ->get();
        $x =  9000000001; //self generated -- now at 9000001033
 ?>
@foreach($noid as $nono)
<br> {{$x}} - {{$nono->hw_serialno}}
    {{DB::table('hardware')->where('id', $nono->id)->update(['hw_assetid'=> $x])}}
<?php $x++ ?>
@endforeach

//replace serial no with asset id in hwrecord, update hw_status to 1
<?php
        $noid = DB::table('hwrecord')->where('fk_assetid', '')
                ->get();
                $x=1;
?>

@foreach($noid as $nono)
{{$x}}) {{$nono->serialno}} -done<br>
<?php
$getassetid = DB::table('hardware')->where('hw_serialno', 'LIKE', '%'.$nono->serialno.'%')->first(); //dapat asset id
DB::table('hardware')->where('hw_serialno', $nono->serialno)->update(['hw_status' => 1]);
DB::table('hwrecord')->where('serialno', $nono->serialno)->update(['fk_assetid' => $getassetid->hw_assetid]);
$x++; ?>
@endforeach

//get available hw test

<?php
  $valhwname = DB::table('hardware')->distinct()->orderBy('hw_model','asc')->get(['hw_model', 'hw_type']);
?>
@foreach($valhwname as $val)
<?php $counter = DB::table('hardware')->where('hw_status', 0)->where('hw_model', $val->hw_model)->count();?>
{{$val->hw_model}} <font color="red"> {{$counter}} units available <br> </font>
@endforeach

//availability, grouped by hw_model
<?php $valhwname = DB::table('hardware')->distinct()->orderBy('hw_model','asc')->get(['hw_model', 'hw_type']);
 ?>

 @foreach($valhwname as $valala)
 {{$valala->hw_model}} is {{$valala->hw_type}}

 <?php $counter = DB::table('hardware')->where('hw_status', 0)->where('hw_model', $valala->hw_model)
 ->count(); ?>
<font color=red> {{$counter}} units available <br> </font>

 @endforeach

<br> <font color=red> HABIS CATEGORY <font> <br>


//check asset to use new ID
<?php
$tunjuk = DB::table('updater')->get();
$bendenkupdate = DB::table('hardware')->get();
$x= 1;
?>

@foreach($bendenkupdate as $ok)
{{$x}}<font color=blue> {{$ok->hw_assetid}} </font>
  @foreach($tunjuk as $tun)
    @if($tun->old == $ok->hw_assetid)
    <font color=green> {{$tun->old}} </font>
    <font color=red> {{$tun->new}} </font>
    @endif
  @endforeach
<br><?php $x++ ?>
@endforeach

//change assetid dependency in HW REC to self generated id
<?php
  $old = DB::table('hwrecord')->get();
  $getid = DB::table('hardware')->select('id','hw_assetid')->get();

?>

@foreach($old as $renew)
  @foreach($getid as $id)
    @if($renew->fk_assetid == $id->hw_assetid)
 <?php
 DB::table('hwrecord')->where('fk_assetid', $renew->fk_assetid)->update(['fk_assetid' => $id->id]);
 ?>
    @endif
  @endforeach
@endforeach

//chg from wrongly assigned peripheral to HDD
UPDATE `hardware` SET `hw_model`= 'HP 500GB 6G SAS 7.2K 2.5" HDD',`hw_company`='SST',`hw_type`='HDD',`hw_class`= 'Standard' WHERE `hw_model` LIKE '%HP 500GB 6G SAS 7.2K 2.5%'

//deleted records with duplicate serialno
<?php
//$dupserial = DB::table('hardware')->select('hw_serialno')->where('hw_serialno', '!=', '')->get();
$dupserial = DB::table('hardware')->select('hw_serialno')->where('hw_serialno', '!=', '')->groupby('hw_serialno')->having(DB::raw('count(*)'),'>',1)->get();
//$dedup = DB::table('hardware')->where('hw_serialno', 'WXE606603164')->get();
 //var_dump($dedup);
 //die();
$x = 1;
?>

@foreach($dupserial as $dup)
    <?php $dedup = DB::table('hardware')->where('hw_serialno', $dup->hw_serialno)->get(); ?>
    <?php $y = 1 ?>
    @foreach($dedup as $dudu)
      @if($y == 2)
        <?php DB::table('hardware')->where('id', $dudu->id)->delete(); ?>
      @else
        SAVED: {{$x}}) {{$dudu->hw_assetid}} with key {{$dudu->hw_serialno}} -{{$y}}<br>
      @endif
    <?php $y++; ?>
    @endforeach
    <?php $x++; ?>
@endforeach

//change status for new record with status == 1 (with user)
<?php
  $statchg = DB::table('hwrecord')->where('id', '>', '660')->get();
  //var_dump($statchg);
  //die();
  $x=1;
?>
@foreach($statchg as $chg)
  @if($chg->status == 1)
  <?php DB::table('hardware')->where('id', $chg->fk_assetid) ->update(['hw_status' => 1]);
  $x++;
  ?>
  @endif
@endforeach

TOTAL record changed: {{$x}}

//delete OLD SRSB history and update notebook status back to 0
<?php
$toDelete = DB::table('hwrecord')->where('id','<','483')->get();
// var_dump($toDelete);
// die();
?>
@foreach($toDelete as $del)
  <?php DB::table('hardware')->where('id', $del->fk_assetid)->update(['hw_status' => 0]);
        DB::table('hwrecord')->where('id', $del->id)->delete();
  ?>
    Hardware id: {{$del->fk_assetid}} has change status to 0 (available) <br>
    Record ref: {{$del->id}} has been deleted <br>
@endforeach
