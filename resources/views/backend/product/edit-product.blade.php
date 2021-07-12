 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Product</h1>
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
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3>
                  Add Product
                  <a href="{{ route('products.view') }}" class="btn btn-success float-right"><i class="fas fa-list"></i>&nbsp;Product List</a>
                </h3>
              </div>
              <div class="card-body">
                 <form  method="post" action="{{ route('products.update',$editdata->id) }}" id="addForm">
                 	@csrf
	                <div class="form-row">
	                  <div class="form-group col-md-6">
	                  	<label for="supplier_id">Supplier Name</label>
	                  	<select name="supplier_id" id="supplier_id" class="form-control">
	                  		<option value="">Select Supplier</option>
	                  		@foreach($suppliers as $supplier)
	                  		 <option value="{{ $supplier->id }}" {{ ($editdata->supplier_id==$supplier->id)?'selected':'' }}>{{ $supplier->name }}</option>
	                  		@endforeach
	                  	</select>
	                  	<font style="color: red">
	                    	{{ ($errors->has('supplier_id'))?($errors->first('supplier_id')):'' }}
	                    </font>
	                  </div>
	                  <div class="form-group col-md-6">
	                  	<label for="category_id">Category</label>
	                  	<select name="category_id" id="category_id" class="form-control">
	                  		<option value="">Select Category</option>
	                  		@foreach($categories as $category)
	                  		 <option value="{{ $category->id }}" {{ ($editdata->category_id==$category->id)?'selected':'' }}>{{ $category->name }}</option>
	                  		@endforeach
	                  	</select>
                        <font style="color: red">
	                    	{{ ($errors->has('category_id'))?($errors->first('category_id')):'' }}
	                    </font>
	                  </div>
	                  <div class="form-group col-md-6">
	                    <label for="name">Product Name</label>
	                    <input type="text" name="name" value="{{$editdata->name}}" class="form-control" id="name" placeholder="Enter name">
	                    <font style="color: red">
	                    	{{ ($errors->has('name'))?($errors->first('name')):'' }}
	                    </font>
	                  </div>
	                  <div class="form-group col-md-6">
	                  	<label for="unit_id">Unit</label>
	                  	<select name="unit_id" id="unit_id" class="form-control">
	                  		<option value="">Select Unit</option>
	                  		@foreach($units as $unit)
	                  		 <option value="{{ $unit->id }}" {{ ($editdata->unit_id==$unit->id)?'selected':'' }}>{{ $unit->name }}</option>
	                  		@endforeach
	                  	</select>
	                  	<font style="color: red">
	                    	{{ ($errors->has('unit_id'))?($errors->first('unit_id')):'' }}
	                    </font>
	                  </div>
		              <div class="form-group col-md-6">
	                    <input type="submit" class="btn btn-primary" value="Submit">
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
	
	$(document).ready(function () {
	  
	  $('#addForm').validate({
	    rules: {
	      supplier_id: {
	        required: true,
	      },
	      category_id: {
	        required: true,
	      },
	      name: {
	        required: true,
	      },
	      unit_id: {
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