<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loan;

class LoanController extends Controller
{
  public function store(Request $request){
    $loan = new Loan;
    $loan->item = $request->input('item');
    $loan->borrower = $request->input('borrower');
    $loan->save();
    return redirect()->back();
  }
}
