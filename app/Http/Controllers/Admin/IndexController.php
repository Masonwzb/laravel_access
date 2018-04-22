<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Super;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class IndexController extends CommonController
{
    //后台管理模版
    public function index()
    {
        return view('admin.index');
    }
    public function info()
    {
        return view('admin.ac_login.info');
    }
    //更改超级管理员密码
    public function pass(Request $request)
    {
        if ($input = Input::all()) {

            $rules = [
                'password' => 'required|between:6,20|confirmed',
            ];

            $message = [
                'password.required' => '新密码不能为空！',
                'password.between' => '新密码必须在6-20位之间！',
                'password.confirmed' => '新密码和确认密码不一致！',
            ];

            $validator = Validator::make($input, $rules, $message);

            if ($validator->passes()) {
                $user = Super::first();
                $_password = Crypt::decrypt($user->password);
                if ($input['password_o'] == $_password) {
                    $user->password = Crypt::encrypt($input['password']);
                    $user->update();
                    return redirect('admin/index');
                }else {
                    return back()->with('errors', '原密码错误！');
                }
            }else {
                return back()->withErrors($validator)->withInput();
            }

        } else {
            return view('admin.ac_login.pass');
        }
    }
}




