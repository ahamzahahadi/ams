<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Hardware;
use App\Supplier;

use Validator;


class HardwareController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {

        $allHardware = Hardware::all();
        return view('hardware.list', ['allHardware' => $allHardware]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('hardware.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $messages = ['required' => 'This field must be FILLED.',
                   'unique' => 'Duplicated asset id detected.'
      ];

      $rulesArr = [
                  'hw_assetid'=>'required|unique:hardware',
                  'hw_date_po'=> 'date_format:"Y-m-d"',
                  'hw_datesupp'=> 'date_format:"Y-m-d"',
                  'hw_datefac'=> 'date_format:"Y-m-d"'
      ];

      $validation = Validator::make($request->all(),$rulesArr,$messages);

      if($validation->fails()){
          return redirect()->back()->withErrors($validation)->withInput($request->all());
      }

        $assetid = $request->input('hw_assetid');
        $serialno = $request->input('hw_serialno');
        $model = $request->input('hw_model');
        $partno = $request->input('hw_part_no');
        $pono = $request->input('hw_po_no');
        if($request->input('hw_price') == ''){
          $price= '0.00';
        }
        else{$price = $request->input('hw_price');}

        if($request->input('hw_date_po') == ''){
          $datepono = '0001-00-00';
        }
        else{$datepono = $request->input('hw_date_po');}

        if($request->input('hw_datesupp') == ''){
          $datesup = '0001-00-00';
        }
        else{$datesup = $request->input('hw_datesupp');}

        if($request->input('hw_datefac') == ''){
          $datefac = '0001-00-00';
        }
        else{$datefac = $request->input('hw_datefac');}


        $supid = $request->input('hw_supplier'); // get sorted index array from form to get index of suppname
        //$arrSup=DB::table('supplier')->orderBy('supp_name', 'asc')->pluck('supp_id');
        // get sorted supplier index based on name to get its id
        $typeIndexNo = $request->input('hw_type');
      //  $arrType=DB::table('hwtype')->orderBy('type', 'asc')->pluck('type');

        $hardware = new Hardware;
        $hardware->hw_assetid = $assetid;
        $hardware->hw_serialno = $serialno;
        $hardware->hw_model = $model;
        $hardware->hw_part_no = $partno;
        $hardware->hw_po_no = $pono;
        $hardware->hw_price = $price;
        $hardware->hw_date_po = $datepono;
        $hardware->hw_datesupp = $datesup;
        $hardware->hw_datefac = $datefac;
        $hardware->hw_supplier = $supid;
        $hardware->hw_type = $typeIndexNo;
        $hardware->save();

        return redirect()->action('HardwareController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data['hardware'] = Hardware::find($id);
      $supplier = Supplier::all();
      return view('hardware.edit',$data)->with('supplier',$supplier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $messages = ['required' => 'This field must be FILLED.',
                   'unique' => 'Duplicated asset id detected.'
      ];

      $rulesArr = [
                  'hw_assetid'=>'required|unique:hardware',
                  'hw_date_po'=> 'date_format:"Y-m-d"',
                  'hw_datesupp'=> 'date_format:"Y-m-d"',
                  'hw_datefac'=> 'date_format:"Y-m-d"'
      ];

      $validation = Validator::make($request->all(),$rulesArr,$messages);

      if($validation->fails()){
          return redirect()->back()->withErrors($validation)->withInput($request->all());
      }

      $assetid = $request->input('hw_assetid');
      $serialno = $request->input('hw_serialno');
      $model = $request->input('hw_model');
      $partno = $request->input('hw_part_no');
      $pono = $request->input('hw_po_no');

      if($request->input('hw_price') == ''){
        $price= '0.00';
      }
      else{$price = $request->input('hw_price');}

      if($request->input('hw_date_po') == ''){
        $datepono = '0001-00-00';
      }
      else{$datepono = $request->input('hw_date_po');}

      if($request->input('hw_datesupp') == ''){
        $datesup = '0001-00-00';
      }
      else{$datesup = $request->input('hw_datesupp');}

      if($request->input('hw_datefac') == ''){
        $datefac = '0001-00-00';
      }
      else{$datefac = $request->input('hw_datefac');}


      $supid = $request->input('hw_supplier');
      $typeIndexNo = $request->input('hw_type');

      $hardware = Hardware::find($id);
      $hardware->hw_assetid = $assetid;
      $hardware->hw_serialno = $serialno;
      $hardware->hw_model = $model;
      $hardware->hw_part_no = $partno;
      $hardware->hw_po_no = $pono;
      $hardware->hw_price = $price;
      $hardware->hw_date_po = $datepono;
      $hardware->hw_datesupp = $datesup;
      $hardware->hw_datefac = $datefac;
      $hardware->hw_supplier = $supid;
      $hardware->hw_type = $typeIndexNo;
      $hardware->save();

      return redirect()->action('HardwareController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $recToDelete = Hardware::find($id);
      $recToDelete->delete();

      return redirect()->action('HardwareController@index');
    }

}
