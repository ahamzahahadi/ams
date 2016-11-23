<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Software;

class SoftwareController extends Controller
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
        $swList = Software::all();
        return view('software.list', ['swList' => $swList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('software.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        $datepono = '0001-00-00';
      }
      else{$datepono = $request->input('sw_date_po');}

      if($request->input('sw_datesupp') == ''){
        $datesup = '0001-00-00';
      }
      else{$datesup = $request->input('sw_datesupp');}

      if($request->input('sw_datefac') == ''){
        $datefac = '0001-00-00';
      }
      else{$datefac = $request->input('sw_datefac');}


      $supid = $request->input('sw_supplier');
      $typeIndexNo = $request->input('sw_type');

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
      $software->save();

      return redirect()->action('SoftwareController@index');
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
      $data['software'] = Software::find($id);
      return view('software.edit',$data);
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
        $datepono = '0001-00-00';
      }
      else{$datepono = $request->input('sw_date_po');}

      if($request->input('sw_datesupp') == ''){
        $datesup = '0001-00-00';
      }
      else{$datesup = $request->input('sw_datesupp');}

      if($request->input('sw_datefac') == ''){
        $datefac = '0001-00-00';
      }
      else{$datefac = $request->input('sw_datefac');}


      $supid = $request->input('sw_supplier');
      $typeIndexNo = $request->input('sw_type');

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
      $software->save();

      return redirect()->action('SoftwareController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $recToDelete = Software::find($id);
      $recToDelete->delete();

      return redirect()->action('SoftwareController@index');
    }
}
