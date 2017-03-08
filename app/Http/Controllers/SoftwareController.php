<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Software;
use Validator;
use Session;

class SoftwareController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $swList = Software::all();
        return view('software.list', ['swList' => $swList]);
    }

    public function cat($cat){
          $catsoftware = DB::table('software')->where('sw_type',$cat)->get();
          return view('software.bycategory', ['catsoftware' => $catsoftware])->with('category',$cat);
    }

    public function create()
    {
        return view('software.form');
    }

    public function store(Request $request)
    {
      $messages = ['required' => 'This field must be FILLED.',
                   'unique' => 'Duplicated asset id detected.'
      ];

      $rulesArr = [
                  'sw_assetid'=>'required',
                  'sw_date_po'=> 'date_format:"Y-m-d"',
                  'sw_datesupp'=> 'date_format:"Y-m-d"',
                  'sw_datefac'=> 'date_format:"Y-m-d"'
      ];

      $validation = Validator::make($request->all(),$rulesArr,$messages);

      if($validation->fails()){
          return redirect()->back()->withErrors($validation)->withInput($request->all());
      }

      $assetid = $request->input('sw_assetid');
      $serialno = $request->input('sw_serialno');
      $model = $request->input('sw_model');
      $prodkey = $request->input('sw_prodkey');
      $pono = $request->input('sw_po_no');
      if($request->input('sw_price') == ''){
        $price= '0.00';
      }
      else{$price = $request->input('sw_price');}

      if($request->input('sw_date_po') == ''){
        $datepono = '0000-00-00';
      }
      else{$datepono = $request->input('sw_date_po');}

      if($request->input('sw_datesupp') == ''){
        $datesup = '0000-00-00';
      }
      else{$datesup = $request->input('sw_datesupp');}

      if($request->input('sw_datefac') == ''){
        $datefac = '0000-00-00';
      }
      else{$datefac = $request->input('sw_datefac');}


      $supid = $request->input('sw_supplier');
      $typeIndexNo = $request->input('sw_type');
      $package = $request->input('sw_variation');

      $software = new Software;
      $software->sw_assetid = $assetid;
      $software->sw_serialno = $serialno;
      $software->sw_model = $model; //nama software
      $software->sw_prodkey = $prodkey;
      $software->sw_po_no = $pono;
      $software->sw_price = $price;
      $software->sw_date_po = $datepono;
      $software->sw_datesupp = $datesup;
      $software->sw_datefac = $datefac;
      $software->sw_supplier = $supid;
      $software->sw_type = $typeIndexNo;
      $software->sw_variation = $package;
      $software->sw_remark = $request->input('sw_remark');
      $software->sw_company = $request->input('sw_company'); //jgn lupa edit ni lepas dah repath ref key ke ID,lps dah tambah kat form dia

      $software->save();

      flash()->success('Success!', 'New record has been added.');
      return redirect()->action('SoftwareController@index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
      $data['software'] = Software::find($id);
      return view('software.edit',$data);
    }


    public function update(Request $request, $id)
    {
      $messages = ['required' => 'This field must be FILLED.',
                   'unique' => 'Duplicated asset id detected.'
      ];

      $rulesArr = [
                  'sw_assetid'=>'required',
                  'sw_date_po'=> 'date_format:"Y-m-d"',
                  'sw_datesupp'=> 'date_format:"Y-m-d"',
                  'sw_datefac'=> 'date_format:"Y-m-d"'
      ];

      $validation = Validator::make($request->all(),$rulesArr,$messages);

      if($validation->fails()){
          return redirect()->back()->withErrors($validation)->withInput($request->all());
      }

      $assetid = $request->input('sw_assetid');
      $serialno = $request->input('sw_serialno');
      $model = $request->input('sw_model');
      $prodkey = $request->input('sw_prodkey');
      $pono = $request->input('sw_po_no');
      if($request->input('sw_price') == ''){
        $price= '0.00';
      }
      else{$price = $request->input('sw_price');}

      if($request->input('sw_date_po') == ''){
        $datepono = '0000-00-00';
      }
      else{$datepono = $request->input('sw_date_po');}

      if($request->input('sw_datesupp') == ''){
        $datesup = '0000-00-00';
      }
      else{$datesup = $request->input('sw_datesupp');}

      if($request->input('sw_datefac') == ''){
        $datefac = '0000-00-00';
      }
      else{$datefac = $request->input('sw_datefac');}


      $supid = $request->input('sw_supplier');
      $typeIndexNo = $request->input('sw_type');
      $package = $request->input('sw_variation');

      $software = Software::find($id);
      $software->sw_assetid = $assetid;
      $software->sw_serialno = $serialno;
      $software->sw_model = $model; //nama software
      $software->sw_prodkey = $prodkey;
      $software->sw_po_no = $pono;
      $software->sw_price = $price;
      $software->sw_date_po = $datepono;
      $software->sw_datesupp = $datesup;
      $software->sw_datefac = $datefac;
      $software->sw_supplier = $supid;
      $software->sw_type = $typeIndexNo;
      $software->sw_variation = $package;
      $software->sw_remark = $request->input('sw_remark');
      $software->sw_company = $request->input('sw_company');

      $software->save();

      flash()->success('Success!', 'Update successful :D');
      return redirect()->action('SoftwareController@index');
    }


    public function destroy($id)
    {
      $recToDelete = Software::find($id);
      $recToDelete->delete();

      flash()->success('Success!', 'Deletion Successful.');
      return redirect()->action('SoftwareController@index');
    }
}
