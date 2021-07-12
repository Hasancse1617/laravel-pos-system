<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Customer Wise Paid Report Pdf</title>
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
          <td><strong></td>
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
              <td style="text-align: center;"><u><strong><span style="font-size: 16px;">Customer Wise Paid Report</span></strong></u></td>
              <td></td>
            </tr>
            </tbody>
         </table>

      </div>                    
    </div>
    
    <div class="row">
      <div class="col-md-12">
        <table border="1" width="100%">
          <thead>
          <tr>
            <th>SL.</th>
            <th>Customer Name</th>
            <th>Invoice No</th>
            <th>Date</th>
            <th>Due Amount</th>
          </tr>
          </thead>
          <tbody>
          	@php
          	 $total_paid = '0';
          	@endphp
          	@foreach($alldata as $key => $value)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $value['customer']['name'] }} ({{ $value['customer']['mobile_no'] }} - {{ $value['customer']['address'] }})</td>
                <td>Invoice No #{{ $value['invoice']['invoice_no'] }}</td>
                <td>{{ date('d-m-Y',strtotime($value['invoice']['date'])) }}</td>
                <td>{{ $value->paid_amount }} TK</td>

            </tr>
            @php
          	 $total_paid += $value->paid_amount;
          	@endphp
            @endforeach
            <tr>
            	<td colspan="4" style="text-align: right;font-weight: bold;">Grand Total</td>
            	<td>{{ $total_paid }}</td>
            </tr>
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