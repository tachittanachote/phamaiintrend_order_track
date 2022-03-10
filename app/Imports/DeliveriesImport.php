<?php

namespace App\Imports;

use App\Delivery;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Carbon\Carbon;

class DeliveriesImport implements ToCollection, WithStartRow 
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $i = 0;
        $len = count($rows);
        foreach ($rows as $row) 
        {
            if($i == $len - 1) {
                
            } else {
                Delivery::updateOrCreate([
                        'delivery_date'            => Carbon::parse($row->all()[0])->format("Y-m-d"),
                        'customer_name'            => str_replace("คุณ", "", $row->all()[3]),
                        'tracking_id'              => $row->all()[8],
                        'carrier'                  => $row->all()[9],
                    ]);
            }
            $i++;
        }
    }

    public function startRow(): int
    {
        return 2;
    }

}
