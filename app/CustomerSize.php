<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerSize extends Model
{
    //
    protected $fillable = [
        'customer_id',
        'shirt_shirt_size',
        'shirt_waist_size',
        'sarong_waist_size',
        'sarong_hip_size',
        'sarong_long_size',
        'customer_name',
    ]; 
}
