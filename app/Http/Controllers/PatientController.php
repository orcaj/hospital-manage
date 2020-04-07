<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        // $request->session()->flash('status','Successfully created.');
        return redirect()->route('patients.index')->with(['action' => 'Create', 'msg'=>"Patient successfully created."]);
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

        $unique=Patient::where('civil_id', $request->civil_id)->where('id','<>',$id)->count();
        if($unique>0){
            return redirect()->back()->with(['action'=>'Error','msg' => 'Civil ID already exist.', 'error_civil_id' => $request->civil_id]);
        }
        $patient=Patient::FindOrFail($id);
        $patient->name = $request->name;
        $patient->email = $request->email;
        $patient->phone = $request->phone;
        $patient->civil_id = $request->civil_id;
        $patient->address = $request->address;
        $patient->status = $request->status;
        $patient->save();
        return redirect()->route('patients.index')->with(['action' => 'Update', 'msg'=>"Patient detail successfully updated."]);

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
        return redirect()->back()->with(['action' => 'Delete', 'msg'=>"Patient detail successfully deleted."]);
    }

    public function multi_delete(Request $request){
        $del_ids=$request->sel_ids;
        $ids=explode(',', $del_ids);
        Patient::destroy($ids);
        return redirect()->back()->with(['action' => 'Delete', 'msg'=>"Patient detail successfully deleted."]);
    }

    public function multi_status(Request $request){
        $sel_ids=$request->sel_ids;
        $ids=explode(',', $sel_ids);
        $status=$request->status;
        foreach ($ids as $key => $id) {
            $patient=Patient::Find($id);
            $patient->status=$status;
            $patient->save();
        }
        return redirect()->back()->with(['action' => $status, 'msg'=>"Patients successfully".$status."."]);
    }

    public function confirm_create(Request $request){
        $unique=Patient::where('civil_id', $request->civil_id)->count();
        if($unique > 0){
            return json_encode(0);
        }
        return json_encode(1);
    }

    public function get_patient_detail(Request $request) {
        $patient = Patient::Find($request->id);
        return json_encode($patient);
    }

    public function add_patient_on_invoice(Request $request) {
        $data = $request->data;
        // var_dump($data);
        $unique = Patient::where('civil_id', $data['civil_id'])->count();
        if ($unique > 0) {
            return json_encode(array("status" => "error", "msg" => "Civil Id already exist"));
        }
        // exit();
        $patient=new Patient($data);
        $patient->save();
        $response = array(
            "status" => "success",
            "msg" => "Patient details added",
            "data" => $patient
        );
        return json_encode($response);
    }

    public function getAllCivilId(Request $request) {
        $data = Patient::all();
        return json_encode($data);
    }

    public function check_if_civilid_exist(Request $request) {
        $data = Patient::where('civil_id', $request->data);
        return json_encode($data);
    }
}
