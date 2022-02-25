<?php

namespace App\Http\Controllers;

use App\Customer;
use App\EditDetail;
use App\OrderList;
use App\OrderStatus;
use App\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\OrderTrack;

class HomeController extends Controller
{

    public function index()
    {
        if(Auth::check()) return redirect('/home');
        return view('index');
    }

    public function home()
    {
        if(!Auth::check()) return redirect('/');
        return view('home');
    }

    public function order(Request $request) {

        if(!Auth::check()) return redirect('/');

        $startAt = $request->startAt;
        $endAt = $request->endAt;
        $orderId = $request->order_id;
        $customerName = $request->customer_name;
        $facebookName = $request->facebook_name;
        $productCode = $request->product_code;
        $deliveryStatus = $request->delivery_status;
        $printStatus = $request->print_status;
        $orderCompleted = $request->order_completed;

        $deli_startDate = $request->deli_startDate;
        $deli_endDate = $request->deli_endDate;

        $print_startDate = $request->print_startDate;
        $print_endDate = $request->print_endDate;

        $delivery_startDate = $request->delivery_startDate;
        $delivery_endDate = $request->delivery_endDate;

        $printCheck  = $request->print_check;
        $deliveryCheck = $request->delivery_check;

        $current = Carbon::now();

        if($startAt && $endAt)
        {
            $orderLists = OrderList::select("order_lists.*")->whereBetween('order_date', [$startAt ? Carbon::parse($startAt)->format('Y-m-d') : $current->format('Y-m-d'), $endAt ? Carbon::parse($endAt)->format('Y-m-d') : $current->format('Y-m-d')])->orderBy('order_lists.id', 'asc');
        } else {
            $orderLists = OrderList::select("order_lists.*")->orderBy('order_lists.id', 'asc');
        }

        if($orderId) {
            $orderLists->where('order_number', 'like', '%'.$orderId.'%');
        }

        if($customerName) {
            $orderLists->where('customer_name', 'like', '%'.$customerName.'%');
        }

        if($facebookName) {
            $orderLists->where('facebook_name', 'like', '%'.$facebookName.'%');
        }

        if($productCode) {
            $orderLists->where('product_code', 'like', '%'.$productCode.'%');
        }

        if ($deliveryStatus == "0" || $deliveryStatus == "1") {
            $orderLists->where('deliveried', '=', $deliveryStatus);
            
            if($deliveryCheck == "true") {
                $orderLists->join('delivery_prints', 'delivery_prints.order_id', '=', 'order_lists.id')->whereBetween('delivery_prints.created_at', [Carbon::parse($delivery_startDate)->format('Y-m-d') . " 00:00:00", Carbon::parse($delivery_endDate)->format('Y-m-d') . " 23:59:59"]);
            }
        }

        if ($printStatus == "0" || $printStatus == "1") {
            $orderLists->where('printed', '=', $printStatus);
            if($printCheck == "true") {
                $orderLists->join('work_prints', 'work_prints.order_id', '=', 'order_lists.id')->whereBetween('work_prints.created_at', [Carbon::parse($print_startDate)->format('Y-m-d') . " 00:00:00", Carbon::parse($print_endDate)->format('Y-m-d') . " 23:59:59"]);
            }
        }

        if ($orderCompleted == "0" || $orderCompleted == "1") {
            $orderLists->where('order_completed', '=', $orderCompleted);
            if($deli_startDate && $deli_endDate) {

                $deli_startDate = Carbon::parse($deli_startDate)->format('Y-m-d');
                $deli_endDate = Carbon::parse($deli_endDate)->format('Y-m-d');

                #return Carbon::parse($request->deli_startDate)->format('Y-m-d h:i:s')." ". Carbon::parse($request->deli_endDate)->format('Y-m-d h:i:s');

                if($orderCompleted == "1") {
                    $orderLists->join('order_statuses', 'order_statuses.order_id', '=', 'order_lists.id')->where('order_statuses.status', '=', 'shipped')->whereBetween('order_statuses.created_at', [Carbon::parse($deli_startDate)->format('Y-m-d') . " 00:00:00", Carbon::parse($deli_endDate)->format('Y-m-d') . " 23:59:59"]);
                } else {
                    $orderLists->join('order_statuses', 'order_statuses.order_id', '=', 'order_lists.id')->where('order_statuses.status', '!=', 'shipped')->whereBetween('order_statuses.created_at', [Carbon::parse($deli_startDate)->format('Y-m-d') . " 00:00:00", Carbon::parse($deli_endDate)->format('Y-m-d') . " 23:59:59"]);
                }
            }
        }

        $result = $orderLists->paginate(50)->onEachSide(1)->appends(request()->query());
        return view('order', compact(
            'result', 
            'current', 
            'startAt', 
            'endAt', 
            'orderId', 
            'customerName', 
            'facebookName', 
            'productCode', 
            'deliveryStatus', 
            'printStatus', 
            'orderCompleted',
            'deli_startDate', 
            'deli_endDate',
            'print_startDate',
            'print_endDate',
            'delivery_startDate',
            'delivery_endDate',
            'printCheck',
            'deliveryCheck',
        ));
    }

    public function upload() {

        if(!Auth::check()) return redirect('/');

        return view('upload');
    }

    public function addProduct() {

        if(!Auth::check()) return redirect('/');

        return view('productadd');
    }

    public function addCustomer() {

        if(!Auth::check()) return redirect('/');

        return view('customeradd');
    }

    public function addProductImage() {

        if(!Auth::check()) return redirect('/');

        $products = OrderList::getProducts();
        $productsCode = Product::get();
        

        return view('productimageadd', compact('products', 'productsCode'));
    }

    public function addOrder() {

        if(!Auth::check()) return redirect('/');

        $products = OrderList::getProducts();
		$productsm = Product::get();
        $customers = Customer::get();
        $users = OrderList::select('facebook_name', 'customer_name')->distinct()->get();

        return view('orderadd', compact('products', 'customers', 'users', 'productsm'));
    }


    public function updateOrderProcess(Request $request) {
        $order_id = $request->order_id;
        $order = OrderList::where('id', $order_id)->first();

        if($order) {
			
			if($request->order_process_status == 'pending') {
				OrderList::where('id', $order_id)->update(['deliveried' => 0, 'order_completed' => 0, 'printed' => 0]);
                OrderTrack::where('order_id', $order_id)->delete();
                OrderStatus::where('order_id', $order_id)->delete();
			}

            if ($request->order_process_status == 'shipped') {
                OrderList::where('id', $order_id)->update(['order_completed' => 1, 'printed' => 1, 'deliveried' => 1]);
            }

            if ($request->order_process_status != 'shipped') {
                OrderList::where('id', $order_id)->update(['order_completed' =>0 ]);
            }

            $orderStatus = OrderStatus::updateOrCreate([
                'order_id' => $order_id,
                'status' => $request->order_process_status
            ]);
            
            $orderTrack = OrderTrack::create([
                'order_id' => $order_id,
                'employee' => $request->employee_name,
                'employee_id' => $request->employee,
                'status' => $request->order_process_status
            ]);

            $curl = curl_init();

            $userId = Customer::where('facebook_name', $order->facebook_name)->first();

            if($userId->line_id) {
                $payload = '{
                    "to": "' . $userId->line_id . '",
                    "messages":[
                        {
                            "type":"flex",
                            "sender":{
                                "name":"ข้อความอัตโนมัติ",
                                "iconUrl":"https://order.chapayom.com/images/pack.jpeg"
                            },
                            "altText":"อัพเดทความคืบหน้าสินค้า #'.$order_id. '",
                            "contents": {
                                "type": "bubble",
                                "body": {
                                    "type": "box",
                                    "layout": "vertical",
                                    "contents": [
                                    {
                                        "type": "image",
                                        "url": "https://order.phamaiintrend.co/images/tailor.png",
                                        "size": "30%"
                                    },
                                    {
                                        "type": "box",
                                        "layout": "vertical",
                                        "margin": "lg",
                                        "spacing": "sm",
                                        "contents": [
                                        {
                                            "type": "text",
                                            "text": "สินค้า #'.$order_id. '",
                                            "size": "14px",
                                            "weight": "bold"
                                        },
                                        {
                                            "type": "text",
                                            "text": "'.$order->detail.'",
                                            "size": "14px",
                                            "wrap": true,
                                            "color": "#5F5F5F"
                                        }
                                        ]
                                    },
                                    {
                                        "type": "box",
                                        "layout": "horizontal",
                                        "contents": [
                                        {
                                            "type": "text",
                                            "text": "สถานะ",
                                            "size": "14px"
                                        },
                                        {
                                            "type": "text",
                                            "text": "'.OrderStatus::getOrderStatus($request->order_process_status).'",
                                            "size": "14px"
                                        }
                                        ],
                                        "paddingTop": "lg"
                                    },
                                    {
                                        "type": "box",
                                        "layout": "horizontal",
                                        "contents": [
                                        {
                                            "type": "text",
                                            "text": "โดย '.$request->employee_name.'",
                                            "size": "14px",
                                            "weight": "bold"
                                        }
                                        ],
                                        "paddingTop": "xs"
                                    }
                                    ]
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
                curl_close($curl);
            }
            
            if($orderTrack && $orderStatus) {
                return response()->json([
                    'status' => 'success',
                    'result' => 'ดำเนินการสำเร็จ',
                    'detail' => $order->detail,
                    "product_code" => $order_id
                ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
            }else {
                return response()->json([
                    'status' => 'error',
                    'result' => 'ไม่สามารถดำเนินการได้',
                ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
            }
        }
        else {
            return response()->json([
                    'status' => 'error',
                    'result' => 'ไม่สามารถดำเนินการได้',
                ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
        }
    }

    public function checkOrder(Request $request)
    {
        $order_id = $request->order_id;
        $order = OrderList::where('id', $order_id)->first();
        $orderStatus = OrderStatus::where('order_id', $order_id)->orderBy('id', 'DESC')->first();
        $editDetails = EditDetail::where('order_id', $order_id)->get();
        $orderTrack = OrderTrack::where('order_id', $order_id)->where('status', 'cut_completed')->orderBy('id', 'DESC')->first();

            if ($order) {
                return response()->json([
                    'status' => 'success',
                    'result' => $order,
                    'order_status' => $orderStatus,
                    'edit_details' => $editDetails,
                    'last_activity' => $orderTrack
                ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json([
                    'status' => 'error',
                    'result' => 'ไม่สามารถดำเนินการได้',
                ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
            }
    }

    public function tracking(Request $request) {
        return view('tracking');
    }

    public function ordersummary(Request $request)
    {
        $customerName = $request->facebook_name;

        if (!OrderList::where('facebook_name', $request->facebook_name)->first()) {
            return redirect()->back();
        }

        $startAt = $request->startAt;
        $endAt = $request->endAt;
        $orders = OrderList::where('facebook_name', $request->facebook_name);

        if ($startAt && $endAt) {
            $orders->whereBetween('order_date', [Carbon::parse($startAt)->format('Y-m-d'), Carbon::parse($endAt)->format('Y-m-d')])->orderBy('id', 'asc');
        }

        $result = $orders->get();
        return view('ordersummary', compact('result', 'customerName', 'startAt', 'endAt'));
    }

    public function ordersummaryview(Request $request)
    {
        $customerName = $request->facebook_name;

        if (!OrderList::where('facebook_name', $request->facebook_name)->first()) {
            return redirect()->back();
        }

        $startAt = $request->startAt;
        $endAt = $request->endAt;
        $orders = OrderList::where('facebook_name', $request->facebook_name);

        if ($startAt && $endAt) {
            $orders->whereBetween('order_date', [Carbon::parse($startAt)->format('Y-m-d'), Carbon::parse($endAt)->format('Y-m-d')])->orderBy('id', 'asc');
        }

        $result = $orders->get();
        return view('ordersummarycustomerview', compact('result', 'customerName', 'startAt', 'endAt'));
    }

    public function scan(Request $request) {
        return view('scan');
    }

    public function customerEditPage(Request $request) {
        $customer = OrderList::where('facebook_name', $request->name)->first();
        return view('customeredit', compact('customer'));
    }

    public function customerEditSave(Request $request)
    {
        $customer = OrderList::where('facebook_name', $request->facebook_name)->update([
            'customer_name' => $request->real_name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
        ]);

        if($customer) {
            Customer::where('facebook_name', $request->facebook_name)->update([
                'real_name' => $request->real_name,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
            ]);
            return redirect()->back()->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
        }else {
            return redirect()->back()->with('error', 'ไม่สามารถดำเนินการได้โปรดลองใหม้อีกครั้ง');
        }
        
    }

    public function approvework(Request $request) {
        return view('approvework');
    }

    public function timeline(Request $request) {
        $order_id = $request->order_id;

        $order_detail = OrderList::where('id', $order_id)->first();
        $order_edit_details = EditDetail::where('order_id', $order_id)->get();
        $order_statuses = OrderTrack::where('order_id', $order_id)->orderBy('created_at', 'asc')->get();
        return view('timeline', compact('order_detail', 'order_edit_details', 'order_statuses'));
    }

}
