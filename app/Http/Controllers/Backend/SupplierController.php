<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Supplier;
use Auth;
use Session;

class SupplierController extends Controller
{
    public function view()
    {
    	Session::put('page', 'suppliers');
    	$alldata = Supplier::all();
    	return view('backend.supplier.view-supplier')->with(compact('alldata'));
    }
    public function add()
    {
    	return view('backend.supplier.add-supplier');
    }
    public function store(Request $request)
    {
    	$data = new Supplier;
    	$data->name = $request->name;
    	$data->mobile_no = $request->mobile_no;
    	$data->email = $request->email;
    	$data->address = $request->address;
    	$data->created_by = Auth::user()->id;
    	$data->save();
    	$message = "Data inserted successfully";
    	return redirect()->route('suppliers.view')->with('success_message',$message);
    }
    public function edit($id)
    {
    	$editdata = Supplier::find($id);
    	return view('backend.supplier.edit-supplier')->with(compact('editdata'));
    }
    public function update(Request $request, $id)
    {
    	$data = Supplier::find($id);
    	$data->name = $request->name;
    	$data->mobile_no = $request->mobile_no;
    	$data->email = $request->email;
    	$data->address = $request->address;
    	$data->updated_by = Auth::user()->id;
    	$data->save();
    	$message = "Data updated successfully";
    	return redirect()->route('suppliers.view')->with('success_message',$message);
    }
    public function delete($id)
    {
    	$supplier = Supplier::find($id);
    	$supplier->delete();
    	$message = "Data deleted successfully";
    	return redirect()->route('suppliers.view')->with('success_message',$message);
    }
}
