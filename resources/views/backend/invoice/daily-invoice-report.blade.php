 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Daily Invoice Report</h1>
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
            <!-- Custom tabs (Charts with tabs)-->
            @if(Session::has('error_message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ Session::get('error_message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
             @endif
            <div class="card">
              <div class="card-header">
                <h3>
                  Select Criteria
                  <!-- <a href="{{ route('invoice.view') }}" class="btn btn-success float-right"><i class="fas fa-list"></i>&nbsp;Invoice List</a> -->
                </h3>
              </div>
              <div class="card-body">
                  <form action="{{ route('invoice.daily.report.pdf') }}" method="get" target="_blank" id="addForm">
	                <div class="form-row">
	                  <div class="form-group col-md-2">
	                    <label>Start Date</label>
	                    <input type="text" name="start_date" class="form-control form-control-sm datepicker start_date" id="start_date" placeholder="YYYY-MM-DD" readonly="">
	                  </div>
	                  <div class="form-group col-md-2">
	                    <label>End Date</label>
	                    <input type="text" name="end_date" class="form-control form-control-sm datepicker1 end_date" id="start_date" placeholder="YYYY-MM-DD" readonly="">
	                  </div>
		              <div class="form-group col-md-1" style="padding-top: 32px;">
	                    <button type="submit" class="btn btn-primary btn-sm">Search</button>
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
	      start_date: {
	        required: true,
	      },
	      end_date: {
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
<script type="text/javascript">
	$('.datepicker').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'yyyy-mm-dd'
	})
	$('.datepicker1').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'yyyy-mm-dd'
	})
</script>

@endsection