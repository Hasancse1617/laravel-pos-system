<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Invoice Pdf Deatails</title>
  <link rel="stylesheet" href="{{ asset('public/backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
	<link rel="stylesheet" href="">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<table width="100%"  class="table">
            <tbody>
            <tr>
              <td><strong>Invoice No: #  {{$payment['invoice']['invoice_no']}}</strong></td>
              <td><span style="font-size: 20px;background-color: #1781BF; padding: 3px 10px 3px 10px; color: #fff;">Humaira Shopping Mall</span> <br>Gorgory, Pabna</td>
              <td>
                <span>
                  Showroom : 01923456789 <br>
                  Owner No : 01345923832
              </span>
            </td>
            </tr>
            </tbody>
         </table>
			</div>										
		</div>
    <div class="row">
      <div class="col-md-12">
        <hr style="margin-bottom: 0px;">
        <table width="100%">
            <tbody>
            <tr>
              <td></td>
              <td style="text-align: center;"><u><strong><span style="font-size: 16px;">Customer Invoice Details</span></strong></u></td>
              <td></td>
            </tr>
            </tbody>
         </table>

      </div>                    
    </div>
    <div class="row">
      <div class="col-md-12">
         <table width="100%">
            <tbody>
            <tr><td colspan="3"><strong>Customer Info</strong></td></tr>
            <tr>
              <td width="30%"><strong>Name : </strong> {{$payment['customer']['name']}}</td>
              <td width="30%"><strong>Mobile:</strong> {{$payment['customer']['mobile_no']}}</td>
              <td width="40%"><strong>Address:</strong> {{$payment['customer']['address']}}</td>
            </tr>
            </tbody>
         </table>
      </div>                    
    </div>
    <div class="row">
      <div class="col-md-12">
         <table border="1" width="100%" style="margin-bottom: 10px"  class="table table-dark">
          <thead>
          <tr class="text-center">
            <th>SL.</th>
            <th>Category</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Total Price</th>
          </tr>
          </thead>
          <tbody>
            @php
              $total_sum = '0';
              $invoice_details = App\Model\InvoiceDetail::where('invoice_id',$payment->invoice_id)->get();
            @endphp
            @foreach($invoice_details as $key=>$details)
            <tr>
              <td style="text-align: center;">{{ $key+1 }}</td>
              <td style="text-align: center;">{{ $details['category']['name'] }}</td>
              <td style="text-align: center;">{{ $details['product']['name'] }}</td>
              <td style="text-align: center;">{{ $details->selling_qty }}</td>
              <td style="text-align: center;">{{ $details->unit_price }}</td>
              <td style="text-align: center;">{{ $details->selling_price }}</td>
            </tr>
            @php
              $total_sum += $details->selling_price;
            @endphp
            @endforeach
            <tr>
              <td colspan="5" style="text-align: right;"><strong>Sub Total</strong> &nbsp;</td>
              <td style="text-align: center;"><strong>{{ $total_sum }}</strong></td>
            </tr>
            <tr>
              <td colspan="5" style="text-align: right;">Discount &nbsp;</td>
              <td style="text-align: center;"><strong>{{ $payment->discount_amount }}</strong></td>
            </tr>
            <tr>
              <td colspan="5" style="text-align: right;">Paid Amount &nbsp;</td>
              <td style="text-align: center;"><strong>{{ $payment->paid_amount }}</strong></td>
            </tr>
            <tr>
              <input type="hidden" name="new_paid_amount" value="{{ $payment->due_amount }}">
              <td colspan="5" style="text-align: right;">Due Amount &nbsp;</td>
              <td style="text-align: center;"><strong>{{ $payment->due_amount }}</strong></td>
            </tr>
            <tr>
              <td colspan="5" style="text-align: right;" class="text-right"><strong>Grand Total</strong> &nbsp;</td>
              <td style="text-align: center;"><strong>{{ $payment->total_amount }}</strong></td>
            </tr>
            <tr>
            	<td colspan="6" style="text-align: center;font-weight: bold;">Paid Summery</td>
            </tr>
            <tr>
            	<td colspan="3" style="text-align: center;"><strong>Date</strong></td>
            	<td colspan="3" style="text-align: center;"><strong>Amount</strong></td>
            </tr>
            @php
               $paymentdetails = App\Model\PaymentDetail::where('invoice_id',$payment->invoice_id)->get();
            @endphp
            @foreach($paymentdetails as $detail)
             <tr>
            	<td colspan="3" style="text-align: center;">{{ date('d-m-Y',strtotime($detail->date)) }}</td>
            	<td colspan="3" style="text-align: center;">{{ $detail->current_paid_amount }}</td>
            </tr>
            @endforeach
          </tbody>
       </table>
       @php
         $date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
       @endphp
          <i>Printing Time : {{ $date->format('F j, Y, g:i a') }}</i>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <hr style="margin-bottom: 0px;">
        <table border="0" width="100%">
          <tbody>
            <tr>
              <td style="width: 40%;">
                <p style="text-align: center;margin-left: 20px;">Customer Signature</p>
              </td>
              <td style="width: 20%;"></td>
              <td style="width: 40%; text-align: center;">
                <p style="text-align: center;margin-left: 20px;">Seller Signature</p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>  
	</div>
  <script src="{{ asset('public/backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>