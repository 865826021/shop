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
		$datas = Product::where('status','=',0)->limit(8)->get()->toArray();
		//dd($datas);
		if($datas){
			return ['datas' => $datas];
		}
    }
	
	public function categoryIndex(Request $request)
    {
		$datas = Category::where('status','=',0)->limit(8)->get()->toArray();
		//dd($datas);
		if($datas){
			return ['datas' => $datas];
		}
    }
	
	public function getProductByCid(Request $request)
    {
		$cid = $request->input("cid");
		if(isset($cid)){
			$datas = Product::where('status','=',0)->where('cid','=',$cid)->limit(8)->get()->toArray();
		    //dd($datas);
		    if($datas){
			    return ['datas' => $datas];
		    }
		}else{
			return ['datas' => null ];
		}
    }
	
	public function newGetProductByCid(Request $request)
    {
		$cid = $request->input("cid");
		$page = $request->input("page");
		$limit = $request->input("limit");
		return ['cid' => $cid,'page' => $page,'limit' => $limit ];
		if(isset($cid) && isset($page) && isset($limit)){
			$datas = Product::where('status','=',0)->where('cid','=',$cid)->skip($page*$limit)->take($limit)->get()->toArray();
		    $total = Product::where('status','=',0)->where('cid','=',$cid)->get()->toArray();
		    //dd($datas);
		    if($datas){
			    return ['datas' => $datas,'total' =>count($total) ];
		    }
		}else{
			return ['datas' => null ];
		}
    }

    
}
