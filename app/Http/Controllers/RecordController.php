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
    //list of forms
    public function recform($id){
      $data['hardware'] = Hardware::find($id);
      return view('record.form',$data)->with('datenow', Carbon::now()->format('d/m/Y'));
    }

    public function returnasset($id){
      $data['hardware'] = Hardware::find($id);
      return view('record.returnform',$data)->with('datenow', Carbon::now()->format('d/m/Y'));
    }

    public function berform($id){
      $data['hardware'] = Hardware::find($id);
      return view('record.berform',$data)->with('datenow', Carbon::now()->format('d/m/Y'));
    }

    public function faultyform($id){
      $data['hardware'] = Hardware::find($id);
      return view('record.faultyform',$data)->with('datenow', Carbon::now()->format('d/m/Y'));
    }

    public function stolenform($id){
      $data['hardware'] = Hardware::find($id);
      return view('record.stolenform',$data)->with('datenow', Carbon::now()->format('d/m/Y'));
    }

    public function mafform($id){
      $data['hardware'] = Hardware::find($id);
      return view('record.mafform',$data)->with('datenow', Carbon::now()->format('d/m/Y'));
    }

    public function missingform($id){
      $data['hardware'] = Hardware::find($id);
      return view('record.missingform',$data)->with('datenow', Carbon::now()->format('d/m/Y'));
    }
    public function repairform($id){
      $data['hardware'] = Hardware::find($id);
      return view('record.repairform',$data)->with('datenow', Carbon::now()->format('d/m/Y'));
    }

    //backend functions
    public function changestatus(Request $request){
      $chgstat = $request->input('status'); // 2-Faulty, 3-BER , 4-Stolen, 5-Missing, 6-MAF
      if($chgstat == 3){ //if BER
        $hwrecstat = 4;
      }elseif($chgstat == 2){ //if Faulty
        $hwrecstat = 3;
      }elseif($chgstat == 4){ //if Stolen
        $hwrecstat = 5;
      }elseif($chgstat == 5){ //if Missing
        $hwrecstat = 7;
      }elseif($chgstat == 6){ //if MAF
        $hwrecstat = 6;
      }elseif($chgstat == 0){ //if chg to Available
        $hwrecstat = 0;
      }
      $id = $request->input('hwid');
      $location = $request->input('location');

      $recid = DB::table('hwrecord')->select('id')->where('fk_assetid', $id)->orderBy('updated_at','desc')->first(); //dapatkan id record
      DB::table('hardware')->where('id', $id)->update(['hw_status' => $chgstat, 'hw_location'=> $location]);
      DB::table('hwrecord')->where('id', $recid->id)->update(['updated_at' => Carbon::now(), 'status' => 2]);

      $addrec = new Record;
      $addrec->fk_assetid = $id;
      if($chgstat == 6){
        $addrec->current_userid = 'MAF';
      }
      else{
      $addrec->current_userid = 'WMIT';
      }
      $addrec->remark = $request->input('remark');
      $addrec->status = $hwrecstat;
      $addrec->save();

      if($chgstat == 3){
        flash()->success('Success', 'Asset has been declared BER');
      }else{
      flash()->success('Success!', 'Asset status change have been recorded.');
      }
      return redirect()->action('RecordController@show', $id);
    }

    public function returnedit(Request $request){
      $id = $request->input('hwid');
      $location = $request->input('location');

      $recid = DB::table('hwrecord')->where('fk_assetid', $id)->where('status', 1)->value('id'); //dapatkan id record

      DB::table('hardware')->where('id', $id)->update(['hw_status' => 0, 'hw_location'=> $location]);
      DB::table('hwrecord')->where('id', $recid)->update(['updated_at' => Carbon::now(), 'status' => 2]);

      $addrec = new Record;
      $addrec->fk_assetid = $id;
      $addrec->current_userid = 'WMIT';
      $addrec->remark = $request->input('remark');
      $addrec->status = '0';
      $addrec->save();

      flash()->success('Success!', 'Asset return have been recorded.');
      return redirect()->action('RecordController@show', $id);
    }

    public function modalassign(Request $request){
      $hwToGive = $request->input('hwname');
      $id = $request->input('id'); //untuk return nanti
      $userid = $request->input('current_userid');
      $remark = $request->input('remark');
      $getFirstHwAvailble = DB::table('hardware')
      ->where('hw_model', $hwToGive)
      ->where('hw_status', 0)
      ->first();
      if($getFirstHwAvailble == null){
        return redirect()->back()->with('ada_error', $hwToGive);
      }
      else{
        $assetid = $getFirstHwAvailble->id;
        $huhu = new Record;
        $huhu->fk_assetid = $assetid;
        $huhu->current_userid = $userid;
        $huhu->remark = $remark;
        $huhu->status = 1;

        DB::table('hardware')->where('id', $assetid)->update(['hw_status' => 1]);
        //sleep(0.1);
        $huhu->save();
        flash()->success('Success!', 'Asset requisition has been recorded.');
        return redirect()->to(action('StaffController@show', $id).'#hwlist');
      }
    }

    public function store(Request $request){
        $id = $request->input('id');
        $userid = $request->input('current_userid');
        //trimming the input to get only staff ID
        $userid = strchr($userid, ':' );
        $userid = substr($userid, 2 );
        $userid = str_ireplace('>','',$userid);

        $remark = $request->input('remark');
        $created_at = $request->input('date_handed');

        $record = new Record;
        $record->fk_assetid = $id;
        $record->current_userid = $userid;
        $record->remark = $remark;
        $record->status = 1;
        $record->created_at = $created_at;

        DB::table('hardware')->where('id', $id)->update(['hw_status' => 1]);
        flash()->success('Success!', 'Asset requisition has been recorded.');
        $record->save();
        return redirect()->action('RecordController@show', $id);
    }

    public function show($id)
    {
      $data['hardware'] = Hardware::find($id);
      return view('record.rec',$data);
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
