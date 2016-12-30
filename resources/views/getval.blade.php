<?php
        $convertkey = DB::table('hwrecord')->where('id', '>', '741')
                ->get();
                $x=1;
?>

@foreach($convertkey as $key)
{{$x}}) {{$key->fk_assetid}} -done<br>
<?php
$getassetid = DB::table('hardware')->where('hw_serialno', 'LIKE', '%'.$key->fk_assetid.'%')->first(); //dapat asset id
?>
@if($key->status == 1)
<?php DB::table('hardware')->where('hw_serialno', $key->fk_assetid)->update(['hw_status' => 1]);
// @elseif($key->status == 3)
//  update to 2 (faulty)
// @elseif($key->status == 4)
//   update to 3 (BER)?>
@endif
<?php DB::table('hwrecord')->where('id', $key->id)->update(['fk_assetid' => $getassetid->id]);
$x++; ?>
@endforeach
