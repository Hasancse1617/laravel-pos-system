<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Customer;
use Auth;
use Session;
use PDF;
use App\Model\Payment;
use App\Model\PaymentDetail;

class CustomerController extends Controller
{
    public function view()
    {
    	Session::put('page', 'customers');
    	$alldata = Customer::all();
    	return view('backend.customer.view-customer')->with(compact('alldata'));
    }
    public function add()
    {
    	return view('backend.customer.add-customer');
    }
    public function store(Request $request)
    {
    	$this->validate($request,[
            'name'=>'required',
            'mobile_no'=>'required',
            'address'=>'required'
    	]);
    	$data = new Customer;
    	$data->name = $request->name;
    	$data->mobile_no = $request->mobile_no;
    	$data->email = $request->email;
    	$data->address = $request->address;
    	$data->created_by = Auth::user()->id;
    	$data->save();
    	$message = "Data inserted successfully";
    	return redirect()->route('customers.view')->with('success_message',$message);
    }
    public function edit($id)
    {
    	$editdata = Customer::find($id);
    	return view('backend.customer.edit-customer')->with(compact('editdata'));
    }
    public function update(Request $request, $id)
    {
    	$this->validate($request,[
            'name'=>'required',
            'mobile_no'=>'required',
            'address'=>'required'
    	]);
    	$data = Customer::find($id);
    	$data->name = $request->name;
    	$data->mobile_no = $request->mobile_no;
    	$data->email = $request->email;
    	$data->address = $request->address;
    	$data->updated_by = Auth::user()->id;
    	$data->save();
    	$message = "Data updated successfully";
    	return redirect()->route('customers.view')->with('success_message',$message);
    }
    public function delete($id)
    {
    	$customer = Customer::find($id);
    	$customer->delete();
    	$message = "Data deleted successfully";
    	return redirect()->route('customers.view')->with('success_message',$message);
    }
    public function creditCustomer()
    {
        Session::put('page', 'credit_customers');
        $alldata = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
        //dd($alldata->toArray());
        return view('backend.customer.credit-customer')->with(compact('alldata'));
    }
    public function creditCustomerPdf()
    {
        $data['alldata'] = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
        $pdf = PDF::loadView('backend.pdf.customer-credit-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    public function editInvoice($invoice_id)
    {
        $payment = Payment::where('invoice_id',$invoice_id)->first();
        return view('backend.customer.edit-invoice')->with(compact('payment'));
    }
    public function updateInvoice(Request $request,$invoice_id)
    {
        if ($request->new_paid_amount < $request->paid_amount) {
            return redirect()->back()->with('error_message','Sorry! You have paid maximum value');
        }
        else{
            $payment = Payment::where('invoice_id',$invoice_id)->first();
            $paymentDetails = new PaymentDetail();
            $payment->paid_status = $request->paid_status;
            if ($request->paid_status == 'full_paid') {
                $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount'] + $request->new_paid_amount;
                $payment->due_amount = '0';
                $paymentDetails->current_paid_amount = $request->new_paid_amount;
            }
            elseif($request->paid_status == 'partial_paid'){
               $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount'] + $request->paid_amount;
               $payment->due_amount = Payment::where('invoice_id',$invoice_id)->first()['due_amount'] - $request->paid_amount;
               $paymentDetails->current_paid_amount = $request->paid_amount;
            }
            $payment->save();
            $paymentDetails->invoice_id = $invoice_id;
            $paymentDetails->date = date('Y-m-d',strtotime($request->date));
            $paymentDetails->updated_by = Auth::user()->id;
            $paymentDetails->save();
            return redirect()->route('customers.credit')->with('success_message','Invoice updated successfully');
        }
    }
    public function invoiceDetailsPdf($invoice_id)
    {
        $data['payment'] = Payment::where('invoice_id',$invoice_id)->first();
        $pdf = PDF::loadView('backend.pdf.invoice-details-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    // Paid Customer Route
    public function paidCustomer()
    {
        Session::put('page', 'paid_customers');
        $alldata = Payment::whereIn('paid_status',['full_paid','partial_paid'])->get();
        //dd($alldata->toArray());
        return view('backend.customer.paid-customer')->with(compact('alldata'));
    }
    public function paidCustomerPdf()
    {
        $data['alldata'] = Payment::whereIn('paid_status',['full_paid','partial_paid'])->get();
        $pdf = PDF::loadView('backend.pdf.customer-paid-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    public function customerWiseReport()
    {
        Session::put('page', 'customer_wise_report');
        $customers = Customer::all();
        return view('backend.customer.customer-wise-report')->with(compact('customers'));
    }
    public function customerWiseCredit(Request $request)
    {
        $data['alldata'] = Payment::where('customer_id',$request->customer_id)->whereIn('paid_status',['full_due','partial_paid'])->get();
        $pdf = PDF::loadView('backend.pdf.customer-wise-credit-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    public function customerWisePaid(Request $request)
    {
        $data['alldata'] = Payment::where('customer_id',$request->customer_id)->whereIn('paid_status',['full_paid','partial_paid'])->get();
        $pdf = PDF::loadView('backend.pdf.customer-wise-paid-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
