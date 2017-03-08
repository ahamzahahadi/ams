<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class AdminController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function grantadmin(Request $request)
  {
    DB::table('users')->where('id', $request->id)->update(['AdminRole' => 1]);
    flash()->success('Success!', 'Grant successful.');
    return view('home');
  }

  public function destroy($id)
  {
    // Session::flash('deletor', 'deleteMe');
     $recToDelete = User::find($id);
     $recToDelete->delete();
     return redirect()->back();
  }

  public function edit($id){
    $data['users'] = User::find($id);
    return view('admin.edit',$data);
  }

  public function update(Request $request, $id)
  {
    $user = User::find($id);
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->save();

    flash()->success('Success!', 'Staff record has been updated :D');
    return view('admin.manage');
  }

}
