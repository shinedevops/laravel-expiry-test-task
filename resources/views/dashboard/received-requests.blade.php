@extends('layouts.dashboard')

@section('page-heading','Login Requests')

@section('page-breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
<li class="breadcrumb-item active">Login Requests</li>
@endsection

@section('header-style')
<link rel="stylesheet" href="{{ asset("dashboard-assets") }}/plugins/jquery-timepicker-master/jquery.timepicker.min.css">
@endsection

@section('inner-content')
<!-- Session Status -->
<x-auth-session-status class="mb-4 alert alert-success" :status="session('status')" />
<!-- /.row -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Login Requests</h3>

				<div class="card-tools" style="display:none">
					<div class="input-group input-group-sm" style="width: 150px;">
						<input type="text" name="table_search" class="form-control float-right" placeholder="Search">

						<div class="input-group-append">
							<button type="submit" class="btn btn-default">
								<i class="fas fa-search"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
			<!-- /.card-header -->
			@if( $login_requests->count() )
			<div class="card-body table-responsive p-0">
				<table class="table table-hover text-nowrap">
					<thead>
						<tr>
							<th>Sent by</th>
							<th>Sent on</th>
							<th>Status</th>
							<th>Time Limit</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach( $login_requests as $single_request )
						<tr>
							<td>{{ $single_request->sent_by ? "{$single_request->sent_by->name} ({$single_request->sent_by->email})": 'NA' }}</td>
							<td>{{ $single_request->created_at->format("d M Y H:i:s") }}</td>
							<td>
								{!! $single_request->status_label !!}
							</td>
							<td>
								@if( $single_request->accepted_request )
								{{ $single_request->accepted_request->valid_for }}
								@else
								--
								@endif
							</td>
							<td data-request-id="{{ $single_request->id }}">
								@if( $single_request->status == 'sent' )
								<a href="#" class="btn btn-success btn-sm accept-request" data-toggle="modal" data-target="#accept-request">
									Accept
								</a>
								<a href="{{ route('login-requests') }}" class="btn btn-danger btn-sm decline-request">Reject</a>
								@else
								--
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				
			</div>
			<div class="card-footer clearfix">
				{{ $login_requests->links() }}
			</div>
			@else
			<div class="card-body">
				No login request received yet.
			</div>
			@endif
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
</div>


<div class="modal fade" id="accept-request" tabindex="-1" role="dialog" aria-labelledby="accept-requestLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Accept Request</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="accept-request" method="post" action="{{ route('accept-request') }}" class="form-validation">
				@csrf
				<div class="modal-body">
					<div class="card-body">
						<div class="form-group">
							<label for="valid_for">Time</label>
							<input type="hidden" name="request_id">
							<input type="text" onkeydown="return false;" class="form-control" required id="valid_for" name="valid_for" placeholder="Time" >
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section("footer-script")
<!-- Timepicker -->
<script src="{{ asset("dashboard-assets") }}/plugins/jquery-timepicker-master/jquery.timepicker.min.js"></script>
<script>
	$(document).ready(function(){
		$("[name=valid_for]").timepicker({
			timeFormat: "H:i:s",
			step: 5
		});
		$(".accept-request").on("click",function(){
			$("[name=request_id]").val( $(this).parent().data("request-id") );
		});

		$(".decline-request").on("click",function( event ){
			event.preventDefault();
			Swal.fire({
				title: 'Are you sure to reject request?',
				showDenyButton: true,
				confirmButtonText: `Yes`,
				denyButtonText: `No`,
			}).then((result) => {
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed) {
					var go_to_url = site_url + "/decline-request/" + $(this).parent().data("request-id")
					location = go_to_url;
				}
			});
		});
	});
</script>
@endsection