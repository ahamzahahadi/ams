<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\Http\Requests;

class SupplierController extends Controller
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
        $supplierList = Supplier::all();
        return view('supplier.list', ['supplierList' => $supplierList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $suname = $request->input('supp_name');
        $suaddress = $request->input('supp_address');
        $sucontact = $request->input('supp_contact');

        $supp = new Supplier;
        $supp->supp_name = $suname;
        $supp->supp_address = $suaddress;
        $supp->supp_contact = $sucontact;
        $supp->save();

        return redirect()->back();
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
      $data['supplier'] = Supplier::find($id);
      return view('supplier.edit',$data);
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
      $suname = $request->input('supp_name');
      $suaddress = $request->input('supp_address');
      $sucontact = $request->input('supp_contact');

      $supp = Supplier::find($id);
      $supp->supp_name = $suname;
      $supp->supp_address = $suaddress;
      $supp->supp_contact = $sucontact;
      $supp->save();

      return redirect()->action('SupplierController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $recToDelete = Supplier::find($id);
      $recToDelete->delete();

      return redirect()->action('SupplierController@index');
    }
}
