 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Purchase</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Purchase</li>
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
                  Purchase List
                  <a href="{{ route('purchase.add') }}" class="btn btn-success float-right"><i class="fas fa-plus-circle"></i>&nbsp;Add Purchase</a>
                </h3>
              </div>
              <div class="card-body">
                 <table id="userlist" class="table table-bordered table-striped table-responsive">
                  <thead>
                  <tr>
                    <th>SL.</th>
                    <th>Purchase No</th>
                    <th>Date</th>
                    <th>Supplier Name</th>
                    <th>Category</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Buying Price</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@foreach($alldata as $key => $value)
                    <tr>
	                    <td>{{ $key+1 }}</td>
	                    <td>{{ $value->purchase_no }}</td>
	                    <td>{{ date('d-m-Y',strtotime($value->date)) }}</td>
	                    <td>{{ $value['supplier']['name'] }}</td>
	                    <td>{{ $value['category']['name'] }}</td>
	                    <td>{{ $value['product']['name'] }}</td>
	                    <td>{{ $value->description }}</td>
	                    <td>
	                    	{{ $value->buying_qty }}
	                    	{{ $value['product']['unit']['name'] }}
	                    </td>
	                    <td>{{ $value->unit_price }}</td>
	                    <td>{{ $value->buying_price }}</td>
	                    <td>
	                    	@if($value->status=='0')
	                    	<span style="background-color: #FC4236;padding: 5px;">Pending</span>
	                    	@else($value->status=='1')
	                    	<span style="background-color: #5EAB00;padding: 5px;">Approve</span>
	                    	@endif
	                    </td>
	                    <td>
	                    	@if($value->status=='0')
	                    	<a href="{{ route('purchase.delete',$value->id) }}" title="Delete" id="delete" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
	                    	@endif
	                    </td>
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