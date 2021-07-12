 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
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
                  Add Category
                  <a href="{{ route('categories.view') }}" class="btn btn-success float-right"><i class="fas fa-list"></i>&nbsp;Category List</a>
                </h3>
              </div>
              <div class="card-body">
                 <form  method="post" action="{{ route('categories.store') }}" id="addForm">
                 	@csrf
	                <div class="form-row">
	                  <div class="form-group col-md-6">
	                    <label for="name">Category Name</label>
	                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter name">
	                    <font style="color: red">
	                    	{{ ($errors->has('name'))?($errors->first('name')):'' }}
	                    </font>
	                  </div>
		              <div class="form-group col-md-6">
	                    <input style="margin-top: 32px;" type="submit" class="btn btn-primary" value="Submit">
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