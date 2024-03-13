<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class DateWiseStockReportExport implements FromCollection, WithHeadings
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
            'Date',
        ];
    }

    protected function transformData(Collection $data): Collection
    {
        return collect($data)->map(function ($item, $index) {

            return [
                'Sl' => $index + 1,
                'Product Name' => $item->product->name,
                'Quantity' => $item->quantity,
                'Date' => $item->created_at,
            ];
        });
    }
}