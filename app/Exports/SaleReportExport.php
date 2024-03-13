<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SaleReportExport implements FromCollection, WithHeadings
{
    protected $export;

    public function __construct($export)
    {
        $this->export = $export;
    }

    public function collection()
    {
        return $this->transformData($this->export);
    }

    public function headings(): array
    {
        return [
            'Sl',
            'Order Date',
            'Invoice No',
            'Customer Name',
            'Order Detail',
            'payment Detail',
        ];
    }

    protected function transformData(array $export): Collection
    {
        return collect($export)->map(function ($order, $index) {

            return [
                'Sl' => $index + 1,
                'Order Date' => \Carbon\Carbon::parse($order['date'])->format('d/m/Y'),
                'Invoice No' => $order['invoice'],
                'Customer Name' => $order['customer'],
                'Order Detail'=>'Order Type : '.$order['order_type']. ($order['order_type'] == 'Dining' ? "\nTable No : " . $order['table_no'] : '')."\nOrder Status : " . $order['order_status'],
                'payment Detail'=>'Total : '.$order['total']."\nPaid :" .$order['paid']."\nBalance:" .$order['balence'],
            ];
        });
    }
}