<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    //
    protected $fillable = ['product_code', 'image_url'];


    public static function getProductImageByProductCode($productCode) {
        $product = ProductImage::where('product_code', $productCode)->first();
        return $product->image_url;
    }
}
