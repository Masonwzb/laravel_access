<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Floor;
use App\Http\Model\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RoomController extends CommonController
{
    //get.admin/room  全部节点列表
    public function index()
    {
        $room= Room::orderBy('room_id','desc')->get();

        $data = Floor::all();

        return view('admin.room.index')->with(['data' => $room,'fields' => $data]);
    }

    //get.admin/room/create 添加节点
    public function create()
    {
        $data = Floor::all();

        return view('admin.room.add')->with('datas',$data);
    }

    //post.admin/room 添加节点提交
    public function store(Request $request)
    {
        $input = $request->except('_token');
//        dd($input);

        //表单数据填写规则
        $rules =[
            'room_name' => 'required|between:1,3',
            'floor_id' => 'required',
        ];

        //错误消息说明
        $message = [
            'room_name.required' => '节点名称不能为空！',
            'room_name.between' => '节点名称必须在1-3位之间！',
            'floor_id.required' => '请选择大楼！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes())
        {
            $f = Room::create($input);

            if($f)
            {
                return redirect('admin/room')->with('errors','添加成功！');
            }else{
                return redirect()->back()->with('errors','数据填充失败，请稍候重试！');
            }
        }else{
            return redirect()->back()->withErrors($validator)->withInput();
        }

    }

    //get.admin/room/{room}/edit 编辑节点
    public function edit($room_id)
    {
        $data = Floor::all();

        $field = Room::find($room_id);

        return view('admin.room.edit')->with(['datas' => $data,'fields' => $field]);
    }

    //put.admin/room/{room} 更新节点
    public function update(Request $request,$room_id)
    {
        $input = $request->except('_token','_method');

        //表单数据填写规则
        $rules =[
            'room_name' => 'required|between:1,3',
            'floor_id' => 'required',
        ];

        //错误消息说明
        $message = [
            'room_name.required' => '节点名称不能为空！',
            'room_name.between' => '节点名称必须在1-3位之间！',
            'floor_id.required' => '请选择大楼！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes())
        {
            $f = Room::where('room_id',$room_id)->update($input);

            if($f)
            {
                return redirect('admin/room')->with('errors','编辑成功！');
            }else{
                return redirect()->back()->with('errors','数据填充失败，请稍候重试！');
            }
        }else{
            return redirect()->back()->withErrors($validator)->withInput();
        }

    }

    //delete.admin/room/{room} 删除单个节点
    public function destroy($room_id)
    {
        $f = Room::where('room_id',$room_id)->delete();
//        dd($cad);

        if($f)
        {
            $data = [
                'status' => 1,
                'msg' => '节点删除成功！',
            ];

        }else{

            $data = [
                'status' => 0,
                'msg' => '节点删除失败，请稍后重试！',
            ];

        }

        return $data;
    }
}
