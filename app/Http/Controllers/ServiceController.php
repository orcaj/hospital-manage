<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Department;
use App\Model\Doctor;
use App\Model\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $services=Service::all();
        return view('back.service', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments=Department::all();
        $doctors=Doctor::all();
        return view('back.service-manage', compact('departments','doctors'));
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
        $service->status="publish";
        $service->publish_date=date('yy-m-d');
        $service->save();
        return redirect()->route('services.index')->with('status', 'Successfully created');
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
        $departments=Department::all();
        $doctors=Doctor::all();
        return view('back.service-manage', compact('service','departments','doctors'));
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
        $service->save();
        return redirect()->route('services.index')->with('status','Successfully updated.');
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

    public function publishChange($service_id, $status){
        $service=Service::Find($service_id);
        $service->status=$status;
        $service->save();
        return redirect()->back()->with('status', 'Successfully changed!');
    }
}
