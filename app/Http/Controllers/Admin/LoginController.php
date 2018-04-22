<?php

namespace App\Http\Controllers\Admin;
use App\Http\Model\Super;
use App\Http\Model\User;
use Illuminate\Http\Request;
use Code;
use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;


class LoginController extends CommonController
{
    public function login()
    {
        if($input = Input::all()){
            $code = new Code();
            $_code = $code->get();
            if(strtoupper($input['code'])!=$_code){
                return back()->with('msg','验证码错误！')->withInput();
            }
            $user = Super::first();
            if($user->super_name != $input['user_name'] || Crypt::decrypt($user->password)!= $input['user_pass']){
                return back()->with('msg','用户名或者密码错误！')->withInput();
            }
            session(['user'=>$user]);
//            dd(session('user'));
            return redirect('admin/index');

        }else {
            return view('admin.ac_login.login');
        }
    }

    public function quit()
    {
        session(['user'=>null]);
        return redirect('admin/login');
    }

    public function code()
    {
        $code = new Code();
        $code->make();
    }

}
