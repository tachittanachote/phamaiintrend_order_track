<?php

namespace App\Imports;

use App\Customer;
use App\OrderList;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Carbon\Carbon;

class OrdersImport implements ToCollection, WithStartRow, WithMultipleSheets 
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {

            $UNIX_DATE = ($row->all()[1] - 25569) * 86400;
            $order_date = Carbon::parse($UNIX_DATE)->format('Y-m-d');

            $UNIX_DATE_T = ($row->all()[15] - 25569) * 86400;
            $transfer_date = Carbon::parse($UNIX_DATE_T)->format('Y-m-d');

            Customer::updateOrCreate([
                'facebook_name' => $row->all()[2]
            ]);

            if(isset($row->all()[4])) {
                Customer::where('facebook_name', $row->all()[2])->update(['real_name' => $row->all()[4]]);
            }

            if (isset($row->all()[5])) {
                Customer::where('facebook_name', $row->all()[2])->update(['address' => $row->all()[5]]);
            }

            if (isset($row->all()[6])) {
                Customer::where('facebook_name', $row->all()[2])->update(['phone_number' => $row->all()[6]]);
            }
            

            OrderList::updateOrCreate([
                    'order_number'          => isset($row->all()[0]) ? $row->all()[0] : "",
                    'order_date'            => isset($order_date) ? $order_date : "",
                    'facebook_name'         => isset($row->all()[2]) ? $row->all()[2] : "",
                    'receive_bank_account'  => 0,
                    'transfer_amount'       => 0,
                    'transfer_datetime'     => 0,
                    'have_souvenir'         => 0,
                    'souvenir'              => 0,
                    'product_code'          => isset($row->all()[18]) ? $row->all()[18] : "",
                    'detail'                => isset($row->all()[19]) ? $row->all()[19] : "",
                    'comment'               => isset($row->all()[20]) ? $row->all()[20] : "",
                    'price'                 => isset($row->all()[21]) ? $row->all()[21] : "",
                    'order_timestamp'       => isset($row->all()[22]) ? $row->all()[22] : "",
            ],
            [
                'order_number'          => isset($row->all()[0]) ? $row->all()[0] : "", 
                'order_date'            => isset($order_date) ? $order_date : "",
                'facebook_name'         => isset($row->all()[2]) ? $row->all()[2] : "",
                'facebook_id'           => isset($row->all()[3]) ? $row->all()[3] : "",
                'customer_name'         => isset($row->all()[4]) ? $row->all()[4] : "",
                'address'               => isset($row->all()[5]) ? $row->all()[5] : "",
                'phone_number'          => isset($row->all()[6]) ? $row->all()[6] : "",
                'note'                  => isset($row->all()[7]) ? $row->all()[7] : "",
                'parcel_number'         => isset($row->all()[8]) ? $row->all()[8] : "",
                'quantity'              => isset($row->all()[9]) ? $row->all()[9] : "",
                'amount'                => isset($row->all()[10]) ? $row->all()[10] : "",
                'ship_price'            => isset($row->all()[11]) ? $row->all()[11] : "",
                'total_price'           => isset($row->all()[12]) ? $row->all()[12] : "",
                'receive_bank_account'  => 0,
                'transfer_amount'       => 0,
                'transfer_datetime'     => 0,
                'have_souvenir'         => 0,
                'souvenir'              => 0,
                'product_code'          => isset($row->all()[18]) ? $row->all()[18] : "",
                'detail'                => isset($row->all()[19]) ? $row->all()[19] : "",
                'comment'               => isset($row->all()[20]) ? $row->all()[20] : "",
                'price'                 => isset($row->all()[21]) ? $row->all()[21] : "",
                'order_timestamp'       => isset($row->all()[22]) ? $row->all()[22] : "",
            ]);
        }
    }

    public function startRow(): int
    {
        return 2;
    }

    public function sheets(): array
    {
        return [
            'Sheet1'=> $this
        ];
    }
}
