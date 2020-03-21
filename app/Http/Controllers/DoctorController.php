<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Department;
use App\Model\Doctor;

class DoctorController extends Controller
{
    private $star;
    
    public function __construct(){
        $star="doctor";
        $this->star=$star;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors=Doctor::all();
        $star=$this->star;
        return view('back.doctor', compact('doctors','star'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments=Department::all();
        $star=$this->star;
        return view('back.doctor-manage', compact('departments','star'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $doctor=new Doctor($request->all());
        $doctor->save();
        return redirect()->route('doctors.index')->with(['action' => 'Create', 'msg'=>"Doctor successfully created."]);
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
        $doctor=Doctor::FindOrFail($id);
        $departments=Department::all();
        $star=$this->star;
        return view('back.doctor-manage', compact('doctor','departments','star'));
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
        $old_data = Doctor::Find($id)->email;
        $unique = Doctor::where('email', $request->email)->where('email','<>', $old_data)->count();
        if($unique > 0){
            return redirect()->back()->with(['action'=>'Error','msg' => 'Email already exist.', 'error_email' => $request->email]);
        }
        $doctor=Doctor::FindOrFail($id);
        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->department_id = $request->department_id;
        $doctor->tel = $request->tel;
        $doctor->status = $request->status;
        $doctor->save();
        return redirect()->route('doctors.index')->with(['action' => 'Update', 'msg'=>"Doctor detail successfully updated."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   echo $id;
        // exit();
        Doctor::destroy($id);
        return redirect()->route('doctors.index')->with('status', 'Successfully deleted');
    }

    public function check_duplication(Request $request) {
        // echo $request->name;
        // exit();
        $unique=Doctor::where('email', $request->email)->count();
        if($unique>0){
            return json_encode(0);
        }
        return json_encode(1);
    }

    public function multi_delete(Request $request){
        $del_ids=$request->sel_ids;
        $ids=explode(',', $del_ids);
        Doctor::destroy($ids);
        return redirect()->back()->with(['action' => 'Delete', 'msg'=>"Doctor detail successfully deleted."]);
    }

    public function multi_status(Request $request){
        $sel_ids=$request->sel_ids;
        $ids=explode(',', $sel_ids);
        $status=$request->status;
        foreach ($ids as $key => $id) {
            $patient=Doctor::Find($id);
            $patient->status=$status;
            $patient->save();
        }
        return redirect()->back()->with(['action' => $status, 'msg'=>"Doctor successfully".$status."."]);
    }
}
