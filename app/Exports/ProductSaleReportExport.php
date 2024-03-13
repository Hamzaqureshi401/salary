<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductSaleReportExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->transformData($this->data);
    }

    public function headings(): array
    {
        return [
            'Sl',
            'Product Name',
            'Quantity',
            'Amount',
        ];
    }

    protected function transformData(array $data): Collection
    {
        return collect($data)->map(function ($item, $index) {

            return [
                'Sl' => $index + 1,
                'Product Name' => $item['name'],
                'Quantity' => $item['qty'],
                'Amount' => getCurrency().number_format($item['amount'],2),
            ];
        });
    }
}