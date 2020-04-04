<?php

namespace App\Exports;

use App\Model\Invoice;
use App\Model\Service;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InvoicesExport implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Invoice::all();
    }

    public function headings(): array {
        return [
            'Invoice #',
            'Date Issue',            'Date Due',
            'Appointment Date',
            'Civil Id',
            'Patient name',
            'Phone number',
            'Email',
            'Address',
            'Department',
            'Doctor',
            'Service',
            'Sub total',
            'Discount',
            'Invoice Total',
            'Total paid',
            'Total Due'
        ];
    }
 
    public function map($invoice): array {
        $saved_services = $invoice->service_ids;
        $ids=explode(',', $invoice->service_ids);
        $department_list = '';
        $doctor_list = '';
        $service_list = '';
        foreach ($ids as $id) {
            $service = Service::Find($id);
            $department_list .= $service->getDepartment->name.",";

            $doctor_list .= $service->getDoctor->name.",";
            $service_list .= $service->name.",";
        }
        $department_list = rtrim($department_list, ',');
        $service_list = rtrim($service_list, ',');
        $doctor_list = rtrim($doctor_list, ',');
        return [
            $invoice->invoice_id,
            $invoice->created_date,
            $invoice->due_date,
            $invoice->appointment_date,
            $invoice->getPatient->civil_id,
            $invoice->getPatient->name,
            $invoice->getPatient->phone,
            $invoice->getPatient->email,
            $invoice->getPatient->address,
            $department_list,
            $doctor_list,
            $service_list,
            $invoice->sub_total,
            $invoice->total_discount,
            $invoice->invoice_total,
            $invoice->total_paid,
            $invoice->total_due
        ];
    }

}
