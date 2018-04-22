<?php
/**
 * Created by PhpStorm.
 * User: 伟进
 * Date: 2018/3/16
 * Time: 19:51
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Model\ac_user;
use App\Http\Model\Floor;
use App\Http\Model\Permit;
use App\Http\Model\Room;
use Illuminate\Http\Request;

class PermitController extends Controller
{
    public function index()
    {
        $permits=Permit::with('user','room')->get();
        //$permit->room->floor_name=Floor::find($permit->room->floor_id);
        foreach($permits as $p)
        {
            $p->room->floor_name=Floor::find($p->room->floor_id)->floor_name;
        }


        //var_dump($permit);
        $floors=Floor::get();

        return view('admin.permit.index',[
            'permits'=>$permits,
            'floors'=>$floors,
        ]);
    }

    public function getRoom()
    {
        $room=Room::where('floor_id','=',$_POST['floor_id'])->get();

        return json_encode($room);
    }
    public function delete($id)
    {
        $permit =Permit::find($id);

        if($permit!=''&&$permit->delete())
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
    public function create(Request $request)
    {

        if($request->isMethod('POST')) {

            $validator = \Validator::make($request->input(), [
                'Permit.b_hm_time'=>['regex:/^([01][0-9]|2[0-4]):([0-5][0-9])$/'],
                'Permit.e_hm_time'=>['regex:/^([01][0-9]|2[0-4]):([0-5][0-9])$/','after:Permit.b_hm_time'],
                'Permit.room_id'=>'required',
                'Permit.user_id'=>'required',
            ], [
                'regex' => ':attribute不符合时间格式',
                'after' => '结束时间必须大于开始时间',
                'required'=>':attribute为必填项'
            ], [
                'Permit.b_hm_time' => '开始时间',
                'Permit.e_hm_time' => '结束时间',
                'Permit.room_id' => '教室',
                'Permit.user_id'=>'学号'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $permit=$request->input('Permit');
            $permit['status']=1;
            $permit['b_d_time']=date('20y-m-d',strtotime($permit['b_d_time']));
            $permit['e_d_time']=date('20y-m-d',strtotime($permit['e_d_time']));
            $user=ac_user::where('user_no','=',$permit['user_id'])->first();
            if($user!=null)
            {
                $permit['user_id']=$user->user_id;
            }
            else
                return redirect()->back()->with('error', '学号/教工号不存在')->withInput();

            if (Permit::create($permit)) {
                return redirect('permit/index')->with('success', '添加成功！');
            } else {
                return redirect()->back()->withInput();
            }
        }
        $floors=Floor::get();
        $room=Room::get();
        return view('admin.permit.create',[
            'floors' => $floors,
            'room'=>$room,
        ]);
    }


    public function update(Request $request,$id)
    {
        $permit =Permit::with('user','room')->find($id);

        if($request->isMethod('POST'))
        {
            $validator = \Validator::make($request->input(), [
                'Permit.b_hm_time'=>['regex:/^([01][0-9]|2[0-4]):([0-5][0-9])$/'],
                'Permit.e_hm_time'=>['regex:/^([01][0-9]|2[0-4]):([0-5][0-9])$/','after:Permit.b_hm_time'],
                'Permit.room_id'=>'required',
                'Permit.user_id'=>'required',
            ], [
                'regex' => ':attribute不符合时间格式',
                'after' => '结束时间必须大于开始时间',
                'required'=>':attribute为必填项'
            ], [
                'Permit.b_hm_time' => '开始时间',
                'Permit.e_hm_time' => '结束时间',
                'Permit.room_id' => '教室',
                'Permit.user_id'=>'学号'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data=$request->input('Permit');
            $data['status']=1;
            $data['b_d_time']=date('20y-m-d',strtotime($data['b_d_time']));
            $data['e_d_time']=date('20y-m-d',strtotime($data['e_d_time']));
            $user=ac_user::where('user_no','=',$data['user_id'])->first();
            if($user!=null)
            {
                $data['user_id']=$user->user_id;
            }
            else
                return redirect()->back()->with('error', '学号/教工号不存在')->withInput();
            $permit->b_d_time=$data['b_d_time'];
            $permit->e_d_time=$data['e_d_time'];
            $permit->b_hm_time=$data['b_hm_time'];
            $permit->e_hm_time=$data['e_hm_time'];
            $permit->user_id=$data['user_id'];
            $permit->room_id=$data['room_id'];
            if($permit->save())
            {
                return redirect('permit/index')->with('success','修改成功！');
            }
        }
        $floors=Floor::get();
        $room=Room::get();
        return view('admin.permit.update',[
            'floors' => $floors,
            'room'=>$room,
            'permit' => $permit,
        ]);
    }
}