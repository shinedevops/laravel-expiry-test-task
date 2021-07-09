@extends('layouts.dashboard')

@section('page-heading','Dashboard')

@section('page-breadcrumb')

<li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('inner-content')
<!-- Session Status -->
<x-auth-session-status class="mb-4 alert alert-success" :status="session('status')" />

<!-- Validation Errors -->
<x-auth-validation-errors class="mb-4 alert alert-danger" :errors="$errors" />

<!-- /.row -->
<div class="row">
	<div class="col-12">

		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Update details</h3>
			</div>
			<!-- /.card-header -->
			<!-- form start -->
			<form action="{{ route('update-details') }}" method="post" class="form-validation">
				@csrf
				<div class="card-body">
					<div class="form-group">
						<label for="user-name">Name</label>
						<input type="text" class="form-control" id="user-name" data-rule-required="true" name="name" placeholder="Enter name" value="{{ Auth::user()->name }}">
					</div>
					<div class="form-group">
						<label for="user-email">Email address</label>
						<input type="text" class="form-control" id="user-email"  data-rule-required="true" data-rule-emailfull="true" name="email" placeholder="Enter email" value="{{ Auth::user()->email }}">
					</div>
				</div>
				<!-- /.card-body -->
				<div class="card-footer">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>


	</div>
</div>
@endsection