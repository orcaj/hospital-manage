<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Model\Invoice;
use App\Model\Patient;
use App\Model\Service;
use App\Model\Doctor;
use App\Model\Department;

class SendInvoice extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $sub;
    public $mes;
    public $invoice_id;
    public function __construct($subject, $message, $id)
    {
        $this->sub = $subject;
        $this->mes = $message;
        $this->invoice_id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $e_message = $this->mes;
        $e_subject = $this->sub;

        $invoice = Invoice::Find($this->invoice_id);
        $patient = Patient::Find($invoice->civil_id);
        // $patients=Patient::where('status', 'published')->get();
        $service_ids = explode (",", $invoice->service_ids);
        // print_r($service_ids);
        // exit();
        $services = array();
        foreach ($service_ids as $service_id) {
            $services[] = Service::Find($service_id);
        }
        return $this->view('back.invoice_email', compact('invoice','invoice','services', 'patient', 'services'))->subject($e_subject);
        // return $this->view('back.invoice_email', compact('e_message'))->subject($e_subject);
    }
}
