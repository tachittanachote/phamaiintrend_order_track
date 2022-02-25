<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderTrack extends Model
{
    //
    protected $fillable = ['order_id', 'employee', 'employee_id', 'status'];
}
