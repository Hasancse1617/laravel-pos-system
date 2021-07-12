 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Invoice</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
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
                  Invoice No #{{$invoice->invoice_no}}({{ date('d-m-Y',strtotime($invoice->date)) }})
                  <a href="{{ route('invoice.pending.list') }}" class="btn btn-success float-right"><i class="fas fa-list"></i>&nbsp;Pending Invoice List</a>
                </h3>
              </div>
              <div class="card-body">
                 <table class="table table-striped">
                  <tbody>
                  <tr>
                    <td width="15%"><p><strong>Customer Info</strong></p></td>
                    <td width="25%"><p><strong>Name:</strong> {{$payment['customer']['name']}}</p></td>
                    <td width="25%"><p><strong>Mobile:</strong> {{$payment['customer']['mobile_no']}}</p></td>
                    <td width="35%"><p><strong>Address:</strong> {{$payment['customer']['address']}}</p></td>
                  </tr>
                  <tr>
                    <td width="15%"></td>
                    <td width="85%" colspan="3"><p><strong>Description:</strong> {{$invoice->description}}</p></td>
                  </tr>
                  </tbody>
               </table>
               <form method="post" action="{{ route('approve.store',$invoice->id) }}">
               	@csrf
               <table border="1" width="100%" style="margin-bottom: 10px">
                    <thead>
                  <tr class="text-center">
                    <th>SL.</th>
                    <th>Category</th>
                    <th>Product Name</th>
                    <th class="text-center" style="background: #ddd;padding: 1px">Current Stock</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@php
                  	  $total_sum = '0';
                  	@endphp
                  	@foreach($invoice['invoice_details'] as $key=>$value)
                  	<tr class="text-center">
                  		<input type="hidden" name="category_id[]" value="{{ $value->category_id }}">
                  		<input type="hidden" name="product_id[]" value="{{ $value->product_id }}">
                  		<input type="hidden" name="selling_qty[{{$value->id}}]" value="{{ $value->selling_qty }}">
                  		<td>{{ $key+1 }}</td>
                  		<td>{{ $value['category']['name'] }}</td>
                  		<td>{{ $value['product']['name'] }}</td>
                  		<td class="text-center" style="background: #ddd;padding: 1px">{{ $value['product']['quantity'] }}</td>
                  		<td>{{ $value->selling_qty }}</td>
                  		<td>{{ $value->unit_price }}</td>
                  		<td>{{ $value->selling_price }}</td>
                  	</tr>
                  	@php
                  	  $total_sum += $value->selling_price;
                  	@endphp
                  	@endforeach
                  	<tr>
                  		<td colspan="6" class="text-right"><strong>Sub Total</strong> &nbsp;</td>
                  		<td class="text-center"><strong>{{ $total_sum }}</strong></td>
                  	</tr>
                  	<tr>
                  		<td colspan="6" class="text-right">Discount &nbsp;</td>
                  		<td class="text-center"><strong>{{ $payment->discount_amount }}</strong></td>
                  	</tr>
                  	<tr>
                  		<td colspan="6" class="text-right">Paid Amount &nbsp;</td>
                  		<td class="text-center"><strong>{{ $payment->paid_amount }}</strong></td>
                  	</tr>
                  	<tr>
                  		<td colspan="6" class="text-right">Due Amount &nbsp;</td>
                  		<td class="text-center"><strong>{{ $payment->due_amount }}</strong></td>
                  	</tr>
                  	<tr>
                  		<td colspan="6" class="text-right"><strong>Grand Total</strong> &nbsp;</td>
                  		<td class="text-center"><strong>{{ $payment->total_amount }}</strong></td>
                  	</tr>
                  </tbody>
               </table>
               <button type="submit" class="btn btn-success">Invoice Approve</button>
              </form>
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>
  </div>
@endsection