<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function category(){
        $category = Category::all();
        return view ('category',['categories'=>$category]);
    }
}
