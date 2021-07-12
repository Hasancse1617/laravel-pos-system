 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage User</h1>
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
                  User List
                  <a href="{{ route('users.add') }}" class="btn btn-success float-right"><i class="fas fa-plus-circle"></i>&nbsp;Add User</a>
                </h3>
              </div>
              <div class="card-body">
                 <table id="userlist" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL.</th>
                    <th>Role</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@foreach($allUser as $key => $user)
                    <tr>
	                    <td>{{ $key+1 }}</td>
	                    <td>{{ $user->usertype }}</td>
	                    <td>{{ $user->name }}</td>
	                    <td>{{ $user->email }}</td>
	                    <td>
	                    	<a href="{{ route('users.edit',$user->id) }}" title="Edit" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
	                    	<a href="{{ route('users.delete',$user->id) }}" title="Delete" id="delete" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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