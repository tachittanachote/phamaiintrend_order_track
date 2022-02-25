<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EditDetail extends Model
{
    //
    protected $fillable = ['order_id', 'detail', 'edit_status'];
}
