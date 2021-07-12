 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Customer Wise Report</h1>
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
            @if(Session::has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ Session::get('success_message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
             @endif
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3>
                  Select Criteria
                  <!-- <a href="{{ route('stock.report.pdf') }}" target="_blank" class="btn btn-success float-right"><i class="fas fa-download"></i>&nbsp;Download PDF</a> -->
                </h3>
              </div>
              <div class="card-body">
                 <div class="row">
                 	<div class="col-md-12 text-center">
                 		<strong>Customer Wise Credit Report</strong>
                 		<input type="radio" name="customer_wise_report" value="customer_wise_credit" class="search_value">&nbsp;&nbsp;
                 		<strong>Customer Wise Paid Report</strong>
                 		<input type="radio" name="customer_wise_report" value="customer_wise_paid" class="search_value">
                 	</div>
                 </div>
                 <div class="show_credit" style="display: none">
                 	<form action="{{ route('customers.wise.credit') }}" method="get" id="customerCreditForm" target="_blank">
                 		<div class="form-row">
                 			<div class="col-md-8">
                 				<label>Customer Name</label>
                 				<select name="customer_id" class="form-control form-control-sm select2">
                 					<option value="">Select Customer</option>
                 					@foreach($customers as $customer)
			     					  <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->mobile_no }} - {{ $customer->address }})</option>
			     					@endforeach
                 				</select>
                 			</div>
                 			<div class="col-md-4" style="margin-top: 32px">
                 				<button type="submit" class="btn btn-primary btn-sm">Search</button>
                 			</div>
                 		</div>
                 	</form>
                 </div>
                 <div class="show_paid" style="display: none">
                  <form action="{{ route('customers.wise.paid') }}" method="get" id="customerPaidForm" target="_blank">
                    <div class="form-row">
                      <div class="form-group col-sm-8">
                        <label>Customer Name</label>
	     				<select name="customer_id" class="form-control form-control-sm select2">
	     					<option value="">Select Customer</option>
	     					@foreach($customers as $customer)
	     					  <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->mobile_no }} - {{ $customer->address }})</option>
	     					@endforeach
	     				</select>
                      <font class="supplier_msg" style="color: red"></font>
                    </div>
                      <div class="col-md-2" style="margin-top: 32px">
                        <button type="submit" class="btn btn-primary btn-sm">Search</button>
                      </div>
                    </div>
                  </form>
                 </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>
  </div>
  <script type="text/javascript">
  	  $(document).on('change','.search_value',function(){
  	  	var search_value = $(this).val();
  	  	if (search_value == 'customer_wise_credit') {
  	  		$('.show_credit').show();
  	  	}
  	  	else{
  	  		$('.show_credit').hide();
  	  	}
        if (search_value == 'customer_wise_paid') {
          $('.show_paid').show();
        }
        else{
          $('.show_paid').hide();
        }
  	  })
  </script>
  <script type="text/javascript">
	$(document).ready(function () {
	  $('#customerCreditForm').validate({
	  	ignore:[],
	  	errorPlacement: function(error,element){
           if (element.attr('name') == 'customer_id') {
           	error.insertAfter(element.next());
           }
           else{
           	error.insertAfter(element);
           }
	  	},
	  	errorClass: 'text-danger',
	  	validClass: 'text-success',
	    rules: {
	      customer_id: {
	        required: true,
	      }
	      
	    },
	    messages: {
	      
	    },
	    
	  });
	});
</script>
  <script type="text/javascript">
  $(document).ready(function () {
    $('#customerPaidForm').validate({
      ignore:[],
      errorPlacement: function(error,element){
           if (element.attr('name') == 'customer_id') {
            error.insertAfter(element.next());
           }
           else{
            error.insertAfter(element);
           }
      },
      errorClass: 'text-danger',
      validClass: 'text-success',
      rules: {
        customer_id: {
          required: true,
        },
      },
      messages: {        
      }, 
    });
  });
</script>

@endsection