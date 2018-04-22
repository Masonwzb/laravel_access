<?php
namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Model\ac_user;
use Illuminate\Http\Request;

class ac_userController extends Controller
{
    public function index()
    {

        $ac_users = ac_user::paginate(15);


        return view('admin.ac_user.index',['ac_users'=>$ac_users]);
    }
    public function save(Request $request){
       $data =$request->input('ac_user');
       $ac_user =new ac_user();
       $ac_user->tel=$data['tel'];
       $ac_user->permission=$data['permission'];
        $ac_user->password=$data['password'];

       if($ac_user->save()){
            return redirect('ac_user/index');
       }
       else{
           return redirect()->back();

       }
}

    public function detail($id)
    {
        $ac_user =ac_user::find($id);
        return view('admin.ac_user.detail',['ac_user' => $ac_user]);

    }













}
