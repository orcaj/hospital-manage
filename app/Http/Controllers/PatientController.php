<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Patient;

class PatientController extends Controller
{
    private $star;

    public function __construct(){
        $this->star='patient';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients=Patient::all();
        $star=$this->star;
        return view('back.patient', compact('patients','star'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $star=$this->star;
        return view('back.patient-manage', compact('star'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $patient=new Patient($request->all());
        $patient->save();
        return redirect()->route('patients.index')->with('status','Successfully created.');
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
        $patient=Patient::Find($id);
        $star=$this->star;
        return view('back.patient-manage', compact('patient','star'));
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
        $patient=Patient::FindOrFail($id);
        $patient->name=$request->name;
        $patient->email=$request->email;
        $patient->phone=$request->phone;
        $patient->civil_id=$request->civil_id;
        $patient->address=$request->address;
        $patient->save();
        return redirect()->route('patients.index')->with('status','Successfully updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Patient::destroy($id);
        return redirect()->back()->with('status', 'Successfully deleted.');
    }
}
