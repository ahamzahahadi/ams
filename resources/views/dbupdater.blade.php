//assigned own asset id
<?php
        $noid = DB::table('hardware')
                ->where('hw_assetid', '')
                ->get();
        $x =  9000000001;
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
