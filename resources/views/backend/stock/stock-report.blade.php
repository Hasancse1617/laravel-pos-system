 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product</li>
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
                  Product List
                  <a href="{{ route('stock.report.pdf') }}" target="_blank" class="btn btn-success float-right"><i class="fas fa-download"></i>&nbsp;Download PDF</a>
                </h3>
              </div>
              <div class="card-body">
                 <table id="userlist" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL.</th>
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
                  	@foreach($alldata as $key => $value)
                    @php
                      $buying_total = App\Model\Purchase::where('category_id',$value->category_id)->where('product_id',$value->id)->where('status',1)->sum('buying_qty');
                      $selling_total = App\Model\InvoiceDetail::where('category_id',$value->category_id)->where('product_id',$value->id)->where('status',1)->sum('selling_qty');
                    @endphp
                    <tr>
	                    <td>{{ $key+1 }}</td>
	                    <td>{{ $value['supplier']['name'] }}</td>
	                    <td>{{ $value['category']['name'] }}</td>
	                    <td>{{ $value->name }}</td>
                      <td>{{ $buying_total }}</td>
                      <td>{{ $selling_total }}</td>
	                    <td>{{ $value->quantity }}</td>
	                    <td>{{ $value['unit']['name'] }}</td>
                    </tr>
                    @endforeach
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