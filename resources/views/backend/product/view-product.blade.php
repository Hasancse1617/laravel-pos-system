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
                  <a href="{{ route('products.add') }}" class="btn btn-success float-right"><i class="fas fa-plus-circle"></i>&nbsp;Add Product</a>
                </h3>
              </div>
              <div class="card-body">
                 <table id="userlist" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL.</th>
                    <th>Supplier Name</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Unit</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@foreach($alldata as $key => $value)
                    <tr>
	                    <td>{{ $key+1 }}</td>
	                    <td>{{ $value['supplier']['name'] }}</td>
	                    <td>{{ $value['category']['name'] }}</td>
	                    <td>{{ $value->name }}</td>
	                    <td>{{ $value['unit']['name'] }}</td>
                      @php
                        $count_product = App\Model\Purchase::where('product_id',$value->id)->count();
                      @endphp
	                    <td>
	                    	<a href="{{ route('products.edit',$value->id) }}" title="Edit" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                        @if($count_product < 1)
	                    	<a href="{{ route('products.delete',$value->id) }}" title="Delete" id="delete" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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