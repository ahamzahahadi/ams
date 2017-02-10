<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Hardware;
use Excel;





class ExcelController extends Controller{

    public function hwAgeReport(){
      return view('Report.age');
    }

    public function downloadExcel(){
      $data = DB::table('hardware')
      ->select(DB::raw('hw_model,count(hw_serialno) AS Quantity, round((datediff(curdate(),hw_datesupp)/365)) AS Age'))
      ->where('hw_type', 'notebook')
      ->where('hw_model', '!=', '')
      ->where('hw_datesupp', '!=', '0000-00-00')
      ->groupBy('hw_model')
      ->orderBy('Age', 'desc')->get()
      ->toArray();
      $data = json_decode(json_encode($data), true);

      return Excel::create('Hardware Age Report', function($excel) use ($data) {
          $excel->sheet('Sapura List of Notebook Age', function($sheet) use ($data){
            $sheet->cells('A1:C1', function($cells) {

              $cells->setFont(array(
                  'family'     => 'Calibri',
                  'size'       => '16',
                  'bold'       =>  true
              ));
});
            $sheet->setBorder('A1:C1', 'thin');
            $sheet->fromArray($data);
          });
      })->export('xlsx');
    }


}
