<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Tools\CustomPage;

use App\Home\Article;

use Input;

class ArticleController extends Controller
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
        $ArticleList = Article::getArticleList($skip,$number);
        $count = Article::getCount();
        $totalPage=ceil($count/$number);
        $baseUrl=url('/article');
        $pageView=$this->CustomPage->getSelfPageView($nowPage,$totalPage,$baseUrl,[]);
        return view('admin.article.index')->with('pageView',$pageView)->with('ArticleList',$ArticleList);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.article.create');
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
            'art_title'=>'required|unique:article',
            'art_editor'=>'required',
            'art_tag'=>'required',
            'art_description'=>'required',
            'art_content'=>'required'
        ],
            [
                'art_title.required'=>'文章标题必须填写!',
                'art_title.unique'=>'文章标题已存在!',
                'art_editor.required'=>'文章编辑必须填写!',
                'art_tag.required'=>'文章关键词必须填写!',
                'art_description.required'=>'文章描述必须填写!',
                'art_content.required'=>'文章内容必须填写!'
            ]
        );
        //dd($input);
        $file = Input::file('art_thumb');
        //取得上传文件的大小：
        $sizes = $file->getSize();
        //dd(($sizes/1024)."kb");
        $size = $sizes/1024;
        if($size > 2048){
            return view("404")->with('info','上传的图片超过2M')->with('url','/article/create');
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
        $data['art_title'] = $input['art_title'];
        $data['art_editor'] = $input['art_editor'];
        $data['art_thumb'] = $filepath;
        $data['art_tag'] = $input['art_tag'];
        $data['art_description'] = $input['art_description'];
        $data['art_content'] = $input['art_content'];
        $data['art_time'] = time();
        $re = Article::insert($data);
        if($re){
            return redirect('/article/index');
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
    public function edit($art_id)
    {
        //echo $art_id;
        $article = Article::getArticle($art_id);
        return view('admin.article.update')->with('article',$article);
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
        $art_id = $request['art_id'];
        $data['art_title'] = $request['art_title'];
        $data['art_editor'] = $request['art_editor'];
        $data['art_tag'] = $request['art_tag'];
        $data['art_description'] = $request['art_description'];
        $data['art_content'] = $request['art_content'];
        $data['art_time'] = time();
        if($request['art_thumb']){
            $file = Input::file('art_thumb');
            //取得上传文件的大小：
            $sizes = $file->getSize();
            //dd(($sizes/1024)."kb");
            $size = $sizes/1024;
            if($size > 2048){
                return view("404")->with('info','上传的图片超过2M')->with('url','/article');
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
            $data['art_thumb'] = $filepath;
            $res = Article::updateArticle($art_id , $data);
            if ($res) {
                return redirect('/article');
            } else {
                $article = Article::getArticle($art_id);
                return view('admin.article.update')->with('article',$article);
            }
        }
        else{
            $res = Article::updateArticle($art_id , $data);
            if ($res) {
                return redirect('/article/index');
            } else {
                $article = Article::getArticle($art_id);
                return view('admin.article.update')->with('article',$article);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($art_id)
    {
        //echo $art_id;
        $res = $res = Article::deleteArticle($art_id);
        if ($res) {
            return redirect('/article/index');
        } else {
            return back()->with('errors','数据删除失败，请稍后重试！');
        }
    }
}
