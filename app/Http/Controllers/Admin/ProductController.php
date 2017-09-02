<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Tools\CustomPage;

use App\Home\Product;
use App\Home\Category;
use Input;

class ProductController extends Controller
{
    public $number =  PAGESIZE;    //每页显示条数

    public function __construct()
    {
        $this->CustomPage = new CustomPage();
    }

    public function index(Request $request)
    {
        $nowPage = $request->input('nowPage')?$request->input('nowPage'):1;
        $number = $this->number;
        $skip = ($nowPage-1)*$number;
        $ArticleList = Product::getArticleList($skip,$number);
        $count = Product::getCount();
        $totalPage=ceil($count/$number);
        $baseUrl=url('/product/index');
        $pageView=$this->CustomPage->getSelfPageView($nowPage,$totalPage,$baseUrl,[]);
		$node = Category::where('status' , 0)->get()->toArray();
        return view('admin.product.index')->with('pageView',$pageView)->with('ArticleList',$ArticleList)->with('node',$node);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$node = Category::where('status' , 0)->get()->toArray();
        return view('admin.product.create')->with('node',$node);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = \Input::except('_token');
        $this->validate($request , [
            'title'=>'required|unique:product',
			'price'=>'required',
            'thumb'=>'required',
            'description'=>'required'
        ],
            [
                'title.required'=>'产品标题必须填写!',
                'title.unique'=>'产品标题已存在!',
				'price.required'=>'产品价格必须填写!',
                'thumb.required'=>'产品图片必须上传!',
                'description.required'=>'产品描述必须填写!'
            ]
        );
        //dd($input);
        $file = Input::file('thumb');
        //取得上传文件的大小：
        $sizes = $file->getSize();
        //dd(($sizes/1024)."kb");
        $size = $sizes/1024;
        if($size > 2048){
            return view("404")->with('info','上传的图片超过2M')->with('url','/product/create');
        }
        $allowed_extensions = ["png", "PNG" , "jpg" , "JPG" , "jpeg", "JPEG" , "gif" , "GIF"];
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return ['error' => 'You may only upload png, jpg ,jpeg or gif.'];
        }
        $destinationPath = 'uploads/images/';
        $extension = $file->getClientOriginalExtension();
        //$fileName = str_random(10).'.'.$extension;
        $fileName = str_random(10).time().'.'.$extension;  //拼接图片名
        $file->move($destinationPath, $fileName);  //上传图片
        $filepath = $destinationPath.$fileName;  //图片保存路径
        //echo $filepath;
		$data['cid'] = $input['cid'];
        $data['title'] = $input['title'];
		$data['price'] = $input['price'];
        $data['thumb'] = $filepath;
        $data['view'] = 0;
        $data['description'] = $input['description'];
        $data['add_time'] = time();
		$data['status'] = 0;
        $re = Product::insert($data);
        if($re){
            return redirect('/product/index');
        }else{
            return back()->with('errors','数据填充失败，请稍后重试！');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //echo $art_id;
        $article = Product::getArticle($id);
		$node = Category::where('status' , 0)->get()->toArray();
        return view('admin.product.update')->with('article',$article)->with('node',$node);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //接收验证参数
        //if (empty($art_id)) return false;
        //dd($request);
        $id = $request['id'];
		$data['cid'] = $request['cid'];
        $data['title'] = $request['title'];
		$data['price'] = $request['price'];
        $data['description'] = $request['description'];
        $data['add_time'] = time();
        if($request['thumb']){
            $file = Input::file('thumb');
            //取得上传文件的大小：
            $sizes = $file->getSize();
            //dd(($sizes/1024)."kb");
            $size = $sizes/1024;
            if($size > 2048){
                return view("404")->with('info','上传的图片超过2M')->with('url','/product/index');
            }
            $allowed_extensions = ["png", "PNG" , "jpg" , "JPG" , "jpeg", "JPEG" , "gif" , "GIF"];
            if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
                //return ['error' => 'You may only upload png, jpg ,jpeg or gif.'];
                return view("errors.503")->with('info','只能上传 png, jpg ,jpeg or gif.');
            }
            $destinationPath = 'uploads/images/';
            $extension = $file->getClientOriginalExtension();
            //$fileName = str_random(10).'.'.$extension;
            $fileName = str_random(10).time().'.'.$extension;  //拼接图片名
            $file->move($destinationPath, $fileName);  //上传图片
            $filepath = $destinationPath.$fileName;  //图片保存路径
            //echo $filepath;
            $data['thumb'] = $filepath;
            $res = Product::updateArticle($id , $data);
            if ($res) {
                return redirect('/product/index');
            } else {
                $article = Product::getArticle($id);
                return view('admin.product.update')->with('article',$article);
            }
        }
        else{
            $res = Product::updateArticle($id , $data);
            if ($res) {
                return redirect('/product/index');
            } else {
                $article = Product::getArticle($id);
                return view('admin.product.update')->with('article',$article);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //echo $art_id;
        $res = $res = Product::deleteArticle($id);
        if ($res) {
            return redirect('/product/index');
        } else {
            return back()->with('errors','数据删除失败，请稍后重试！');
        }
    }
}
