<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Software;
use App\SwRecord;

use Session;

class SwRecordController extends Controller
{

    public function index(){
        //
    }

    public function installform($id){
       $data['software'] = Software::find($id);
       return view('swrecord.installform',$data)->with('datenow', Carbon::now()->format('d/m/Y'));
    }

    public function uninstallform($id){
      $data['software'] = Software::find($id);
      return view('swrecord.uninstallform',$data)->with('datenow', Carbon::now()->format('d/m/Y'));
    }

    public function modalinstall(Request $request){
      $swToInstall = $request->input('swname');
      $id = $request->input('id'); //untuk return nanti
      $hwid = $request->input('hwid');
      $userid = $request->input('current_userid');
      $remark = $request->input('remark');
      $getFirstSwAvailble = DB::table('software')
                            ->where('sw_model', $swToInstall)
                            ->where('sw_status', 0)
                            ->first();
      if($getFirstSwAvailble == null){
        return redirect()->back()->with('ada_error', $swToInstall);
      }
      else{
       $assetid = $getFirstSwAvailble->sw_assetid;
       $huhu = new SwRecord;
       $huhu->sw_assetid = $assetid;
       $huhu->hw_assetid = $hwid;
       $huhu->current_userid = $userid;
       $huhu->remark = $remark;
       $huhu->status = 1;

       DB::table('software')->where('sw_assetid', $assetid)->update(['sw_status' => 1, 'installed_in'=> $hwid, 'updated_at' => Carbon::now()]);
       flash()->success('Success!', $getFirstSwAvailble->sw_model.' has been installed to the device.');
       sleep(0.1);
       $huhu->save();
       return redirect()->to(action('RecordController@show', $id).'#swlist');
     }
    }

    public function uninstall(Request $request){
      $id = $request->input('sw_assetid');

      $returndate = DB::table('swrecord')->where('sw_assetid', $id)->orderBy('created_at', 'desc')->value('id'); //get date retu

      DB::table('software')->where('sw_assetid', $id)->update(['sw_status' => 0, 'installed_in'=> 'standby', 'updated_at' => Carbon::now()]);
      DB::table('swrecord')->where('id', $returndate)->update(['updated_at' => Carbon::now()]);

      $addrec = new SwRecord;
      $addrec->sw_assetid = $id;
      $addrec->current_userid = 'WMIT';
      $addrec->remark = $request->input('remark');
      $addrec->status = 0;
      $addrec->save();

      flash()->success('Success!', 'Software have been released from the device.');
      return redirect()->action('SoftwareController@index');
    }

    public function uninstalllist($id){
      $returndate = DB::table('swrecord')->where('sw_assetid', $id)->orderBy('created_at', 'desc')->value('id');
      $swname = DB::table('software')->where('sw_assetid', $id)->value('sw_model');
      DB::table('software')->where('sw_assetid', $id)->update(['sw_status' => 0, 'installed_in'=> 'standby', 'updated_at' => Carbon::now()]);
      DB::table('swrecord')->where('id', $returndate)->update(['updated_at' => Carbon::now()]);
      flash()->success('Success!', $swname.' key have been released from the device.');
      return back();
    }

    public function create(){
      //
    }

    public function store(Request $request){
      $assetid = $request->input('sw_assetid');
      $hwid = $request->input('hw_assetid');
      $userid = $request->input('current_userid');
      $remark = $request->input('remark');
      $status = $request->input('status');

      $record = new SwRecord;
      $record->sw_assetid = $assetid;
      $record->hw_assetid = $hwid;
      $record->current_userid = $userid;
      $record->remark = $remark;
      $record->status = 1;

      DB::table('software')->where('sw_assetid', $assetid)->update(['sw_status' => 1, 'installed_in'=> $hwid, 'updated_at' => Carbon::now()]);
      flash()->success('Success!', 'Software has been bounded to the device.');
      sleep(0.1);
      $record->save();

      //return redirect()->action('SwRecordController@show', $assetid);
      return redirect()->action('SoftwareController@index');
    }

    public function show($id){
      $data['software'] = Software::find($id);
      return view('swrecord.view',$data);
    }

    public function edit($id){
        //
    }

    public function update(Request $request, $id){
        //
    }

    public function destroy($id){
        //
    }
}
