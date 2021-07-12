<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Supplier;
use App\Model\Unit;
use App\Model\Category;
use Auth;
use Session;

class ProductController extends Controller
{
    public function view()
    {
    	Session::put('page', 'products');
    	$alldata = Product::all();
    	//dd($alldata->toArray());
    	return view('backend.product.view-product')->with(compact('alldata'));
    }
    public function add()
    {
    	$suppliers = Supplier::all();
    	$categories = Category::all();
    	$units = Unit::all();
    	return view('backend.product.add-product')->with(compact('suppliers','categories','units'));
    }
    public function store(Request $request)
    {
    	$this->validate($request,[
            'name'=>'required',
            'supplier_id'=>'required',
            'category_id'=>'required',
            'unit_id'=>'required',
    	]);
    	$data = new Product;
    	$data->supplier_id = $request->supplier_id;
    	$data->category_id = $request->category_id;
    	$data->name = $request->name;
    	$data->unit_id = $request->unit_id;
    	$data->created_by = Auth::user()->id;
    	$data->save();
    	$message = "Data inserted successfully";
    	return redirect()->route('products.view')->with('success_message',$message);
    }
    public function edit($id)
    {
    	$suppliers = Supplier::all();
    	$categories = Category::all();
    	$units = Unit::all();
    	$editdata = Product::find($id);
    	return view('backend.product.edit-product')->with(compact('editdata','suppliers','categories','units'));
    }
    public function update(Request $request, $id)
    {
    	$this->validate($request,[
            'name'=>'required',
            'supplier_id'=>'required',
            'category_id'=>'required',
            'unit_id'=>'required',
    	]);
    	$data = Product::find($id);
    	$data->supplier_id = $request->supplier_id;
    	$data->category_id = $request->category_id;
    	$data->name = $request->name;
    	$data->unit_id = $request->unit_id;
    	$data->updated_by = Auth::user()->id;
    	$data->save();
    	$message = "Data updated successfully";
    	return redirect()->route('products.view')->with('success_message',$message);
    }
    public function delete($id)
    {
    	$product = Product::find($id);
    	$product->delete();
    	$message = "Data deleted successfully";
    	return redirect()->route('products.view')->with('success_message',$message);
    }
}
