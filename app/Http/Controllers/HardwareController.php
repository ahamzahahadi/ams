<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Hardware;

class HardwareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        $assetid = $request->input('hw_assetid');
        $serialno = $request->input('hw_serialno');
        $model = $request->input('hw_model');
        $pono = $request->input('hw_po_no');
        $datepono = $request->input('hw_date_po');
        $supid = $request->input('hw_supplier');

        $hardware = new Hardware;
        $hardware->hw_assetid = $assetid;
        $hardware->hw_serialno = $serialno;
        $hardware->hw_model = $model;
        $hardware->hw_po_no = $pono;
        $hardware->hw_date_po = $datepono;
        $hardware->hw_supplier = $supid;
/*nnt add btul2 yg berikut,bg diorang bleh null */
        $hardware->hw_part_no = "lahabau";
        $hardware->hw_price = 99.20;
        $hardware->hw_type = "mengarut";
        $hardware->hw_datesupp = '2013-12-13';
        $hardware->hw_datefac = '2014-11-18';
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
