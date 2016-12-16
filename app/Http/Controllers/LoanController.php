<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loan;

class LoanController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function store(Request $request){
    $loan = new Loan;
    $loan->item = $request->input('item');
    $loan->borrower = $request->input('borrower');
    $loan->save();
    return redirect()->back();
  }

  public function padam($id)
  {
    // Session::flash('deletor', 'deleteMe');
     $recToDelete = Loan::find($id);
     $recToDelete->delete();
     return redirect()->back();
  }
}
