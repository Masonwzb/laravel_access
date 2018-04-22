<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Com_admin;
use App\Http\Model\Floor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FloorController extends CommonController
{
    //get.admin/floor  全部大楼列表
    public function index()
    {
        $floor= Floor::orderBy('floor_id','desc')->get();

        $data = Com_admin::all();

        return view('admin.floor.index')->with(['data' => $floor,'fields' => $data]);
    }

    //get.admin/floor/create 添加大楼
    public function create()
    {
        $data = Com_admin::all();

        return view('admin.floor.add')->with('datas',$data);
    }

    //post.admin/floor 添加大楼提交
    public function store(Request $request)
    {
        $input = $request->except('_token');
//        dd($input);

        //表单数据填写规则
        $rules =[
            'floor_name' => 'required',
            'admin_id' => 'required',
        ];

        //错误消息说明
        $message = [
            'floor_name.required' => '大楼名称不能为空！',
            'admin_id.required' => '请选择大楼管理员！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes())
        {
            $f = Floor::create($input);

            if($f)
            {
                return redirect('admin/floor')->with('errors','添加成功！');
            }else{
                return redirect()->back()->with('errors','数据填充失败，请稍候重试！');
            }
        }else{
            return redirect()->back()->withErrors($validator)->withInput();
        }

    }

    //get.admin/floor/{floor}/edit 编辑大楼
    public function edit($floor_id)
    {
        $data = Com_admin::all();

        $field = Floor::find($floor_id);

        return view('admin.floor.edit')->with(['datas' => $data,'fields' => $field]);
    }

    //put.admin/floor/{floor} 更新大楼
    public function update(Request $request,$floor_id)
    {
        $input = $request->except('_token','_method');

        //表单数据填写规则
        $rules =[
            'floor_name' => 'required',
            'admin_id' => 'required',
        ];

        //错误消息说明
        $message = [
            'floor_name.required' => '大楼名称不能为空！',
            'admin_id.required' => '请选择大楼管理员！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes())
        {
            $f = Floor::where('floor_id',$floor_id)->update($input);

            if($f)
            {
                return redirect('admin/floor')->with('errors','编辑成功！');
            }else{
                return redirect()->back()->with('errors','数据填充失败，请稍候重试！');
            }
        }else{
            return redirect()->back()->withErrors($validator)->withInput();
        }

    }

    //delete.admin/floor/{floor} 删除单个floor
    public function destroy($floor_id)
    {
        $f = Floor::where('floor_id',$floor_id)->delete();
//        dd($cad);

        if($f)
        {
            $data = [
                'status' => 1,
                'msg' => '大楼删除成功！',
            ];

        }else{

            $data = [
                'status' => 0,
                'msg' => '大楼删除失败，请稍后重试！',
            ];

        }

        return $data;
    }



}
