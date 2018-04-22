<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Com_admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class Com_adminController extends CommonController
{
    //get.admin/com_admin  全部com_admin列表
    public function index()
    {
        $com_admin= Com_admin::orderBy('admin_id','desc')->get();

        //密码解密
//        foreach($com_admin as $v)
//        {
//                $v->password = Crypt::decrypt($v->password);
//        }
//        dd($com_admin);
        return view('admin.com_admin.index')->with('data',$com_admin);
    }

    //get.admin/com_admin/create 添加com_admin
    public function create()
    {
        return view('admin.com_admin.add');
    }

    //post.admin/com_admin 添加com_admin提交
    public function store(Request $request)
    {
        if($request->isMethod('POST'))
        {
          $input = $request->except('_token');
//         dd($input);

            //表单数据填写规则
            $rules =[
                'admin_name' => 'required',
                'password' => 'required|between:6,20|confirmed',
            ];

            //错误消息说明
            $message = [
                'admin_name.required' => '普通管理员名称不能为空！',
                'password.required' => '密码不能为空！',
                'password.between' => '密码必须在6-20位之间！',
                'password.confirmed' =>'密码两次输入不一致！',
            ];

           $validator = Validator::make($input,$rules,$message);

            if($validator->passes())
            {
                $input = $request->except('_token','password_confirmation');
//                dd($input);
                $input['password'] = Crypt::encrypt($request->input('password'));

                $adm = Com_admin::create($input);

                if($adm)
                {
                    return redirect('admin/com_admin')->with('errors','添加成功！');
                }else{
                    return redirect()->back()->with('errors','数据填充失败，请稍候重试！');
                }
            }else{
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
    }

    //get.admin/com_admin/{com_admin}/edit 编辑com_admin
    public function edit($admin_id)
    {
        $field = Com_admin::find($admin_id);

        //密码解密
        $field->password = Crypt::decrypt($field->password);

        return view('admin.com_admin.edit')->with('fields',$field);
    }

    //put.admin/com_admin/{com_admin} 更新com_admin
    public function update(Request $request,$admin_id)
    {
        $input = $request->except('_token','_method');

        //表单数据填写规则
        $rules =[
            'admin_name' => 'required',
            'password' => 'required|between:6,20|confirmed',
        ];

        //错误消息说明
        $message = [
            'admin_name.required' => '普通管理员名称不能为空！',
            'password.required' => '密码不能为空！',
            'password.between' => '密码必须在6-20位之间！',
            'password.confirmed' =>'密码两次输入不一致！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes())
        {
            $input = $request->except('_token','_method','password_confirmation');

            $input['password'] = Crypt::encrypt($request->input('password'));
//            dd($input);

            $cad = Com_admin::where('admin_id',$admin_id)->update($input);

            if($cad)
            {
                return redirect('admin/com_admin')->with('errors','编辑成功！');
            }else{
                return redirect()->back()->with('errors','数据填充失败，请稍候重试！');
            }
        }else{
            return redirect()->back()->withErrors($validator)->withInput();
        }

    }

    //delete.admin/com_admin/{com_admin} 删除单个com_admin
    public function destroy($admin_id)
    {
        $cad = Com_admin::where('admin_id',$admin_id)->delete();
//        dd($cad);

        if($cad)
        {
            $data = [
                'status' => 1,
                'msg' => 'com_admin删除成功！',
            ];

        }else{

            $data = [
                'status' => 0,
                'msg' => 'com_admin删除失败，请稍后重试！',
            ];

        }

        return $data;
    }
    
    
}
