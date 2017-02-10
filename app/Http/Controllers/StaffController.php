<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Staff;
use App\Http\Requests;
use Carbon\Carbon;
use Validator;
use Session;

class StaffController extends Controller
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
       $staffList = Staff::all();
       return view('staff.list', ['staffList' => $staffList]);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staff.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $messages = ['unique' => 'This staff ID already belongs to someone.'];

      $rulesArr = ['staff_id'=>'unique:staff' ];

      $validation = Validator::make($request->all(),$rulesArr,$messages);

      if($validation->fails()){
          return redirect()->back()->withErrors($validation)->withInput($request->all());
      }

      $sid = $request->input('staff_id');
      $sname = $request->input('staff_name');
      $smail = $request->input('staff_mail');
      $smobile = $request->input('staff_mobile');
      $stelno = $request->input('staff_telno');
      $stitle = $request->input('staff_title');
      $sdept = $request->input('staff_dept');
      $scompany = $request->input('staff_company');
      $sol = $request->input('staff_officeLocation');
      $cek = $request->input('check');

        $staff = new Staff;
        $staff->staff_id = $sid;
        $staff->staff_name = $sname;
        $staff->staff_mail = $smail;
        $staff->staff_mobile = $smobile;
        $staff->staff_telno = $stelno;
        $staff->staff_title = $stitle;
        $staff->staff_dept = $sdept;
        $staff->staff_company = $scompany;
        $staff->staff_officeLocation = $sol;
        $staff->save();

        if($cek == 'yes'){
          $sgid = DB::table('staff')->where('staff_id',$sid)->value('id');

          DB::table('stafftemp')->insert([ ['staff_name' => $sname,
            'sgid' => $sgid,
          'created_at' => Carbon::now(),
        'updated_at' => Carbon::now() ]]);
        }

        flash()->success('Success!', 'New staff has been added.');
        return redirect()->action('StaffController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $data['staff'] = Staff::find($id);
      return view('staff.view',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data['staff'] = Staff::find($id);
      return view('staff.edit',$data);
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
      $messages = ['unique' => 'This staff ID already belongs to someone.'];

      $rulesArr = ['staff_id'=>'unique:staff' ];

      $validation = Validator::make($request->all(),$rulesArr,$messages);

      if($validation->fails()){
          return redirect()->back()->withErrors($validation)->withInput($request->all());
      }

      $sid = $request->input('staff_id');
      $sname = $request->input('staff_name');
      $smail = $request->input('staff_mail');
      $smobile = $request->input('staff_mobile');
      $stelno = $request->input('staff_telno');
      $stitle = $request->input('staff_title');
      $sdept = $request->input('staff_dept');
      $scompany = $request->input('staff_company');
      $sol = $request->input('staff_officeLocation');
      $cek = $request->input('check');

      $staff = Staff::find($id);
      $staff->staff_id = $sid;
      $staff->staff_name = $sname;
      $staff->staff_mail = $smail;
      $staff->staff_mobile = $smobile;
      $staff->staff_telno = $stelno;
      $staff->staff_title = $stitle;
      $staff->staff_dept = $sdept;
      $staff->staff_company = $scompany;
      $staff->staff_officeLocation = $sol;
      $staff->save();

      if($cek == 'yes'){
        $sgid = DB::table('staff')->where('staff_id',$sid)->value('id');

        DB::table('stafftemp')->insert([ ['staff_name' => $sname,
          'sgid' => $sgid,
        'created_at' => Carbon::now(),
      'updated_at' => Carbon::now() ]]);
      }

      flash()->success('Success!', 'Staff record has been updated :D');
      return redirect()->action('StaffController@show',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $recToDelete = Staff::find($id);
      $recToDelete->delete();

      return redirect()->action('StaffController@index');
    }
}
