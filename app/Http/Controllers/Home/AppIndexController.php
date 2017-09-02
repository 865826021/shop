<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Home\Product;
use App\Home\Category;

class AppIndexController extends Controller
{

    public function __construct()
    {
		 $this->middleware("cors");
    }

    public function appIndex(Request $request)
    {
		$datas = Product::where('status','=',0)->limit(10)->get()->toArray();
		//dd($datas);
        return ['datas' => $datas];
    }
	
	public function categoryIndex(Request $request)
    {
		$datas = Category::where('status','=',0)->limit(8)->get()->toArray();
		//dd($datas);
        return ['datas' => $datas];
    }

    
}
