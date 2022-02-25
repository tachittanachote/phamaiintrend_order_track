<?php

namespace App\Http\Controllers;

use App\Customer;
use App\DeliveryPrint;
use App\EditDetail;
use App\OrderDetail;
use App\OrderList;
use App\OrderStatus;
use App\OrderTrack;
use App\ProductImage;
use Illuminate\Http\Request;
use App\User;
use App\WorkPrint;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function remove(Request $request)
    {

        $order = OrderList::where('id', $request->id)->delete();
        if ($order) {
            return response()->json([
                'status' => 'success',
                'result' => 'ดำเนินการสำเร็จ',
            ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json([
                'status' => 'error',
                'result' => 'ไม่สามารถดำเนินการได้',
            ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
        }
    }

    public function detail(Request $request)
    {

        $customerName = $request->facebook_name;

        if (!OrderList::where('facebook_name', $request->facebook_name)->first()) {
            return redirect()->back();
        }

        $orderId = $request->order_id;
        $current = Carbon::now();
        $deliveryStatus = $request->delivery_status;
        $printStatus = $request->print_status;
        $startAt = $request->startAt;
        $endAt = $request->endAt;
        $productCode = $request->product_code;
        $orderCompleted = $request->order_completed;

        $orders = OrderList::where('facebook_name', $request->facebook_name);

        if ($startAt && $endAt) {
            $orders->whereBetween('order_date', [$startAt ? Carbon::parse($startAt)->format('Y-m-d') : $current->format('Y-m-d'), $endAt ? Carbon::parse($endAt)->format('Y-m-d') : $current->format('Y-m-d')])->orderBy('id', 'asc');
        }

        if ($productCode) {
            $orders->where('product_code', 'like', '%' . $productCode . '%');
        }

        if ($orderCompleted == "0" || $orderCompleted == "1") {
            $orders->where('order_completed', '=', $orderCompleted);
        }

        if ($deliveryStatus == "0" || $deliveryStatus == "1") {
            $orders->where('deliveried', '=', $deliveryStatus);
        }

        if ($printStatus == "0" || $printStatus == "1") {
            $orders->where('printed', '=', $printStatus);
        }

        $result = $orders->paginate(50)->onEachSide(1)->appends(request()->query());

        return view('detail', compact('result', 'customerName', 'orderId', 'current', 'deliveryStatus', 'printStatus', 'startAt', 'endAt', 'productCode', 'orderCompleted'));
    }

    public function addOrder(Request $request)
    {

        $UNIX_DATE = Carbon::parse($request->order_timestamp)->format('Y-m-d');


        $date_time = $UNIX_DATE . " " . Carbon::now()->format('H:i:s');

        $date_time_plus_one = strtotime($date_time);
        $str_date = strtotime(date('Y-m-d H:i:s', $date_time_plus_one));
        $excel_date = 25569 + ($str_date / 86400);

        $user = OrderList::where('facebook_name', $request->customer_name)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาดกรุณาลองใหม่อีกครั้ง');
        }

        $addOrder = OrderList::create([
            'order_number'          => $request->order_id,
            'facebook_name'         => $user->facebook_name,
            'customer_name'         => $user->customer_name,
            'product_code'          => $request->product,
            'address'               => $request->address,
            'phone_number'          => $request->phone_number,
            'quantity'              => $request->quantity,
            'price'                 => $request->product_price,
            'total_price'           => $request->total_price,
            'detail'                => $request->detail,
            'order_date'            => $request->order_date,
            'receive_bank_account'  => 0,
            'transfer_amount'       => 0,
            'transfer_datetime'     => 0,
            'order_timestamp'       => $excel_date,
            'note'                  => 0,
            'amount'                => $request->total_price,
        ]);

        if ($addOrder) {
            return redirect()->back()->with('success', 'ดำเนินการสำเร็จ');
        } else {
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาดกรุณาลองใหม่อีกครั้ง');
        }
    }

    public function check(Request $request)
    {

        $orderId = $request->order_id;

        $order = OrderList::where('id', $orderId)->first();
        if (!$order) return redirect()->back();

        $editDetails = EditDetail::where('order_id', $orderId)->get();


        return view('orderdetail', compact('order', 'editDetails'));
    }

    public function update(Request $request)
    {

        $orderDetail = OrderDetail::updateOrCreate(
            [
                'order_id'    => $request->order_id,
            ],
            [
                'order_id'    => $request->order_id,
                'shirt_shirt_size' => $request->shirtSize,
                'shirt_waist_size' => $request->waistSize,
                'shirt_shirt_detail' => $request->shirtDetail,
                'shirt_waist_detail' => $request->waistDetail,
                'sell_date' => $request->sellDate,
                'delivery_date' => $request->deliveryDate,
                'sarong_waist_size' => $request->sarongwaistSize,
                'sarong_hip_size' => $request->saronghipSize,
                'sarong_long_size' => $request->saronglongSize,
                'sarong_waist_detail' => $request->sarongwaistDetail,
                'sarong_hip_detail' => $request->saronghipDetail,
                'sarong_long_detail' => $request->saronglongDetail,
                'customer_name' => $request->customer_name,
            ]
        );

        if ($orderDetail) {
            return response()->json([
                'status' => 'success',
                'result' => 'ดำเนินการสำเร็จ',
            ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json([
                'status' => 'error',
                'result' => 'ไม่สามารถดำเนินการได้',
            ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
        }
    }

    public function apply(Request $request)
    {

        $orderDetail = OrderDetail::updateOrCreate(
            [
                'order_id'    => $request->order_id,
            ],
            [
                'shirt_shirt_size' => $request->shirtSize,
                'shirt_waist_size' => $request->waistSize,
                'shirt_shirt_detail' => $request->shirtDetail,
                'shirt_waist_detail' => $request->waistDetail,
                'sarong_waist_size' => $request->sarongwaistSize,
                'sarong_hip_size' => $request->saronghipSize,
                'sarong_long_size' => $request->saronglongSize,
                'sarong_waist_detail' => $request->sarongwaistDetail,
                'sarong_hip_detail' => $request->saronghipDetail,
                'sarong_long_detail' => $request->saronglongDetail,
                'customer_name' => $request->customer_name,
            ]
        );

        if ($orderDetail) {
            return response()->json([
                'status' => 'success',
                'result' => 'ดำเนินการสำเร็จ',
            ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json([
                'status' => 'error',
                'result' => 'ไม่สามารถดำเนินการได้',
            ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
        }
    }

    public function printAssign(Request $request)
    {

        $order_id = $request->order_id;
        $order = OrderList::where('id', $order_id)->first();
        if (!$order) return redirect()->back();

        $orderDetail = OrderDetail::where('order_id', $order_id)->first();

        return view('printassign', compact('order_id', 'order', 'orderDetail'));
    }

    public function printConfirm(Request $request)
    {
        $order_id = $request->id;
        $order = OrderList::where('id', $order_id)->first();
        $order->printed = "1";

        $workPrint = WorkPrint::updateOrCreate([
            'order_id' => $order_id,
        ]);

        $orderStatus = OrderStatus::where('order_id', $order_id)->orderBy('id', 'desc')->first();
        if (!$orderStatus) {

            OrderStatus::create([
                'order_id' => $order_id,
                'status' => 'processing'
            ]);

            OrderTrack::create([
                'order_id' => $order_id,
                'employee' => Auth::user()->name,
                'employee_id' => Auth::user()->id,
                'status' => 'processing'
            ]);
        } else {
            $orderStatus->status = 'processing';
            $orderStatus->save();

            $orderTrack = OrderTrack::where('order_id', $order_id)->orderBy('id', 'desc')->first();
            $orderTrack->status = 'processing';
            $orderTrack->save();
        }

        if ($order->save()) {
            return response()->json([
                'status' => 'success',
                'result' => 'ดำเนินการสำเร็จ',
            ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json([
                'status' => 'error',
                'result' => 'ไม่สามารถดำเนินการได้',
            ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
        }
    }

    public function printCustomerOrderConfirm(Request $request)
    {
        foreach ($request->orderList as $orderId) {
            $orderList = OrderList::where('id', $orderId)->first();
            $orderList->deliveried = 1;
            $orderList->order_completed = 1;
            $orderList->printed = 1;
            $orderList->save();

            $delivery = DeliveryPrint::updateOrCreate([
                'order_id' => $orderId,
            ]);

            $orderStatus = OrderStatus::updateOrCreate([
                'order_id' => $orderId,
                'status' => 'shipped'
            ]);

            $orderTrack = OrderTrack::create([
                'order_id' => $orderId,
                'employee' => Auth::user()->name,
                'employee_id' => Auth::user()->id,
                'status' => 'shipped'
            ]);
        }

        $user = Customer::where('id', $request->customer_id)->first();

        $image = $request->image;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = str_random(10) . '.' . 'png';
        File::put(storage_path() . '/app/public/upload/customer/' . $imageName, base64_decode($image));

        $img = '/upload/customer/' . $imageName;
    
        if($user->line_id) {

            $curl = curl_init();

            $payload = '{
                "to": "' . $user->line_id . '",
                "messages":[
                    {
                        "type":"flex",
                        "sender":{
                            "name":"ข้อความอัตโนมัติ",
                            "iconUrl":"https://order.chapayom.com/images/pack.jpeg"
                        },
                        "altText":"สรุปรายการจัดส่งสินค้าวันที่ ' . Carbon::now() . '",
                        "contents":{
                            "type": "bubble",
                            "header": {
                                "type": "box",
                                "layout": "vertical",
                                "contents": [
                                {
                                    "type": "image",
                                    "url": "https://order.phamaiintrend.co/images/box.png",
                                    "margin": "lg",
                                    "animated": true
                                }
                                ]
                            },
                            "body": {
                                "type": "box",
                                "layout": "vertical",
                                "contents": [
                                {
                                    "type": "text",
                                    "text": "สรุปรายการจัดส่งสินค้า",
                                    "weight": "bold",
                                    "size": "sm"
                                },
                                {
                                    "type": "text",
                                    "text": "วันที่ ' . Carbon::now() . '",
                                    "size": "sm",
                                    "margin": "sm",
                                    "weight": "bold"
                                },
                                {
                                    "type": "box",
                                    "layout": "vertical",
                                    "margin": "lg",
                                    "spacing": "sm",
                                    "contents": [
                                    {
                                        "type": "box",
                                        "layout": "horizontal",
                                        "spacing": "sm",
                                        "contents": [
                                        {
                                            "type": "text",
                                            "text": "หมายเลขลูกค้า",
                                            "size": "sm",
                                            "color": "#6A6A6A"
                                        },
                                        {
                                            "type": "text",
                                            "text": "PM000-' .$request->customer_id . '",
                                            "size": "sm",
                                            "color": "#6A6A6A",
                                            "align": "end"
                                        }
                                        ]
                                    }
                                    ]
                                },
                                {
                                    "type": "box",
                                    "layout": "horizontal",
                                    "contents": [
                                    {
                                        "type": "text",
                                        "text": "รายการค้างจัดส่ง",
                                        "size": "sm",
                                        "color": "#6A6A6A"
                                    },
                                    {
                                        "type": "text",
                                        "text": "จำนวน ' . $request->progress_count . ' รายการ",
                                        "size": "sm",
                                        "color": "#6A6A6A",
                                        "align": "end"
                                    }
                                    ],
                                    "paddingTop": "md"
                                },
                                {
                                    "type": "box",
                                    "layout": "horizontal",
                                    "contents": [
                                    {
                                        "type": "text",
                                        "text": "รายการที่จัดส่ง",
                                        "size": "sm",
                                        "color": "#6A6A6A"
                                    },
                                    {
                                        "type": "text",
                                        "text": "จำนวน ' . $request->complete_count . ' รายการ",
                                        "size": "sm",
                                        "color": "#6A6A6A",
                                        "align": "end"
                                    }
                                    ],
                                    "paddingTop": "sm"
                                }
                                ]
                            },
                            "footer": {
                                "type": "box",
                                "layout": "horizontal",
                                "spacing": "none",
                                "contents": [
                                {
                                    "type": "button",
                                    "style": "primary",
                                    "height": "sm",
                                    "action": {
                                    "type": "uri",
                                    "label": "ตรวจสอบเพิ่มเติม",
                                    "uri": "' . $request->url .'?image='.$img.'"
                                    },
                                    "margin": "sm"
                                },
                                {
                                    "type": "spacer",
                                    "size": "sm"
                                }
                                ],
                                "paddingAll": "xl",
                                "offsetTop": "none",
                                "margin": "xl"
                            }
                        }
                    }
                ]
                }';

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.line.me/v2/bot/message/push',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $payload,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ehrXtpNl2PbwxfL2TSQ0epzWaVxi1V1WPd9spZJoZpMuiOeZgp95NCkMcOCrkoMJNn4/KZb7Zlo4rojN/zQKB9hq5w3xc4+2mFMZovLr0O6mH3yIoX4a785qHT9aXugIodREA4o1W3Ahtb0giZZYgwdB04t89/1O/w1cDnyilFU=',
                    'Content-Type: application/json'
                ),
            ));
            $response = curl_exec($curl);
            return $response;
            curl_close($curl);

        }

        return response()->json([
            'status' => 'success',
            'result' => 'ดำเนินการสำเร็จ',
        ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }

    public function deliveryPage(Request $request)
    {
        $customerName = $request->facebook_name;
        $facebookName = $request->facebook_name;

        $orderId = $request->order_id;
        $deliveryStatus = $request->delivery_status;
        $printStatus = $request->print_status;
        $productCode = $request->product_code;
        $orderCompleted = $request->order_completed;

        $orders = OrderList::orderBy('id', 'asc');

        if ($facebookName) {
            $orders->where('facebook_name', 'like', '%' . $facebookName . '%');
        }

        if ($productCode) {
            $orders->where('product_code', 'like', '%' . $productCode . '%');
        }

        if (!isset($deliveryStatus)) {
            $orders->where('deliveried', '=', 0);
        } else {
            $orders->where('deliveried', '=', $deliveryStatus);
        }

        if (isset($printStatus)) {
            $orders->where('printed', '=', $printStatus);
        }

        $result = $orders->paginate(50)->onEachSide(1)->appends(request()->query());

        return view('deliverylist', compact('result', 'customerName', 'orderId', 'deliveryStatus', 'printStatus', 'productCode', 'orderCompleted', 'facebookName'));
    }

    public function pendingPage(Request $request)
    {
        $orders = OrderList::orderBy('id', 'asc');
        $orders->where('printed', '=', 0);
        $result = $orders->paginate(50)->onEachSide(1)->appends(request()->query());

        return view('pendinglist', compact('result'));
    }

    public function customerList(Request $request)
    {
        $customerName = $request->customer_name;
        $facebookName = $request->facebook_name;

        $orderLists = OrderList::select('*')->orderBy('id', 'asc');

        if ($customerName) {
            $orderLists->where('customer_name', 'like', '%' . $customerName . '%');
        }

        if ($facebookName) {
            $orderLists->where('facebook_name', 'like', '%' . $facebookName . '%');
        }

        $result = $orderLists->groupBy('facebook_name')->paginate(50)->appends(request()->query());

        return view('customerlist', compact('result', 'customerName', 'facebookName'));
    }

    public function scanCheck(Request $request)
    {
        $orderTracks = OrderTrack::where('order_id', $request->order_id)->get();
        $orderDetail = OrderList::where('id', $request->order_id)->first();
        $editDetails = EditDetail::where('order_id', $request->order_id)->get();
        return response()->json([
            'status' => 'success',
            'result' => $orderTracks,
            'order_detail' => $orderDetail,
            'edit_details' => $editDetails,
        ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }

    public function addEditDetail(Request $request)
    {

        $createEditDetail = EditDetail::create([
            'order_id' => $request->id,
            'detail' => $request->detail,
        ]);

        if ($createEditDetail) {
            return response()->json([
                'status' => 'success',
                'result' => 'ดำเนินการสำเร็จ',
            ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json([
                'status' => 'error',
                'result' => 'ไม่สามารถดำเนินการได้',
            ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
        }
    }

    public function removeEditDetail(Request $request)
    {
        $orderRemove = EditDetail::where('id', $request->id)->delete();
        if ($orderRemove) {
            return response()->json([
                'status' => 'success',
                'result' => 'ดำเนินการสำเร็จ',
            ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json([
                'status' => 'error',
                'result' => 'ไม่สามารถดำเนินการได้',
            ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
        }
    }

    public function fetchProductImage(Request $request)
    {
        $productCode = $request->product_code;

        $productImages = ProductImage::where('product_code', $productCode)->get();
        return response()->json([
            'status' => 'success',
            'result' => $productImages,
        ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
    }
}
