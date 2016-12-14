<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function store(Request $request){
      $cat = new Category;
      $cat->type = $request->input('type');
      $cat->flag = $request->input('flag');
      $cat->save();
      return redirect()->back();
    }
}
