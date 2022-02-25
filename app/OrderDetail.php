<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
    protected $fillable = [
        'order_id',
        'shirt_shirt_size', 
        'shirt_waist_size', 
        'shirt_shirt_detail', 
        'shirt_waist_detail', 
        'sell_date', 
        'delivery_date', 
        'sarong_waist_size', 
        'sarong_hip_size', 
        'sarong_long_size', 
        'sarong_waist_detail', 
        'sarong_hip_detail', 
        'sarong_long_detail',
        'customer_name',
    ]; 


}
