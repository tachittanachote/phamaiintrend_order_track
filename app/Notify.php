<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
    //
    protected $fillable = ['order_id', 'line_id', 'message', 'status', 'notify_id', 'type', 'detail'];
}
