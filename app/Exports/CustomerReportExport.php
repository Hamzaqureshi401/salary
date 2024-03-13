<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class CustomerReportExport implements FromCollection, WithHeadings
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
            'Bus File No.',
            'Parts Type',
            'Parts Amount',
            'Garage Services',
            'Description',
            'Total',
        ];
    }

    protected function transformData(array $data): Collection
    {
        return collect($data)->map(function ($item, $index) {
            
            return [
                'Sl' => $index + 1,
                'Bus File No.' => $item['name'],
                'Parts Type' => $item['orders_sum_total'],
                'Parts Amount' => $item['payments_sum_amount'],
                'Garage Services' => $difference,
                'Description' => $difference,
                'Total' => $difference,
            ];
        });
    }
}