<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel Demo</title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset("dashboard-assets") }}/plugins/fontawesome-free/css/all.min.css">
	<!-- Sweetalert -->
	<link rel="stylesheet" href="{{ asset("dashboard-assets") }}/plugins/sweetalert2/sweetalert2.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset("dashboard-assets") }}/dist/css/adminlte.min.css">
	<link rel="stylesheet" href="{{ asset("dashboard-assets") }}/css/common.css">
	<script>
		var site_url = "{{ url('') }}",
		check_pending_seconds = {{ Auth::user()->hasRole('frontend') ? 1 : 0 }},
		pending_seconds = {{ request('pending_seconds',0) }};
	</script>
	@yield("header-style")
</head>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
			</ul>

			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				

				<!-- Messages Dropdown Menu -->
				
				<li class="nav-item">
					<a class="nav-link" data-widget="fullscreen" href="#" role="button">
						<i class="fas fa-expand-arrows-alt"></i>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
						<i class="fas fa-th-large"></i>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="{{ asset("dashboard-assets") }}/index3.html" class="brand-link">
				<x-application-logo class="w-20 h-20 fill-current text-gray-500" />
				{{-- <img src="{{ asset("dashboard-assets") }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
				<span class="brand-text font-weight-light">{{config('app.name', 'Laravel')}}</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="info" style="white-space: initial;">
						<a href="{{ route('dashboard') }}" class="d-block">{{ Auth::user()->name }} ({{ Auth::user()->email }})</a>
					</div>
				</div>


				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<li class="nav-item">
							<a href="{{ route('dashboard') }}" class="nav-link {{ \Route::current()->getName() == "dashboard" ? 'active' : '' }}">
								<i class="nav-icon fas fa-th"></i>
								<p>
									Dashboard
								</p>
							</a>
						</li>
						@role('admin')
						<li class="nav-item">
							<a href="{{ route('login-requests') }}" class="nav-link {{ \Route::current()->getName() == "login-requests" ? 'active' : '' }}">
								<i class="nav-icon fas fa-list"></i>
								<p>
									Login Requests
								</p>
							</a>
						</li>
						@endrole
						<li class="nav-item">
							<a href="{{ route('logout') }}" class="nav-link">
								<i class="nav-icon fas fa-sign-out-alt"></i>
								<p>
									Logout
								</p>
							</a>
						</li>
					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>@yield('page-heading')</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								@yield('page-breadcrumb')
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					@yield('inner-content')
				</div><!-- /.container-fluid -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<footer class="main-footer">
			<div class="float-right d-none d-sm-block">
				<b>Version</b> 3.1.0
			</div>
			<strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
		</footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->

	<!-- jQuery -->
	<script src="{{ asset("dashboard-assets") }}/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="{{ asset("dashboard-assets") }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- jQuery Validation -->
	<script src="{{ asset("dashboard-assets") }}/plugins/jquery-validation/jquery.validate.min.js"></script>
	<!-- Sweetalert -->
	<script src="{{ asset("dashboard-assets") }}/plugins/sweetalert2/sweetalert2.min.js"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset("dashboard-assets") }}/dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="{{ asset("dashboard-assets") }}/dist/js/demo.js"></script>

	

	<script src="{{ asset("dashboard-assets") }}/js/common.js"></script>
	@yield("footer-script")
</body>
</html>
