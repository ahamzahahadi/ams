<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Record;
use App\Hardware;

class RecordController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function recform($id){
      $data['hardware'] = Hardware::find($id);
      return view('record.form',$data)->with('datenow', Carbon::now()->format('d/m/Y'));
    }

    public function returnasset($id){
      $data['hardware'] = Hardware::find($id);
      return view('record.returnform',$data)->with('datenow', Carbon::now()->format('d/m/Y'));
    }

    public function returnedit(Request $request){
      $id = $request->input('fk_assetid');
      $location = $request->input('location');
      DB::table('hardware')->where('hw_assetid', $id)->update(['hw_status' => 0, 'hw_location'=> $location]);

      $addrec = new Record;
      $addrec->fk_assetid = $id;
      $addrec->current_userid = 'WMIT';
      $addrec->remark = $request->input('remark');
      $addrec->status = '0';
      $addrec->save();

      flash()->success('Success!', 'Asset return have been recorded.');
      return redirect()->action('HardwareController@index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $assetid = $request->input('fk_assetid');
        $userid = $request->input('current_userid');
        $remark = $request->input('remark');
        $status = $request->input('status');

        $record = new Record;
        $record->fk_assetid = $assetid;
        $record->current_userid = $userid;
        $record->remark = $remark;
        $record->status = $status;

        DB::table('hardware')->where('hw_assetid', $assetid)->update(['hw_status' => 1]);
        flash()->success('Success!', 'Asset requisition has been recorded.');
        sleep(0.1);
        $record->save();
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
      $data['hardware'] = Hardware::find($id);
      return view('record.rec',$data);
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
