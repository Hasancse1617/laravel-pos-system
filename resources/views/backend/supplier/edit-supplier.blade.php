 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Supplier</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Supplier</li>
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
                  Edit Supplier
                  <a href="{{ route('suppliers.view') }}" class="btn btn-success float-right"><i class="fas fa-list"></i>&nbsp;Supplier List</a>
                </h3>
              </div>
              <div class="card-body">
                 <form  method="post" action="{{ route('suppliers.update',$editdata->id) }}" id="addForm">
                 	@csrf
	                <div class="form-row">
	                  <div class="form-group col-md-6">
	                    <label for="name">Supplier Name</label>
	                    <input type="text" name="name" value="{{ $editdata->name }}" class="form-control" id="name" placeholder="Enter name">
	                    <font style="color: red">
	                    	{{ ($errors->has('name'))?($errors->first('name')):'' }}
	                    </font>
	                  </div>
	                  <div class="form-group col-md-6">
	                    <label for="mobile_no">Mobile No</label>
	                    <input type="text" name="mobile_no" value="{{ $editdata->mobile_no }}" class="form-control" id="mobile_no" placeholder="Enter mobile no">
	                    <font style="color: red">
	                    	{{ ($errors->has('mobile_no'))?($errors->first('mobile_no')):'' }}
	                    </font>
	                  </div>
	                  <div class="form-group col-md-6">
	                    <label for="email">Email</label>
	                    <input type="email" name="email" value="{{ $editdata->email }}" class="form-control" id="email" placeholder="Enter email">
	                    <font style="color: red">
	                    	{{ ($errors->has('email'))?($errors->first('email')):'' }}
	                    </font>
	                  </div>
	                  <div class="form-group col-md-6">
	                    <label for="address">Address</label>
	                    <input type="text" name="address" value="{{ $editdata->address }}" id="address" class="form-control" placeholder="Enter address">
	                    <font style="color: red">
	                    	{{ ($errors->has('email'))?($errors->first('email')):'' }}
	                    </font>
	                  </div>
		              <div class="form-group col-md-6">
	                    <input type="submit" class="btn btn-primary" value="Update">
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
	      name: {
	        required: true,
	      },
	      mobile_no: {
	        required: true,
	      },
	      email: {
	        required: true,
	        email: true,
	      },
	      address: {
	        required: true,
	        minlength: 6,
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