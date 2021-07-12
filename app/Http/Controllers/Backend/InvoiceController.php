<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Supplier;
use App\Model\Unit;
use App\Model\Category;
use App\Model\Purchase;
use App\Model\Invoice;
use App\Model\InvoiceDetail;
use App\Model\Payment;
use App\Model\PaymentDetail;
use App\Model\Customer;
use Auth;
use Session;
use DB;
use PDF;

class InvoiceController extends Controller
{
    public function view()
    {
    	Session::put('page', 'invoice');
    	$alldata = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->get();
    	//dd($alldata->toArray());
    	return view('backend.invoice.view-invoice')->with(compact('alldata'));
    }
    public function add()
    {
    	$categories = Category::all();
    	$customers = Customer::all();
    	$invoice_number = Invoice::orderBy('id','desc')->first();
    	$date = date('Y-m-d');
    	if ($invoice_number==null) {
    		$firstReg = '0';
    		$invoice = $firstReg+1;
    	}
    	else {
    		$invoice_number = Invoice::orderBy('id','desc')->first()->invoice_no;
    		$invoice = $invoice_number+1;
    	}
    	return view('backend.invoice.add-invoice')->with(compact('categories','invoice','customers','date'));
    }
    public function store(Request $request)
    {
    	if ($request->category_id == null) {
    		return redirect()->back()->with('error_message','Sorry! You do not select any item');
    	}
    	else{
    		if ($request->paid_amount > $request->estimated_amount) {
    			return redirect()->back()->with('error_message','Sorry! paid amount is maximum than total price');
    		}
    		else{
    			$invoice = new Invoice;
    			$invoice->invoice_no = $request->invoice_no;
    			$invoice->date = date('Y-m-d',strtotime($request->date));
    			$invoice->description = $request->description;
    			$invoice->status = '0';
    			$invoice->created_by = Auth::user()->id;

    			DB::transaction(function() use($request,$invoice){
                   if ($invoice->save()) {
                   	  $count_category = count($request->category_id);
			    		for($i=0;$i<$count_category;$i++){
			    			$invoice_detail = new InvoiceDetail;
			    			$invoice_detail->date = date('Y-m-d',strtotime($request->date));
			    			$invoice_detail->invoice_id = $invoice->id;
			    			$invoice_detail->category_id = $request->category_id[$i];
			    			$invoice_detail->product_id = $request->product_id[$i];
			    			$invoice_detail->selling_qty = $request->selling_qty[$i];
			    			$invoice_detail->unit_price = $request->unit_price[$i];
			    			$invoice_detail->selling_price = $request->selling_price[$i];
			    			$invoice_detail->status = '0';
			    			$invoice_detail->save();
			    		}
			    		if ($request->customer_id == '0') {
			    			$customer = new Customer;
			    			$customer->name = $request->name;
			    			$customer->mobile_no = $request->mobile_no;
			    			$customer->address = $request->address;
			    			$customer->save();
			    			$customer_id = $customer->id;
			    		}
			    		else{
			    			$customer_id = $request->customer_id;
			    		}
			    		$payment = new Payment;
			    		$payment_detail = new PaymentDetail;
			    		$payment->invoice_id = $invoice->id;
			    		$payment->customer_id = $customer_id;
			    		$payment->paid_status = $request->paid_status;
			    		$payment->total_amount = $request->estimated_amount;
			    		$payment->discount_amount = $request->discount_amount;
			    		if ($request->paid_status == 'full_paid') {
			    			$payment->paid_amount = $request->estimated_amount;
			    			$payment->due_amount = '0';
			    			$payment_detail->current_paid_amount = $request->estimated_amount;
			    		}
			    		elseif ($request->paid_status == 'full_due') {
			    			$payment->paid_amount = '0';
			    			$payment->due_amount = $request->estimated_amount;
			    			$payment_detail->current_paid_amount = '0';
			    		}
			    		elseif ($request->paid_status == 'partial_paid') {
			    			$payment->paid_amount = $request->paid_amount;
			    			$payment->due_amount = $request->estimated_amount - $request->paid_amount;
			    			$payment_detail->current_paid_amount = $request->paid_amount;
			    		}
			    		$payment->save();
			    		$payment_detail->invoice_id = $invoice->id;
			    		$payment_detail->date = date('Y-m-d',strtotime($request->date));
			    		$payment_detail->updated_by = Auth::user()->id;
			    		$payment_detail->save();
                   }
    			});
    		}
    		
    		return redirect()->route('invoice.pending.list')->with('success_message','Data inserted successfully');
    	}
    }

    public function delete($id)
    {
    	$invoice = Invoice::find($id);
    	$invoice->delete();
    	InvoiceDetail::where('invoice_id',$invoice->id)->delete();
    	Payment::where('invoice_id',$invoice->id)->delete();
    	PaymentDetail::where('invoice_id',$invoice->id)->delete();
    	$message = "Data deleted successfully";
    	return redirect()->route('invoice.pending.list')->with('success_message',$message);
    }
    public function invoicependinglist()
    {
    	Session::put('page', 'approve_invoice');
    	$alldata = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
    	//dd($alldata->toArray());
    	return view('backend.invoice.pending-invoice-list')->with(compact('alldata'));
    }
    public function approve($id)
    {
    	$invoice = Invoice::with('invoice_details')->find($id);
    	//dd($invoice->toArray());
    	$payment = Payment::where('invoice_id',$invoice->id)->first();
    	return view('backend.invoice.invoice-approve')->with(compact('invoice','payment'));
    }
    public function approvestore(Request $request,$id)
    {
    	foreach ($request->selling_qty as $key => $value) {
    		$invoice_details = InvoiceDetail::where('id',$key)->first();
    		$product = Product::where('id',$invoice_details->product_id)->first();
    		if ($product->quantity < $request->selling_qty[$key]) {
    			return redirect()->back()->with('error_message','Sorry! You approve maximum value');
    		}
    	}
    	$invoice = Invoice::find($id);
    	$invoice->approved_by = Auth::user()->id;
    	$invoice->status = '1';
    	DB::transaction(function() use($request,$invoice,$id){
             foreach ($request->selling_qty as $key => $value) {
             	$invoice_details = InvoiceDetail::where('id',$key)->first();
                $invoice_details->status = '1';
                $invoice_details->save();
                $product = Product::where('id',$invoice_details->product_id)->first();
                $product->quantity = ((float)$product->quantity - (float)$request->selling_qty[$key]);
                $product->save();
             }
             $invoice->save();
    	});
    	return redirect()->route('invoice.pending.list')->with('success_message','Invoice Successfully Approved');
    }
    public function printinvoicelist()
    {
        Session::put('page', 'print_invoice');
        $alldata = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->get();
        return view('backend.invoice.pos-invoice-list')->with(compact('alldata'));
    }
    function printinvoice($id) {
        $data['invoice'] = Invoice::with('invoice_details')->find($id);
        $pdf = PDF::loadView('backend.pdf.invoice-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    public function dailyreport()
    {
        Session::put('page', 'daily_invoice'); 
        return view('backend.invoice.daily-invoice-report');
    }
    public function dailyinvoicereport(Request $request)
    {
        
        $sdate = date('Y-m-d', strtotime($request->start_date));
        $edate = date('Y-m-d', strtotime($request->end_date));
        $data['alldata'] = Invoice::whereBetween('date',[$sdate,$edate])->where('status',1)->get();
        $data['sdate'] = date('Y-m-d', strtotime($request->start_date));
        $data['edate'] = date('Y-m-d', strtotime($request->end_date));
        $pdf = PDF::loadView('backend.pdf.daily-invoice-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
