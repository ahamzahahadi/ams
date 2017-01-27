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
      $prodkey = $request->input('sw_prodkey');
      $swToInstall = $request->input('swname');
      $id = $request->input('id'); //untuk return nanti (id hardware)
      $remark = $request->input('remark');
      $dateinstall = $request->input('updated_at');

      if($prodkey == ''){ //kalau x cari guna prodkey
            $getFirstSwAvailble = DB::table('software')->where('sw_model', $swToInstall)->where('sw_status', 0)->first();
            if($getFirstSwAvailble == null){
              return redirect()->back()->with('ada_error', $swToInstall);
            }else{
             $assetid = $getFirstSwAvailble->id;
             $swname = $getFirstSwAvailble->sw_model;
            }
     }else{ //kalau ada prodkey input
       //if salah format return "pls select from suggested"
       if(substr($prodkey,-1) != ">"){
         return redirect()->back()->with('ada_error', 2); // error = 2, input x select suggestion
       }
       $prodkey = strchr($prodkey, '<');
       $prodkey = substr($prodkey, 2);
       $prodkey = str_ireplace(' >','',$prodkey);
       if($prodkey == ''){
         return redirect()->back()->with('ada_error', 3); // error = 3, xde prodkey
       }

       $findSwUsingProdkey = DB::table('software')->where('sw_prodkey', $prodkey)->where('sw_status', 0)->first();
       $assetid = $findSwUsingProdkey->id;
       $swname = $findSwUsingProdkey->sw_model;

     }
       $huhu = new SwRecord;
       $huhu->sw_assetid = $assetid;
       $huhu->hw_assetid = $id;
       $huhu->remark = $remark;
       $huhu->status = 1;
       $huhu->save();

       DB::table('software')->where('id', $assetid)->update(['sw_status' => 1, 'installed_in'=> $id, 'updated_at' => $dateinstall]); //Carbon::now()
       flash()->success('Success!', $swname.' has been installed to the device.');
       sleep(0.1);

       return redirect()->to(action('RecordController@show', $id).'#swlist');
  }

    public function uninstall(Request $request){
      $id = $request->input('swid');

      $returndate = DB::table('swrecord')->where('sw_assetid', $id)->orderBy('created_at', 'desc')->value('id'); //get date retu

      DB::table('software')->where('id', $id)->update(['sw_status' => 0, 'installed_in'=> 'standby', 'updated_at' => Carbon::now()]);
      DB::table('swrecord')->where('id', $returndate)->update(['updated_at' => Carbon::now()]);

      $addrec = new SwRecord;
      $addrec->sw_assetid = $id;
      $addrec->remark = $request->input('remark');
      $addrec->status = 0;
      $addrec->save();

      flash()->success('Success!', 'Software have been released from the device.');
      return redirect()->action('SwRecordController@show', $id);
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
      $hwsn = $request->input('hw_serialno');

      if($hwsn == '' || substr($hwsn,-1) != ">"){
        return redirect()->back()->with('ada_error', 2);
      }else{
        $assetid = $request->input('swid');
        $hwsn = strchr($hwsn, ':' );
        $hwsn = substr($hwsn, 2 );
        $hwsn = str_ireplace('>','',$hwsn);
        $converttoid = DB::table('hardware')->where('hw_serialno', $hwsn)->value('id');

        $remark = $request->input('remark');
        $dateinstall = $request->input('updated_at');

        $record = new SwRecord;
        $record->sw_assetid = $assetid;
        $record->hw_assetid = $converttoid;
        $record->remark = $remark;
        $record->status = 1;

        DB::table('software')->where('id', $assetid)->update(['sw_status' => 1, 'installed_in'=> $converttoid, 'updated_at' => $dateinstall]);
        flash()->success('Success!', 'Software has been bounded to the device.');
        sleep(0.1);
        $record->save();

        return redirect()->action('SwRecordController@show', $assetid);
      }
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
