<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Supplier;
use App\Model\Unit;
use App\Model\Category;
use App\Model\Purchase;
use Auth;
use Session;
use DB;
use PDF;

class PurchaseController extends Controller
{
    public function view()
    {
    	Session::put('page', 'purchase');
    	$alldata = Purchase::orderBy('date','desc')->orderBy('id','desc')->get();
    	//dd($alldata->toArray());
    	return view('backend.purchase.view-purchase')->with(compact('alldata'));
    }
    public function add()
    {
    	$suppliers = Supplier::all();
    	$categories = Category::all();
    	$units = Unit::all();
    	return view('backend.purchase.add-purchase')->with(compact('suppliers','categories','units'));
    }
    public function store(Request $request)
    {
    	if ($request->category_id == null) {
    		return redirect()->back()->with('error_message','Sorry! You do not select any item');
    	}
    	else{
    		$count_category = count($request->category_id);
    		for($i=0;$i<$count_category;$i++){
    			$purchase = new Purchase;
    			$purchase->date = date('Y-m-d',strtotime($request->date[$i]));
    			$purchase->purchase_no = $request->purchase_no[$i];
    			$purchase->supplier_id = $request->supplier_id[$i];
    			$purchase->category_id = $request->category_id[$i];
    			$purchase->product_id = $request->product_id[$i];
    			$purchase->buying_qty = $request->buying_qty[$i];
    			$purchase->unit_price = $request->unit_price[$i];
    			$purchase->buying_price = $request->buying_price[$i];
    			$purchase->description = $request->description[$i];
    			$purchase->created_by = Auth::user()->id;
    			$purchase->status = '0';
    			$purchase->save();
    		}
    		return redirect()->route('purchase.view')->with('success_message','Data inserted successfully');
    	}
    }

    public function delete($id)
    {
    	$product = Purchase::find($id);
    	$product->delete();
    	$message = "Data deleted successfully";
    	return redirect()->route('purchase.view')->with('success_message',$message);
    }
    public function pendinglist()
    {
    	Session::put('page', 'approve_purchase');
    	$alldata = Purchase::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
    	//dd($alldata->toArray());
    	return view('backend.purchase.view-pending-list')->with(compact('alldata'));
    }
    public function approve($id)
    {
    	$purchase = Purchase::find($id);
    	$product = Product::where('id',$purchase->product_id)->first();
    	$purchase_qty = ((float)($purchase->buying_qty)) + ((float)($product->quantity));
    	$product->quantity = $purchase_qty;
    	if ($product->save()) {
    		DB::table('purchases')
    		    ->where('id', $id)
    		    ->update(['status'=>1]);
    	}
    	return redirect()->route('purchase.pending.list')->with('success_message','Data approved successfully');
    }
    public function purchaseReport()
    {
        Session::put('page', 'daily_purchase');
        return view('backend.purchase.purchase-report'); 
    }
    public function purchaseReportPdf(Request $request)
    {
        $sdate = date('Y-m-d', strtotime($request->start_date));
        $edate = date('Y-m-d', strtotime($request->end_date));
        $data['alldata'] = Purchase::whereBetween('date',[$sdate,$edate])->where('status',1)->get();
        $data['sdate'] = date('Y-m-d', strtotime($request->start_date));
        $data['edate'] = date('Y-m-d', strtotime($request->end_date));
        $pdf = PDF::loadView('backend.pdf.daily-purchase-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
