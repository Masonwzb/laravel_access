<?php
/**
 * Created by PhpStorm.
 * User: PVer
 * Date: 2018/3/20
 * Time: 20:21
 */
namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Model\ac_record;
use App\Http\Model\ac_user;
use Illuminate\Http\Request;

class ac_recordController extends Controller{

    public function index(){
        $ac_records=ac_record::with('ac_user','ac_room')->get();
        $ac_records = ac_record::paginate(15);

        return view('admin.ac_record.index',['ac_records'=>$ac_records]);

    }
    public function delete($id){
        $ac_record =ac_record::find($id);

        if($ac_record!=''&&$ac_record->delete())
        {
            $data = [
                'status' => 1,
                'msg' => '删除成功！',
            ];
        }else{
            $data = [
                'status' => 0,
                'msg' => '删除失败',
            ];
        }
        return $data;
    }

    public function text()
    {
        return view('admin.ac_record.text');
    }



}