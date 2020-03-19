<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Invoice;
use App\Model\Patient;
use App\Model\Service;
use App\Model\Doctor;
use App\Model\Department;



class InvoiceController extends Controller
{
    private $star;

    public function __construct(){
        $this->star='invoice';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices=Invoice::all();
        $star=$this->star;
        return view('back.invoice', compact('invoices','star'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patients=Patient::all();
        $services=Service::all();
        $star=$this->star;
        return view('back.invoice-manage', compact('patients','services','star'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoice=new Invoice($request->all());
        $invoice->save();
        return redirect()->route('invoice.index')->with('status','Successfully created!');
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
        $invoice=Invoice::Find($id);
        $patients=Patient::all();
        $services=Service::all();
        $star=$this->star;
        return view('back.invoice-manage', compact('invoice','patients','services','star'));

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
        $invoice=Invoice::Find($id);
        $invoice->civil_id=$request->civil_id;
        $invoice->service_id=$request->service_id;
        $invoice->save();
        return redirect()->route('invoice.index')->with('status','Successfully updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Invoice::destroy($id);
        return redirect()->back()->with('status', 'Successfully deleted.');
    }
    public function get_pat_date(Request $request){
        $civil_id=$request->civil_id;
        $patient=Patient::where('civil_id', $civil_id)->first();
        return json_encode($patient);
    }

    public function get_service_data(Request $request){
        $service_id=$request->service_id;

        $service=Service::FindOrFail($service_id);

        $depart_name=Department::Find($service->department_id)->name;

        $doctor_name=Doctor::Find($service->doctor_id)->name;
        $service->depart=$depart_name;
        $service->doctor=$doctor_name;
        return json_encode($service);

    }
}
