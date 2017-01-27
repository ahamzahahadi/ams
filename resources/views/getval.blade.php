<?php
$ayam = DB::table('hardware')
->select(DB::raw('hw_model,count(hw_serialno) AS Quantity, round((datediff(curdate(),hw_date_po)/365)) AS Age'))
->where('hw_type', 'notebook')
->where('hw_model', '<>', '')
->groupBy('hw_model','hw_date_po')
->get();

var_dump($ayam);
die();
 ?>
