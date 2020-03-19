<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Department;

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
        return redirect()->route('department.index')->with('status', 'Successfully created');
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
        $department=Department::FindOrFail($id);
        $department->name=$request->name;
        $department->save();
        return redirect()->route('department.index')->with('status', 'Successfully updated'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Department::destroy($id);
        return redirect()->route('department.index')->with('status', 'Successfully deleted'); 
    }
}
