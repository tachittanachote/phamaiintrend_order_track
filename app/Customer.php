<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = ['facebook_name', 'real_name', 'address', 'phone_number', 'line_id']; 

}
