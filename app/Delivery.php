<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    //
    protected $fillable = [
        'delivery_date',
        'customer_name',
        'tracking_id',
        'carrier',
    ];

    public static function formatMonth($m)
    {
        switch ($m) {
            case "January": {
                    return "มกราคม";
                }
            case "February": {
                    return "กุมภาพันธ์";
                }
            case "March": {
                    return "มีนาคม";
                }
            case "April": {
                    return "เมษายน";
                }
            case "May": {
                    return "พฤษภาคม";
                }
            case "June": {
                    return "มิถุนายน";
                }
            case "July": {
                    return "กรกฎาคม";
                }
            case "August ": {
                    return "สิงหาคม";
                }
            case "September": {
                    return "กันยายน";
                }
            case "October": {
                    return "ตุลาคม";
                }
            case "November": {
                    return "พฤศจิกายน";
                }
            case "December": {
                    return "ธันวาคม";
                }
            default: {
                    return "";
            }
        }
    }
}
