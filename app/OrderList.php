<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    //
    protected $fillable = [
        'order_number', 
        'order_date',
        'facebook_name',
        'facebook_id',
        'customer_name',
        'address',
        'phone_number',
        'note',
        'parcel_number',
        'quantity',
        'amount',
        'ship_price',
        'total_price',
        'receive_bank_account',
        'transfer_amount',
        'transfer_datetime',
        'have_souvenir',
        'souvenir',
        'product_code',
        'detail',
        'comment',
        'price',
        'order_timestamp',
        'printed',
        'deliveried',
        'order_completed',
    ];

    public static function getProducts() {
        return OrderList::select('product_code')->distinct()->get();
    }

}
