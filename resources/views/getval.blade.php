

{!! $value = DB::table('supplier')->orderBy('supp_name', 'asc')->pluck('supp_id')!!}
{!! $getone = 2;!!}

<br><br>
{!! $value[$getone] !!}<br><br>
@foreach ($value as $val)
{{$val}} <br>
@endforeach
