 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User</li>
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
                  Add User
                  <a href="{{ route('users.view') }}" class="btn btn-success float-right"><i class="fas fa-list"></i>&nbsp;User List</a>
                </h3>
              </div>
              <div class="card-body">
                 <form  method="post" action="{{ route('users.store') }}" id="addForm">
                 	@csrf
	                <div class="form-row">
	                  <div class="form-group col-md-6">
	                  	<label for="usertype">User Role</label>
	                  	<select name="usertype" id="usertype" class="form-control">
	                  		<option value="">Select Role</option>
	                  		<option value="Admin">Admin</option>
	                  		<option value="User">User</option>
	                  	</select>
	                  </div>
	                  <div class="form-group col-md-6">
	                    <label for="name">Name</label>
	                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter name">
	                    <font style="color: red">
	                    	{{ ($errors->has('name'))?($errors->first('name')):'' }}
	                    </font>
	                  </div>
	                  <div class="form-group col-md-6">
	                    <label for="email">Email</label>
	                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
	                    <font style="color: red">
	                    	{{ ($errors->has('email'))?($errors->first('email')):'' }}
	                    </font>
	                  </div>
	                  <div class="form-group col-md-6">
	                    <label for="password">Password</label>
	                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
	                  </div>
	                  <div class="form-group col-md-6">
	                    <label for="password">Confirm Password</label>
	                    <input type="password" name="password2" class="form-control" placeholder="Password">
	                  </div>
	                  <!--<div class="form-group col-md-6">
	                    <label for="exampleInputFile">File input</label>
	                    <div class="input-group">
	                      <div class="custom-file">
	                        <input type="file" class="custom-file-input" id="exampleInputFile">
	                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
	                      </div>
	                      <div class="input-group-append">
	                        <span class="input-group-text" id="">Upload</span>
	                      </div>
	                    </div>
	                  </div>-->
	                  <div class="form-group col-md-6">
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
	      usertype: {
	        required: true,
	      },
	      name: {
	        required: true,
	      },
	      email: {
	        required: true,
	        email: true,
	      },
	      password: {
	        required: true,
	        minlength: 6,
	      },
	      password2: {
	        required: true,
	        equalTo: '#password'
	      },
	      
	    },
	    messages: {
	      usertype: {
	        required: "Please select user role",
	      },
	      name: {
	        required: "Please enter name",
	      },
	      email: {
	        required: "Please enter email address",
	        email: "Please enter vaild email address"
	      },
	      password: {
	        required: "Please enter password",
	        minlength: "Password must be at least 6 characters long",
	      },
	      password2: {
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