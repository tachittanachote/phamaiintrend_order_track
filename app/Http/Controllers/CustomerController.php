<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addCustomer(Request $request) {

        $customerCheck = Customer::where('facebook_name', $request->facebook_name)->first();
        if($customerCheck) {
            return response()->json([
                'status' => 'error',
                'result' => 'ชื่อผู้ใช้งานนี้มีอยู่แล้วในระบบ',
            ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
        }

        $customer = Customer::create([
            'facebook_name' => $request->facebook_name, 
            'real_name' => $request->real_name, 
            'address' => $request->address, 
            'phone_number' => $request->phone_number 
        ]);

        if($customer) {
            return response()->json([
                'status' => 'success',
                'result' => 'ดำเนินการสำเร็จ',
            ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
        }else {
            return response()->json([
                'status' => 'error',
                'result' => 'ไม่สามารถดำเนินการได้',
            ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
        }
    }
}
