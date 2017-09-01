<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tools\CustomPage;
use App\Home\Links;

class LinksController extends Controller
{
    public $number =  PAGESIZE;    //每页显示条数

    public function __construct()
    {
        $this->CustomPage = new CustomPage();
    }

    /*
     * 友情链接分页列表
     */
    public function index(Request $request)
    {
        $nowPage = $request->input('nowPage')?$request->input('nowPage'):1;
        $number = $this->number;
        $skip = ($nowPage-1)*$number;
        $LinksList = Links::getLinksList($skip,$number);
        $count = Links::getCount();
        $totalPage=ceil($count/$number);
        $baseUrl=url('/links/index');
        $pageView=$this->CustomPage->getSelfPageView($nowPage,$totalPage,$baseUrl,[]);
        return view('admin.links.index')->with('pageView',$pageView)->with('LinksList',$LinksList);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.links.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //echo "store";die();
        $input = \Input::except('_token');
        //dd($input);
        $this->validate($request , [
            'link_name'=>'required|unique:links',
            'link_url'=>'required',
            'link_order'=>'required|numeric|min:1'
        ],
            [
                'link_name.required'=>'链接名必须填写!',
                'link_name.unique'=>'链接名已存在!',
                'link_url.required'=>'链接url必须填写!',
                'link_order.required'=>'排序必须填写!',
                'link_order.numeric'=>'排序必须是数字!',
                'link_order.min'=>'排序最小一位!'
            ]
        );
        $data['link_name'] = $input['link_name'];
        $data['link_title'] = $input['link_title'];
        $data['link_url'] = $input['link_url'];
        $data['link_order'] = $input['link_order'];
        $data['add_time'] = time();
        $re = Links::insertLink($data);
        if($re){
            return redirect('/links/index');
        }else{
            //return back()->with('errors','数据填充失败，请稍后重试！');
            return view("404")->with('info','链接添加失败...')->with('url','/links/create');
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
    public function edit($link_id)
    {
        //echo "edit";die();
        $data = Links::getLink($link_id);
        //dd($data);
        return view('admin.links.update')->with('data',$data);
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
        //echo "update";die();
        //dd($link_id);
        $input = \Input::except('_token');
        $link_id = $input['link_id'];
        $data['link_name'] = $input['link_name'];
        $data['link_title'] = $input['link_title'];
        $data['link_url'] = $input['link_url'];
        $data['link_order'] = $input['link_order'];
        $res = Links::updateLink($link_id , $data);
        if ($res) {
            return redirect('/links/index');
        } else {
            $data = Links::getLink($link_id);
            //dd($data);
            return view('admin.links.update')->with('data',$data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($link_id)
    {
        //echo "destory";die();
        //dd($cate_id);
        $res = Links::deleteLink($link_id);
        if ($res) {
            return redirect('/links/index');
        } else {
            return view("404")->with('info','链接删除失败...')->with('url','/links');
        }
    }
}
