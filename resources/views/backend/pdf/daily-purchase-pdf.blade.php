<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Daily Purchase Report</title>
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
          <td width="25%"></td>
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
              <td width="24%"></td>
              <td><u><strong><span style="font-size: 16px;">Daily Invoice Report({{date('d-m-Y',strtotime($sdate))}}-{{date('d-m-Y',strtotime($edate))}})</span></strong></u></td>
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
	            <th>Purchase No</th>
	            <th>Date</th>
	            <th>Product Name</th>
	            <th>Quantity</th>
	            <th>Unit Price</th>
	            <th>Total Price</th>
	          </tr>
	          </thead>
	          <tbody>
	          	@php
	          	  $sum = '0';
	          	@endphp
	          	@foreach($alldata as $key => $value)
	            <tr>
	                <td>{{ $key+1 }}</td>
	                <td>{{ $value->purchase_no }}</td>
	                <td>{{ date('d-m-Y',strtotime($value->date)) }}</td>
	                <td>{{ $value['product']['name'] }}</td>
	                <td>
	                	{{ $value->buying_qty }}
	                	{{ $value['product']['unit']['name'] }}
	                </td>
	                <td>{{ $value->unit_price }}</td>
	                <td>{{ $value->buying_price }}</td>
	            </tr>
	            @php
	          	  $sum  += $value->buying_price;
	          	@endphp
	            @endforeach
	            <tr>
	            	<td colspan="6" style="text-align: right"><strong>Grand Total&nbsp;</strong></td>
	            	<td>{{ $sum }}</td>
	            </tr>
	         </tbody>
	       </table>
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
                <p style="text-align: center;border-bottom: 1px solid #000;">Owner Signature</p>
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