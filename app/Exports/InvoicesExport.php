<?php

namespace App\Exports;

use App\Model\Invoice;
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
            'Invoice Id',
            'Amount',
            'Date',    
            "Patient",
            "Status"
            
        ];
    }
 
    public function map($invoice): array {
        return [
            $invoice->invoice_id,
            $invoice->total_due,
            $invoice->created_at,
            $invoice->civil_id,
            $invoice->status
        ];
    }

}
