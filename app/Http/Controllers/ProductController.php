<?php

namespace App\Http\Controllers;

use App\OrderList;
use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addProduct(Request $request) {


        $productCheck = Product::where('product_code', $request->product_code)->first();
        $orderList = OrderList::where('product_code', $request->product_code)->first();

        if($productCheck || $orderList) {
            return response()->json([
                'status' => 'warning',
                'result' => 'รหัสสินค้าหมายเลขนี้มีอยู่แล้ว',
            ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
        }

        $product = Product::create([
            'product_code' => $request->product_code, 
            'price' => $request->product_price, 
            'detail' => $request->product_detail,
        ]);

        $imageFile = time().'.'.$request->product_image->getClientOriginalExtension();
        $product_image = ProductImage::create([
            'product_code' => $request->product_code, 
            'image_url' => $imageFile
        ]);

        if($product && $product_image) {
            $request->product_image->move(base_path() . '/storage/app/public/upload', $imageFile);
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

    public function addProductImage(Request $request) {

        $imageFile = time().'.'.$request->product_image->getClientOriginalExtension();
        $product_image = ProductImage::create([
            'product_code' => $request->product, 
            'image_url' => $imageFile
        ]);

        if($product_image) {
            $request->product_image->move(base_path() . '/storage/app/public/upload', $imageFile);
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

    public function removeProductImage(Request $request) {
        $product_image = ProductImage::where('id', $request->id)->delete();
        if($product_image) {
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
