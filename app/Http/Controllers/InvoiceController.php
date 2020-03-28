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
        $patients = Patient::where('status', 'published')->get();
        $departments = Department::where('status', 'published')->get();
        $services=Service::all();
        $star=$this->star;
        return view('back.invoice-add', compact('patients','services','star', 'departments'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        return redirect()->back()->with(['action' => 'Delete', 'msg'=>"Invoice detail successfully deleted."]);
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

    public function view_add_invoice() {
        $star=$this->star;
        return view('back.invoice-add', compact('star'));
    }

    public function add_invoice(Request $request) {
        $invoice = new Invoice();
        $data = $request->data;
        $invoice->civil_id = $data['civil_id'];
        $invoice->invoice_id = $data['invoice_id'];
        $invoice->due_date = $data['due_date'];
        $invoice->appointment_date = $data['appointment_date'];
        $invoice->service_ids = $data['service_ids'];
        $invoice->sub_total = $data['sub_total'];
        $invoice->total_discount = $data['total_discount'];
        $invoice->invoice_total = $data['invoice_total'];
        $invoice->total_paid = $data['total_paid'];
        $invoice->total_due = $data['total_due'];
        $invoice->payment_terms = $data['payment_terms'];
        $invoice->client_notes = $data['client_notes'];
        $invoice->received_payment = $data['received_payment'];
        $invoice->payment_type = $data['payment_type'];
        $invoice->show_client_notes = $data['show_client_notes'];
        $invoice->show_payment_terms = $data['show_payment_terms'];
        $invoice->is_sent = $data['is_sent'];
        $save =  $invoice->save();
        $result;
        if($save) {
            $result = array(
                'status' => 'success',
                'msg' => 'Invoice successfully added.'
            );
        } else {
            $result = array(
                'status' => 'error',
                'msg' => 'Something went wrong while add invoice.'
            );
        }
        return json_encode($result);
    }

    public function multi_delete(Request $request){
        $del_ids=$request->sel_ids;
        $ids=explode(',', $del_ids);
        Invoice::destroy($ids);
        return redirect()->back()->with(['action' => 'Delete', 'msg'=>"Invoice detail successfully deleted."]);
    }

    public function multi_status(Request $request){
        $sel_ids=$request->sel_ids;
        $ids=explode(',', $sel_ids);
        $status=$request->status;
        foreach ($ids as $key => $id) {
            $patient=Invoice::Find($id);
            $patient->status=$status;
            $patient->save();
        }
        return redirect()->back()->with(['action' => $status, 'msg'=>"Invoice successfully".$status."."]);
    }

    public function send_invoice(Request $request) {
        $invoice = Invoice::Find($request->id);
        $invoice->is_sent = '1';
        $save = $invoice->save();
        if ($save) {
            return json_encode(
                array(
                    'status'=> 'success',
                    'msg'=> 'Invoice successfully sent'
                )
            );
        } else {
            return json_encode(
                array(
                    'status'=> 'error',
                    'msg'=> 'Something went wrong while sending invoice.'
                )
            );
        }
        // return json_encode($invoice);
    }
}
