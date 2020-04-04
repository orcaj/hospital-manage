<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Invoice;
use App\Model\Patient;
use App\Model\Service;
use App\Model\Doctor;
use App\Model\Department;
use App\Model\InvoiceHistories;
use App\Model\PaymentHistory;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InvoicesExport;
use PDF;

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
        $invoices=Invoice::orderBy('created_at', 'desc')->get();;
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
        // $cur_department = 
        $patient = Patient::Find($invoice->civil_id); //get patient for invoice
        $patients=Patient::where('status', 'published');   //get all patients list for dropdown
        $services=Service::all();   //get all services list for dropdown
        $doctors = Doctor::all();   //get all doctors list for dropdown
        $ids=explode(',', $invoice->service_ids);   //get saved service ids for invoice, 
        $saved_services = array();  //convert to array
        foreach ($ids as $id) {
            $saved_services[] = Service::Find($id);
        }
        $saved_percents = explode(',', $invoice->discount_percents);
        $departments = Department::all();   //get all department list for dropdown
        $star=$this->star;
        return view('back.invoice-edit', compact('invoice','patients','services','star', 'departments', 'patient', 'saved_services', 'doctors', 'saved_percents'));

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
        $invoice->discount_percents = $data['discount_percents'];
        $save =  $invoice->save();

        //save invoice history 
        $history = new InvoiceHistories();
        $history->invoice_id = $invoice->invoice_id;
        $history->action_type = 'created';
        $history->user_name = auth()->user()->name;
        $history->save();

        //if there is paid amount
        if ($data['total_paid'] != '0') {
            $history = new PaymentHistory();
            $history->invoice_id = $invoice->invoice_id;
            $history->payment_method = $data['payment_type'];
            $history->amount = $data['total_paid'];
            $history->user_name = auth()->user()->name;
            $history->status = 'success';
            $history->save();
        }
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

    public function update_invoice(Request $request) {
        $data = $request->data;
        $invoice = Invoice::Find($data['id']);
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
        $invoice->discount_percents = $data['discount_percents'];
        $save =  $invoice->save();

        //save invoice history
        $history = new InvoiceHistories();
        $history->invoice_id = $invoice->invoice_id;
        $history->action_type = $data['action_type'];
        $history->user_name = auth()->user()->name;
        $history->save();

        //if there is paid amount
        if ($data['additional_amount'] > 0) {
            $history = new PaymentHistory();
            $history->invoice_id = $invoice->invoice_id;
            $history->payment_method = $data['payment_type'];
            $history->amount = $data['additional_amount'];
            $history->user_name = auth()->user()->name;
            $history->status = 'success';
            $history->save();
        }
        $result;
        if($save) {
            $result = array(
                'status' => 'success',
                'msg' => 'Invoice successfully updated.'
            );
        } else {
            $result = array(
                'status' => 'error',
                'msg' => 'Something went wrong while edit invoice.'
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
            $invoice=Invoice::Find($id);
            $invoice->status=$status;
            $invoice->save();
            $history = new InvoiceHistories();
            $history->invoice_id = $invoice->invoice_id;
            $history->action_type = $status;
            $history->user_name = auth()->user()->name;
            $history->save();
        }
        return redirect()->back()->with(['action' => $status, 'msg'=>"Invoice successfully".$status."."]);
    }

    public function send_invoice(Request $request) {
        $invoice = Invoice::Find($request->id);
        $invoice->is_sent = '1';
        $save = $invoice->save();
        $history = new InvoiceHistories();
        $history->invoice_id = $invoice->invoice_id;
        $history->action_type = 'sent';
        $history->user_name = auth()->user()->name;
        $history->save();
        if ($save) {
            return json_encode(
                array(
                    'status'=> 'success',
                    'msg'=> 'Invoice successfully sent.'
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

    public function download_invoice($type)
    {
        $data = Invoice::all()->toArray();
        // echo $data;
        // exit();
        return Excel::download(new InvoicesExport, 'invoices.'.$type);
    }

    public function download_pdf($id)
    {
        $invoice = Invoice::Find($id);
        $patient = Patient::Find($invoice->civil_id);
        // $patients=Patient::where('status', 'published')->get();
        $service_ids = explode (",", $invoice->service_ids);
        // print_r($service_ids);
        // exit();
        $services = array();
        foreach ($service_ids as $service_id) {
            $services[] = Service::Find($service_id);
        }
        $data = ['title' => 'Invoice', 'invoice' => $invoice, 'patient' => $patient, 'services' => $services];
        
        return view('myPDF', compact('invoice','invoice','services', 'patient', 'services'));

        // $pdf = PDF::loadView('myPDF', $data);
    
        // return $pdf->download('itsolutionstuff.pdf');
    }

    public function get_invoice_history(Request $request) {

        $histories = InvoiceHistories::where('invoice_id', $request->invoice_id)->orderBy('created_at', 'desc')->get();
        $response;
        if($histories) {
            $response = array(
                'status' => 'success',
                'message' => 'Invoice History successfully gotten.',
                'data' => $histories
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Something went wrong while getting history',
                'data' => []
            );
        }
        return json_encode($response);
    }

    public function get_payment_history(Request $request) {

        $histories = PaymentHistory::where('invoice_id', $request->invoice_id)->orderBy('created_at', 'desc')->get();
        $response;
        if($histories) {
            $response = array(
                'status' => 'success',
                'message' => 'PaymentHistory History successfully gotten.',
                'data' => $histories
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Something went wrong while getting history',
                'data' => []
            );
        }
        return json_encode($response);
    }

    public function view_invoice($id) {
        $invoice=Invoice::Find($id);
        $patient = Patient::Find($invoice->civil_id);
        // $patients=Patient::where('status', 'published')->get();
        $service_ids = explode (",", $invoice->service_ids);
        // print_r($service_ids);
        // exit();
        $services = array();
        foreach ($service_ids as $service_id) {
            $services[] = Service::Find($service_id);
        }
        // print_r($services);
        // exit();
        // $services=Service::where('status', 'published')->get();
        $star=$this->star;
        return view('back.invoice-view', compact('invoice','invoice','services','star', 'patient', 'services'));
    }
}
