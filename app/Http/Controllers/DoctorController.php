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
        return redirect()->route('doctors.index')->with('status', 'Successfully created');
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
        $doctor=Doctor::FindOrFail($id);
        $doctor->name=$request->name;
        $doctor->email=$request->email;
        $doctor->department_id=$request->department_id;
        $doctor->tel=$request->tel;
        $doctor->save();
        return redirect()->route('doctors.index')->with('status','Successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Doctor::destroy($id);
        return redirect()->back()->with('status','Successfully deleted.');
    }
}
