<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;

class DefaultController extends Controller
{
    public function getcategory(Request $request)
    {
    	$supplier_id = $request->supplier_id;
    	$allcategory = Product::with('category')->select('category_id')->where('supplier_id',$supplier_id)->groupBy('category_id')->get();
    	//dd($allcategory->toArray());
    	return response()->json($allcategory);
    }
    public function getproduct(Request $request)
    {
    	$category_id = $request->category_id;
    	$allproduct = Product::where('category_id',$category_id)->get();
    	//($allproduct->toArray());
    	return response()->json($allproduct);
    }
    public function getstock(Request $request)
    {
        $product_id = $request->product_id;
        $stock = Product::where('id',$product_id)->first()->quantity;
        return response()->json($stock);
    }
}
