<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Department;
use App\Model\Doctor;
use App\Model\Service;

class ServiceController extends Controller
{
    private $star;

    public function __construct(){
        $this->star='service';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $services=Service::all();
        $star=$this->star;
        return view('back.service', compact('services','star'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments=Department::where('status', 'published')->get();
        $doctors=Doctor::where('status', 'published')->get();
        $star=$this->star;
        return view('back.service-manage', compact('departments','doctors','star'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $service=new Service($request->all());
        $service->save();
        return redirect()->route('services.index')->with(['action' => 'Create', 'msg'=>"Service successfully created."]);
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
        $service=Service::FindOrFail($id);
        $cur_depart = Department::Find($service->department_id);
        $cur_doctor = Doctor::Find($service->doctor_id);
        $departments=Department::where('status', 'published')->get();
        $departments[] = $cur_depart;
        $doctors=Doctor::where('status', 'published')->get();
        $doctors[] = $cur_doctor;
        $star=$this->star;
        return view('back.service-manage', compact('service','departments','doctors','star'));
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
        $service=Service::FindOrFail($id);
        $service->name=$request->name;
        $service->price=$request->price;
        $service->department_id=$request->department_id;
        $service->doctor_id=$request->doctor_id;
        $service->status = $request->status;
        $service->save();
        return redirect()->route('services.index')->with(['action' => 'Update', 'msg'=>"Service detail successfully updated."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Service::destroy($id);
        return redirect()->back()->with('status','Successfully deleted.');
    }

    public function multi_delete(Request $request){
        $del_ids=$request->sel_ids;
        $ids=explode(',', $del_ids);
        Service::destroy($ids);
        return redirect()->back()->with(['action' => 'Delete', 'msg'=>"Services detail successfully deleted."]);
    }

    public function multi_status(Request $request){
        $sel_ids=$request->sel_ids;
        $ids=explode(',', $sel_ids);
        $status=$request->status;
        foreach ($ids as $key => $id) {
            $service=Service::Find($id);
            $service->status=$status;
            $service->save();
        }
        return redirect()->back()->with(['action' => $status, 'msg'=>"Services successfully".$status."."]);
    }

}
