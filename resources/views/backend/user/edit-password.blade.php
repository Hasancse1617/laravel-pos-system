 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Password</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Password</li>
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
                  Edit Password
                </h3>
              </div>
              <div class="card-body">
                 <form  method="post" action="{{ route('profiles.password.update') }}" id="addForm">
                 	@csrf
	                <div class="form-row">
	                  
	                  <div class="form-group col-md-6">
	                    <label for="current_password">Current Password</label>
	                    <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Current Password">
	                  </div>
	                  <div class="form-group col-md-6">
	                    <label for="new_password">New Password</label>
	                    <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password">
	                  </div>
	                  <div class="form-group col-md-6">
	                    <label for="confirm_new_password">Confirm New Password</label>
	                    <input type="password" name="confirm_new_password" class="form-control" placeholder="Confirm New Password">
	                  </div>
	                  <div class="form-group col-md-6">
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
	      current_password: {
	        required: true,
	      },
	      new_password: {
	        required: true,
	        minlength: 6,
	      },
	      confirm_new_password: {
	        required: true,
	        equalTo: '#new_password'
	      },
	      
	    },
	    messages: {
	      current_password: {
	        required: "Please enter current password",
	      },
	      new_password: {
	        required: "Please enter new password",
	        minlength: "Password must be at least 6 characters long",
	      },
	      confirm_new_password: {
	        required: "Please enter confirm password",
	        equalTo: "Confirm password does not match",
	      },
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