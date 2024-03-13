<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DaywiseReportExport implements FromCollection, WithHeadings, WithColumnWidths, WithStyles
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
    public function columnWidths(): array
    {
        return [
            'A' => 2,   // 'Sl' column width
            'B' => 3,  // 'Bus File No.' column width
            'C' => 3,  // 'Company' column width
            'D' => 3,  // 'Driver' column width
            'E' => 3,  // 'Rent Amount' column width
            'F' => 3,  // 'Maintenance Parts Name' column width
            'G' => 3,  // 'Parts Amount' column width
            'H' => 3,  // 'Garage Services' column width
            'I' => 3,  // 'Fuel Type' column width
            'J' => 3,  // 'Amount' column width
            'K' => 3,  // 'Total Maintenance Cost' column width
            'L' => 3,  // 'Total Petrol Expense' column width
            'M' => 3,  // 'Total Driver Cost' column width
            'N' => 3,  // 'Total Expenses' column width
            'O' => 3,  // 'Rent Received' column width
            'P' => 3,  // 'Profit' column width
                // Add more columns as needed
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]], // Style for the first row (headings)
        ];
    }

      public function headings(): array
    {
        return [
            // 'Sl',
            'Bus File No.',
            'Com pany',
            'Dr iver',
            'Rent Amt',


            'Mntnc Prts',
            'Parts Amt',
            'Garage Ser',

            'Fuel Type',
            'Fuel Amt',

            

            'Total Maintenance Cost   ',
            'Total Petrol Expense',
            'Total Driver Cost  ',
            'Total Expenses',
            'Rent Received',
            'Profit',
        ];
    }

    protected function transformData(array $data): Collection{

        //dd($data);
    $totalExpenses = 0;
    $result = collect();

    foreach ($data as $collectionName => $collection) {

        $result = $result->concat($collection->map(function ($item, $index) use ($collectionName) {
            return [
                // 'Sl' => $item,
                'Bus File No.'      => $item->vehicle_file_no,
                'Company'          => $collectionName === 'assignings' ? $item->company->name : '--',
                'Driver'           => $collectionName === 'assignings' ? $item->driver->name : '--',
                'Rent Amount'      => $collectionName === 'assignings' ? $item->amount : '--',



                'Parts Name'        => $collectionName === 'maintenances' ? $item->partstype->name : '--',
                'Garage Amount'   => $collectionName === 'maintenances' ? $item->payment : '--', // Adjust this based on the collection name
                'Garage Services'   => $collectionName === 'maintenances' ? $item->garage_services_charges : '--', // Adjust this based on the collection name
                


                
                'Expense Type'      => $collectionName === 'expenses' ? $item->expensetype->name : '--',
                'Parts Amount'      => $collectionName === 'expenses' ? $item->amount : '--',
                //'Description'       => $item->description,

                'Total Maintenance Cost' =>  $collectionName === 'maintenances' ? ($item->payment + $item->garage_services_charges) : 0,

                
                'Total Petrol Expense'   => $collectionName === 'expenses' ? $item->amount : '--',

                'Total Driver Cost' => $collectionName === 'expenses'
                ? $item->where('id' , $item->id)->where('expense_type_id', 2)->get()->sum('amount')
                : '--',

                'Total Expenses' => $collectionName === 'maintenances'
                    ? ($item->payment + $item->garage_services_charges)
                    : ($collectionName === 'expenses'
                        ? $item->amount
                        : ($collectionName === 'expenses'
                            //? $item->driver->monthly_salary
                            ? $item->where('id' , $item->id)->where('expense_type_id', 2)->get()->sum('amount')
                            : 0)),
                'Rent Received'          => $collectionName === 'assignings' ? $item->amount : '0',
                'Profit'                 => 0,
            ];
        }));
    }

   $data = [
            // 'Sl'                    => '--' ,
            'Bus File No.'          => '--' ,
            'Com pany'              => '--' ,
            'Dr iver'               => '--' ,
            'Rent Amt'              => '--' ,
            'Mntnc Prts'            => '--' ,
            'Parts Amt'             => '--' ,
            'Garage Ser'            => '--' ,
            'Fuel Type'             => '--' ,
            'Fuel Amt'              => '--' ,
            'Total Maintenance Cost'=> '--' ,
            'Total Petrol Expense'  => '--' ,
            'Total Driver Cost  '   => '--' ,
            'Total Expenses'        => $result->sum('Total Expenses') ,
            'Rent Received'         => $result->sum('Rent Received') ,
            'Profit'                => $result->sum('Rent Received') - $result->sum('Total Expenses'),
        ];
        $resultArray = $result->toArray();
        array_push($resultArray, $data);

    return collect($resultArray);
}

}