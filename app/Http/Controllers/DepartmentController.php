<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Department;
use App\Model\Doctor;
use APp\Model\Service;

class DepartmentController extends Controller
{
    private $star;

    public function __construct(){
        $star="department";
        $this->star=$star;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments=Department::all();
        $star=$this->star;
        return view('back.department', compact('departments','star'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $star=$this->star;
        return view('back.department-manage',compact('star'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $department=new Department($request->all());
        $department->save();
        return redirect()->route('department.index')->with(['action' => 'Create', 'msg'=>"Department successfully created."]);
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
        $department=Department::FindOrFail($id);
        $star=$this->star;
        return view('back.department-manage', compact('department','star'));
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
        $old_data = Department::Find($id)->name;
        $unique = Department::where('name', $request->name)->where('name','<>', $old_data)->count();
        if($unique>0){
            return redirect()->back()->with(['action'=>'Error','msg' => 'Department name already exist.', 'error_depart' => $request->name]);
        }
        $department=Department::FindOrFail($id);
        $department->name = $request->name;
        $department->status = $request->status;
        $department->save();
        return redirect()->route('department.index')->with(['action' => 'Update', 'msg'=>"Department detail successfully updated."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return $id;
        // $doctors = Doctor::where('department_id', $id)->get();
        // $services = Service::where('')
        // echo count($doctors);
        // echo $id;
        // exit;
        Department::destroy($id);
        return redirect()->route('department.index')->with(['action' => 'Delete', 'msg'=>"Department detail successfully deleted."]);
    }

    public function check_duplication(Request $request) {
        $unique=Department::where('name', $request->name)->count();
        if($unique>0){
            return json_encode(0);
        }
        return json_encode(1);
    }

    public function multi_delete(Request $request){
        $del_ids=$request->sel_ids;
        $ids=explode(',', $del_ids);
        Department::destroy($ids);
        return redirect()->back()->with(['action' => 'Delete', 'msg'=>"Department detail successfully deleted."]);
    }

    public function multi_status(Request $request){
        $sel_ids=$request->sel_ids;
        $ids=explode(',', $sel_ids);
        $status=$request->status;
        foreach ($ids as $key => $id) {
            $patient=Department::Find($id);
            $patient->status=$status;
            $patient->save();
        }
        return redirect()->back()->with(['action' => $status, 'msg'=>"Department successfully".$status."."]);
    }
}
