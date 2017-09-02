<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Tools\CustomPage;

use App\Home\Category;

use Input;

class CategoryController extends Controller
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
        $ArticleList = Category::getArticleList($skip,$number);
        $count = Category::getCount();
        $totalPage=ceil($count/$number);
        $baseUrl=url('/category/index');
        $pageView=$this->CustomPage->getSelfPageView($nowPage,$totalPage,$baseUrl,[]);
        return view('admin.category.index')->with('pageView',$pageView)->with('ArticleList',$ArticleList);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'name'=>'required|unique:category',
            'img'=>'required'
        ],
            [
                'name.required'=>'分类标题必须填写!',
                'name.unique'=>'标题已存在!',
                'img.required'=>'请上传类别图片!'
            ]
        );
        //dd($input);
        $file = Input::file('img');
        //取得上传文件的大小：
        $sizes = $file->getSize();
        //dd(($sizes/1024)."kb");
        $size = $sizes/1024;
        if($size > 2048){
            return view("404")->with('info','上传的图片超过2M')->with('url','/category/create');
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
        $data['name'] = $input['name'];
        $data['img'] = $filepath;
        $data['pid'] = 0;
        $data['status'] = 0;
        $data['add_time'] = time();
        $re = Category::insert($data);
        if($re){
            return redirect('/category/index');
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
    public function edit($cid)
    {
        //echo $art_id;
        $article = Category::getArticle($cid);
        return view('admin.category.update')->with('article',$article);
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
        $cid = $request['cid'];
        $data['name'] = $request['name'];
        $data['add_time'] = time();
        if($request['img']){
            $file = Input::file('img');
            //取得上传文件的大小：
            $sizes = $file->getSize();
            //dd(($sizes/1024)."kb");
            $size = $sizes/1024;
            if($size > 2048){
                return view("404")->with('info','上传的图片超过2M')->with('url','/category/index');
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
            $data['img'] = $filepath;
            $res = Category::updateArticle($cid , $data);
            if ($res) {
                return redirect('/category/index');
            } else {
                $article = Category::getArticle($cid);
                return view('admin.category.update')->with('article',$article);
            }
        }
        else{
            $res = Category::updateArticle($cid , $data);
            if ($res) {
                return redirect('/category/index');
            } else {
                $article = Category::getArticle($cid);
                return view('admin.category.update')->with('article',$article);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cid)
    {
        //echo $art_id;
        $res = $res = Category::deleteArticle($cid);
        if ($res) {
            return redirect('/category/index');
        } else {
            return back()->with('errors','数据删除失败，请稍后重试！');
        }
    }
}
