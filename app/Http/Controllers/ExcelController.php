<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Hardware;
use App\Software;
use Excel;
use Illuminate\Support\Facades\Input;


class ExcelController extends Controller{

    public function hwAgeReport(){
      return view('Report.age');
    }

    public function downloadExcel(){
      $data = DB::table('hardware')
      ->select(DB::raw('hw_model,hw_po_no,count(hw_serialno) AS Quantity, round((datediff(curdate(),hw_datesupp)/365)) AS Age'))
      ->where('hw_type', 'notebook')
      ->where('hw_model', '!=', '' )
      ->where('hw_datesupp', '!=', '0000-00-00')
      ->groupBy('hw_model')
      ->orderBy('Age', 'desc')->get()
      ->toArray();
      $data = json_decode(json_encode($data), true);

      return Excel::create('Hardware Age Report', function($excel) use ($data) {
          $excel->sheet('Sapura List of Notebook Age', function($sheet) use ($data){
            $sheet->cells('A1:D1', function($cells) {
              $cells->setFont(array(
                  'family'     => 'Calibri',
                  'size'       => '16',
                  'bold'       =>  true
              ));
            });
            $sheet->setBorder('A1:D1', 'thin');
            $sheet->fromArray($data);
          });
      })->export('xlsx');
    }

    public function getHwImport(){
      return view('Report.hwImport');
    }

    public function hwImportHandler(Request $request){
      $newbatch = Excel::load(Input::file('batchhw'),function($reader){})->get();
        $datepo = $request->input('hw_date_po');
        $datesupp = $request->input('hw_datesupp');
        $datefac = $request->input('hw_datefac');

      foreach($newbatch as $new){
        $hardware = new Hardware;
        $hardware->hw_assetid = $new->hw_assetid;
        $hardware->hw_serialno = $new->hw_serialno;
        $hardware->hw_model = $new->hw_model;
        $hardware->hw_po_no = $new->hw_po_no;
        $hardware->hw_supplier = $new->hw_supplier;
        $hardware->hw_part_no = $new->hw_part_no;
        $hardware->hw_price = $new->hw_price;
        $hardware->hw_type = $new->hw_type;
        $hardware->hw_company = $new->hw_company;
        $hardware->hw_class = $new->hw_class;
        $hardware->hw_location = $new->hw_location;
        $hardware->hw_remark = $new->hw_remark;
        $hardware->hw_date_po = $datepo;
        $hardware->hw_datesupp = $datesupp;
        $hardware->hw_datefac = $datefac;
        $hardware->save();
      }


      flash()->success('Success!', 'Your new batch of hardware has been successfully imported.');
      return redirect()->back();
    }

    public function getSwImport(){
      return view('Report.swImport');
    }

    public function swImportHandler(Request $request){
      $newbatch = Excel::load(Input::file('batchsw'),function($reader){})->get();
        $datepo = $request->input('sw_date_po');
        $datesupp = $request->input('sw_datesupp');
        $datefac = $request->input('sw_datefac');

      foreach($newbatch as $new){
        $software = new Software;
        $software->sw_assetid = $new->sw_assetid;
        $software->sw_serialno = $new->sw_serialno;
        $software->sw_model = $new->sw_model;
        $software->sw_prodkey = $new->sw_prodkey;
        $software->sw_po_no = $new->sw_po_no;
        $software->sw_price = $new->sw_price;
        $software->sw_supplier = $new->sw_supplier;
        $software->sw_type = $new->sw_type;
        $software->sw_variation = $new->sw_variation;
        $software->sw_remark = $new->sw_remark;
        $software->sw_company = $new->sw_company;
        $software->sw_date_po = $datepo;
        $software->sw_datesupp = $datesupp;
        $software->sw_datefac = $datefac;
        $software->save();

      }
      flash()->success('Success!', 'Your new batch of software has been successfully imported.');
      return redirect()->back();
    }

      public function generateHwReport(Request $request){
        $reporttype = $request->input('reporttype');
        $category = $request->input('category');
        $model = $request->input('model');
        $hw_status = $request->input('hw_status');

        if($reporttype == '1'){
          $query = DB::select(DB::raw("
          SELECT st.staff_name,hw.hw_serialno, st.staff_dept,st.staff_company
          FROM hwrecord hr
          LEFT JOIN staff st on hr.current_userid=st.staff_id
          LEFT JOIN hardware hw on hr.fk_assetid=hw.id
          WHERE hw.hw_model = '$model'
          AND hw.hw_status = $hw_status
          AND hw.hw_type = '$category'
          AND hr.current_userid != 'x404'
          AND hr.current_userid != 'x405'
          AND hr.current_userid != 'WMIT'
          "));

        }elseif ($reporttype =='2'){//hw_status assigned 1, status hr pun kne with user 1, atau hw_status available, hr status 0 atau 2 (wmit atau with user)
          switch($hw_status){
            case 0: $hrstat = 0;break;
            case 1: $hrstat = 1;break;
            case 2: $hrstat = 3;break;
            case 3: $hrstat = 4;break;
            case 4: $hrstat = 5;break;
            case 5: $hrstat = 7;break;
            case 6: $hrstat = 6;break;
          }
          if($hw_status == 0){
            $query = DB::select(DB::raw("
            SELECT st.staff_name,st.staff_dept,hw.hw_serialno,hw.hw_model,hr.updated_at
            FROM hwrecord hr
            LEFT JOIN staff st on hr.current_userid=st.staff_id
            LEFT JOIN hardware hw on hr.fk_assetid=hw.id
            WHERE hw.hw_status = $hw_status
            AND (hr.status = 0 OR hr.status = 2)
            AND hw.hw_type = '$category'
            "));
          }
          else{
            $query = DB::select(DB::raw("
            SELECT st.staff_name,st.staff_dept,hw.hw_serialno,hw.hw_model,hr.updated_at
            FROM hwrecord hr
            LEFT JOIN staff st on hr.current_userid=st.staff_id
            LEFT JOIN hardware hw on hr.fk_assetid=hw.id
            WHERE hw.hw_status = $hw_status
            AND hr.status = $hrstat
            AND hw.hw_type = '$category'
            "));
          }


        }elseif ($reporttype =='3') {
          $query = DB::select(DB::raw("
          SELECT round((datediff(curdate(),hw.hw_datesupp)/365)) AS 'Age', st.staff_name,st.staff_dept,hw.hw_serialno,hw.hw_model
          FROM hwrecord hr
          LEFT JOIN staff st on hr.current_userid=st.staff_id
          LEFT JOIN hardware hw on hr.fk_assetid=hw.id
          WHERE hw.hw_type = '$category'
          AND hw.hw_status = 1
          AND hr.status = 1
          AND hr.current_userid != 'x404'
          AND hr.current_userid != 'x405'
          AND hr.current_userid != 'WMIT'
          ORDER BY Age desc
          "));

        }else{
          $query = DB::table('hardware')
          ->select(DB::raw('hw_model,hw_po_no,count(hw_serialno) AS Quantity, round((datediff(curdate(),hw_datesupp)/365)) AS Age'))
          ->where('hw_type', 'notebook')
          ->where('hw_model', '!=', '')
          ->where('hw_datesupp', '!=', '0000-00-00')
          ->where('hw_type', $category)
          ->groupBy('hw_model', 'hw_po_no') //add 'hw_po_no' to distinguish same model, but from different PO
          ->orderBy('Age', 'desc')
          ->get();
        }
        switch($hw_status){
          case 0: $hw_status = 'Available';break;
          case 1: $hw_status = 'Assigned';break;
          case 2: $hw_status = 'Faulty';break;
          case 3: $hw_status = 'BER';break;
          case 4: $hw_status = 'Stolen';break;
          case 5: $hw_status = 'Missing';break;
          case 6: $hw_status = 'MAF';break;
        }

        return view('report.custom', ['query' => $query])->with('type',$reporttype)->with('model',$model)->with('status',$hw_status)->with('cat',$category);
      }

}
