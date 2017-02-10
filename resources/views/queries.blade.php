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

--------------------------------------------------------------------------------------------------------------------

//convert imported SN in hw_rec to id of hardware
<?php
        $recserial = DB::table('hwrecord')->where('id', '>', '1540')
                ->get();
                $x=1;
?>


@foreach($recserial as $sn)
<?php
$getid = DB::table('hardware')->where('hw_serialno', 'LIKE', '%'.$sn->fk_assetid.'%')->first(); //dapat asset id
DB::table('hwrecord')->where('id', $sn->id)->update(['fk_assetid' => $getid->id]);
?>
{{$x}}) {{$sn->fk_assetid}} changed to {{$getid->id}} <font color=green>done</font><br>
<?php $x++ ?>
@endforeach
<?php $x=$x-1; ?>
TOTAL record changed: {{$x}}


--------------------------------------------------------------------------------------------------------------------

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


---------------------------------------------------------------------------------------------------------------------

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

---------------------------------------------------------------------------------------------------------------------
//update hardware status based on imported hw_rec

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


---------------------------------------------------------------------------------------------------------------------
SRSB TPP NB UPLOAD

TOTAL record changed: 645
Assigned: 474
Faulty: 40
BER: 66
Stolen: 7

---------------------------------------------------------------------------------------------------------------------
<script src="{{ URL::asset('js/jquery.js') }}"></script>
<script src="{{ URL::asset('js/typeahead.jquery.js') }}"></script>
<script src="{{ URL::asset('js/typeahead.bundle.js') }}"></script>
<script src="{{ URL::asset('js/bloodhound.js') }}"></script>

<div id="findstaff">
  <input class="typeahead" type="text" placeholder="Enter Staff Name">
</div>

<?php $staffname = DB::table('staff')->select('staff_name', 'staff_id')->get();
$staffdetail = array();
$arrlength = count($staffname);
$x=0;
?>
@foreach($staffname as $staff)
<?php $staffdetail[$x] = "$staff->staff_name <Staff ID: $staff->staff_id>";
$x++;
?>
@endforeach
<?php $json = json_encode($staffdetail); ?>
<script>
var staff = {!! $json !!};

var staff = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.whitespace,
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  // `states` is an array of state names defined in "The Basics"
  local: staff
});

$('#findstaff .form-control').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'staff',
  source: staff
});

</script>

----------------------------------------------------------------------------------------------
String manipulation on trimming bloodhound input
<?php $varku = 'Amirul Farid Amir Shapuddin <Staff ID: 8592>'; ?>
{{ $varku }} <br>

<?php $varku = strchr($varku, ':' ) ?>
lepas strchr jadi {{$varku}} <br>

<?php $varku = substr($varku, 2 ) ?>
lepas substr jadi {{$varku}} <br>

<?php $varku = str_ireplace('>','',$varku) ?>
lepas replace jadi {{$varku}} kuku<br>

----------------------------------------------------------------------------------------------
String output tester
<?php $stringku = 'Microsoft Office Home and Business 2011 (FPP) < RD7CK-VT4JX-9C8YP-B7FHP-M4V3Y >';

$stringku = strchr($stringku, '<');
$stringku = substr($stringku, 2);
$stringku = str_ireplace(' >','',$stringku);
$findSwUsingProdkey = DB::table('software')->where('sw_prodkey', $stringku)->where('sw_status', 0)->first();

var_dump($findSwUsingProdkey);
die();
?>
-------------------------------------------------------------------------------------------------------
SELECT hwrecord.`fk_assetid`, hwrecord.status, hardware.hw_status, hwrecord.id
FROM hwrecord INNER JOIN hardware
ON hwrecord.fk_assetid=hardware.id WHERE hwrecord.status = 1
AND hardware.hw_status = 0
-------------------------------------------------------------------------------------------------------
_____________QUERY FOR REQUISITIION LINE CHART_________________________________________
SELECT MONTHNAME(`created_at`) as 'Month', YEAR(`created_at`) as 'Year', COUNT(id)
FROM hwrecord
WHERE `created_at` != '0000-00-00 00:00:00'
AND `status` = '1'
GROUP BY YEAR(`created_at`), MONTH(`created_at`)
--------------------------------------------------------------------
SELECT MONTHNAME(`created_at`) as 'Month', YEAR(`created_at`) as 'Year',COUNT(id) as "req"
FROM hwrecord
WHERE `created_at` != "0000-00-00 00:00:00"
AND `status` = "1"
GROUP BY YEAR(`created_at`), MONTH(`created_at`)
ORDER BY YEAR(`created_at`) desc, MONTH(`created_at`) desc
LIMIT 11
----------------------------------------------------------------------------------------
_____________QUERY FOR ASSET RETURN LINE CHART_________________________________________
SELECT MONTHNAME(`created_at`) as 'Month', YEAR(`created_at`) as 'Year', COUNT(id)
FROM hwrecord
WHERE `created_at` != '0000-00-00 00:00:00'
AND `status` = '2'
GROUP BY YEAR(`created_at`), MONTH(`created_at`)

SELECT MONTHNAME(`created_at`) as 'Month', YEAR(`created_at`) as 'Year',COUNT(id) as "req"
FROM hwrecord
WHERE `created_at` != "0000-00-00 00:00:00"
AND `status` = "2"
GROUP BY YEAR(`created_at`), MONTH(`created_at`)
ORDER BY YEAR(`created_at`) desc, MONTH(`created_at`) desc
LIMIT 11
---------------------------------------------------------------------------------------
____________tester stacked bar chart______________________________________________________
<link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ URL::asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/style-responsive.css') }}" rel="stylesheet">
<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
<div id="morris">
<div class="col-lg-6">
    <div class="content-panel">
        <h4><i class="fa fa-angle-right"></i> Hardware in Active Duty</h4>
        <div class="panel-body">
            <div id="hero-bar" class="graph"></div>
        </div>
    </div>
</div>
</div>
<script src="{{ URL::asset('js/jquery.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('js/jquery.dcjqaccordion.2.7.js') }}" class="include" type="text/javascript" ></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>

<script src="{{ URL::asset('js/common-scripts.js') }}"></script>

<script>
Morris.Bar({
  element: 'hero-bar',
  stacked: true,
  data: [
    { y: '2006', a: 200, b: 90 },
    { y: '2007', a: 75,  b: 65 },
    { y: '2008', a: 50,  b: 40 },
    { y: '2009', a: 75,  b: 65 },
    { y: '2010', a: 50,  b: 40 },
    { y: '2011', a: 75,  b: 65 },
    { y: 'Current', a: 100, b: 90 }
  ],
  xkey: 'y',
  ykeys: ['a', 'b'],
  labels: ['Assigned', 'Inactive']
});
</script>
