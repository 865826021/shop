<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Home\Article;

class AppIndexController extends Controller
{

    public function __construct()
    {
		 $this->middleware("cors");
    }

    public function appIndex(Request $request)
    {
		$datas = Article::limit(10)->get()->toArray();
		//dd($datas);
        return ['datas' => $datas];
    }

    
}
