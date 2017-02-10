<?php
use Illuminate\Support\Facades\DB;
use App\Hardware;


DB::setFetchMode(PDO::FETCH_ASSOC);
$data = DB::table('hardware')
->select(DB::raw('hw_model,count(hw_serialno) AS Quantity, round((datediff(curdate(),hw_datesupp)/365)) AS Age'))
->where('hw_type', 'notebook')
->where('hw_model', '!=', '')
->where('hw_datesupp', '!=', '0000-00-00')
->groupBy('hw_model')
->orderBy('Age', 'desc')->get()
->toArray();
//$data = Hardware::get()->toArray();
DB::setFetchMode(PDO::FETCH_CLASS);
var_dump($data);
die();


?>
