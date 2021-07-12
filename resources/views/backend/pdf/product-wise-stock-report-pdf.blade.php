<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Product Wise Stock Report Pdf</title>
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
              <td></td>
              <td style="text-align: center;"><u><strong><span style="font-size: 16px;">Product Wise Stock Report</span></strong></u></td>
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
                <th>Supplier Name</th>
                <th>Category</th>
                <th>Product Name</th>
                <th>In.Qty</th>
                <th>Out.Qty</th>
                <th>Stock</th>
                <th>Unit</th>
              </tr>
              </thead>
              <tbody>
                @php
                  $buying_total = App\Model\Purchase::where('category_id',$product->category_id)->where('product_id',$product->id)->where('status',1)->sum('buying_qty');
                  $selling_total = App\Model\InvoiceDetail::where('category_id',$product->category_id)->where('product_id',$product->id)->where('status',1)->sum('selling_qty');
                @endphp
                <tr>
                    <td>{{ $product['supplier']['name'] }}</td>
                    <td>{{ $product['category']['name'] }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $buying_total }}</td>
                    <td>{{ $selling_total }}</td>
                    <td style="text-align: center;">{{ $product->quantity }}</td>
                    <td style="text-align: center;">{{ $product['unit']['name'] }}</td>
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