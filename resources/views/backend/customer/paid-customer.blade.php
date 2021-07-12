 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Paid Customer</h1>
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
                  Paid Customer List
                  <a href="{{ route('customers.paid.pdf') }}" target="_blank" class="btn btn-success float-right"><i class="fas fa-download"></i>&nbsp;Download PDF</a>
                </h3>
              </div>
              <div class="card-body">
                 <table id="userlist" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL.</th>
                    <th>Customer Name</th>
                    <th>Invoice No</th>
                    <th>Date</th>
                    <th>Paid Amount</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@php
		          	 $total_paid = '0';
		          	@endphp
                  	@foreach($alldata as $key => $payment)
                    <tr>
	                    <td>{{ $key+1 }}</td>
	                    <td>{{ $payment['customer']['name'] }} ({{ $payment['customer']['mobile_no'] }} - {{ $payment['customer']['address'] }})</td>
	                    <td>Invoice No #{{ $payment['invoice']['invoice_no'] }}</td>
	                    <td>{{ date('d-m-Y',strtotime($payment['invoice']['date'])) }}</td>
	                    <td>{{ $payment->paid_amount }} TK</td>
	                    <td>
	                    	<a href="{{ route('invoice.details.pdf',$payment->invoice_id) }}" target="_blank" title="Details" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>
	                    </td>
                    </tr>
                    @php
		          	 $total_paid += $payment->paid_amount;
		          	@endphp
                    @endforeach
                 </tbody>
               </table>
               <table class="table table-bordered table-hover">
               	<tbody>
               		<tr>
               			<td colspan="4" style="text-align: right">Gand Total</td>
               			<td><strong>{{$total_paid}}</strong></td>
               		</tr>
               	</tbody>
               </table>
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>
  </div>
@endsection