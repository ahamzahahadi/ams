<?php
$model = 'Lenovo Think Pad X220';
$status = 1;
$query3 = DB::select(DB::raw("
SELECT st.staff_name,hw.hw_serialno,hw.hw_model, st.staff_dept,st.staff_company
FROM hwrecord hr
LEFT JOIN staff st on hr.current_userid=st.staff_id
LEFT JOIN hardware hw on hr.fk_assetid=hw.id
WHERE hw.hw_model = '$model'
AND hw.hw_status = $status
AND hr.current_userid != 'x404'
"));

var_dump($query3);
die();
?>
