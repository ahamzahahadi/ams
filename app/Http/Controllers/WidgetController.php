<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\StaffTemp;

class WidgetController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  // public function store(Request $request){
  //   $loan = new Loan;
  //   $loan->item = $request->input('item');
  //   $loan->borrower = $request->input('borrower');
  //   $loan->save();
  //   return redirect()->to('/#loan');
  // }

  public function padamstafftmp($id)
  {
    // Session::flash('deletor', 'deleteMe');
     $recToDelete = StaffTemp::find($id);
     $recToDelete->delete();
     return redirect()->to('/#stafftmp');
  }
}
