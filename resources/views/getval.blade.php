{!! $value2 = DB::table('hwtype')->where('flag', 1)->orderBy('type', 'asc')->pluck('type'); !!}

{!! $value = DB::table('supplier')->orderBy('supp_name', 'asc')->pluck('id')!!}
{!! $getone = 2;!!}

<br><br>
{!! $value[$getone] !!}<br><br>
{!! $value2[$getone] !!}<br><br>
@foreach ($value as $val)
{{$val}} <br>
@endforeach
