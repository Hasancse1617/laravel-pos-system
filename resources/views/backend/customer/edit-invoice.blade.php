 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Credit Customer</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Customer</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">
            @if(Session::has('error_message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ Session::get('error_message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
             @endif
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3>
                  Edit Invoice (Invoice No # {{$payment['invoice']['invoice_no']}})
                  <a href="{{ route('customers.credit') }}" class="btn btn-success float-right"><i class="fas fa-list"></i>&nbsp;Credit Customer List</a>
                </h3>
              </div>
              <div class="card-body">
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
		         <form action="{{ route('customers.update.invoice',$payment->invoice_id) }}" method="post" id="addForm">
			         @csrf
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
			          </tbody>
			       </table>
			       <div class="row">
			       	   <div class="form-group col-md-3">
		  				<label>Paid Status</label>
		  				<select name="paid_status" id="paid_status" class="form-control form-control-sm">
		  					<option value="">Select Status</option>
		  					<option value="full_paid">Full Paid</option>
		  					<option value="partial_paid">Partial Paid</option>
		  				</select>
		  				<input type="text" name="paid_amount" class="form-control form-control-sm paid_amount" placeholder="Enter Paid Amount" style="display: none;">
		  			</div>
		  			<div class="form-group col-md-3">
		                <label>Date</label>
		                <input type="text" name="date" class="form-control form-control-sm datepicker" id="date" placeholder="YYYY-MM-DD" readonly="">
		                <font class="date_msg" style="color: red"></font>
		            </div>
		            <div class="form-group col-md-3">
		            	<button type="submit" class="btn btn-success btn-sm" style="margin-top: 32px;">Update Invoice</button>
		            </div>
			       </div>
		      </form>
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>
  </div>
  <script type="text/javascript">
 	$(document).on('change','#paid_status',function(){
       $paid_status = $(this).val();
       if ($paid_status=='partial_paid') {
       	 $('.paid_amount').show();
       }
       else{
       	 $('.paid_amount').hide();
       }
 	});
 </script>
 <script type="text/javascript">
	$('.datepicker').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'yyyy-mm-dd'
	})
</script>
 <script type="text/javascript">
	$(document).ready(function () {
	  $('#addForm').validate({
	    rules: {
	      date: {
	        required: true,
	      },
	      paid_status: {
	        required: true,
	      }
	    },
	    messages: {
	      
	    },
	    errorElement: 'span',
	    errorPlacement: function (error, element) {
	      error.addClass('invalid-feedback');
	      element.closest('.form-group').append(error);
	    },
	    highlight: function (element, errorClass, validClass) {
	      $(element).addClass('is-invalid');
	    },
	    unhighlight: function (element, errorClass, validClass) {
	      $(element).removeClass('is-invalid');
	    }
	  });
	});
</script>
@endsection