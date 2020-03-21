<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


use App\User;

class StaffController extends Controller
{
    private $star;

    public function __construct(){
        $this->star='staff';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs=User::where('id','<>', auth()->user()->id )->get();
        $star=$this->star;
        return view('back.staff', compact('staffs', 'star'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $star=$this->star;
        return view('back.staff-create', compact('star'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $staff=new User($request->all());
        $staff->password=Hash::make($request->password);
        $staff->save();
        return redirect()->route('staff.index')->with(['action' => 'Create', 'msg'=>"User successfully created."]);
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
    public function edit($id)
    {
        $staff=User::FindOrFail($id);
        $star=$this->star;
        return view('back.staff-manage', compact('staff', 'star'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $old_email = User::Find($id)->email;
        $unique=User::where('email', $request->email)->where('email','<>', $old_email)->count();
        if($unique > 0){
            return redirect()->back()->with(['action'=>'Error','msg' => 'Email already exist.', 'error_email' => $request->email]);
        }
        $staff=User::FindOrFail($id);
        $staff->name=$request->name;
        $staff->email=$request->email;
        $staff->status = $request->status;
        $staff->type = $request->type;
        // $staff->password=Hash::make($request->password);
        $staff->save();
        return redirect()->route('staff.index')->with(['action' => 'Update', 'msg'=>"Patient detail successfully updated."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back()->with(['action' => 'Delete', 'msg'=>"User detail successfully deleted."]);
    }

    /**
     * Check if user email exist
     *
     * @param  int  $req
     * @return 0 if exist, 1 not exist
     */
    public function confirm_create(Request $request) {
        $unique=User::where('email', $request->email)->count();
        if($unique>0){
            return json_encode(0);
        }
        return json_encode(1);
    }

    public function multi_delete(Request $request){
        $del_ids=$request->sel_ids;
        $ids=explode(',', $del_ids);
        User::destroy($ids);
        return redirect()->back()->with(['action' => 'Delete', 'msg'=>"User detail successfully deleted."]);
    }

    public function multi_status(Request $request){
        $sel_ids=$request->sel_ids;
        $ids=explode(',', $sel_ids);
        $status=$request->status;
        foreach ($ids as $key => $id) {
            $staff=User::Find($id);
            $staff->status=$status;
            $staff->save();
        }
        return redirect()->back()->with(['action' => $status, 'msg'=>"User successfully".$status."."]);
    }

    public function changePassword($id, Request $request){
        $staff=User::FindOrFail($id);
        // var_dump($request);
        $staff->password = Hash::make($request->password);
        $staff->save();
        return redirect()->back()->with(['action' => "Password Changed", 'msg'=>"Password changed."]);
        // var_dump($staff);
        // exit();
        // $staff
    }
}
