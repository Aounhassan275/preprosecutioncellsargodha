<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1,">
    <meta name="description" content="Investigation & Monitoring Cell">
	<meta name="author" content="Bootlab">
    <title>ADMIN PANEL | Investigation & Monitoring Cell</title> 
	<link rel="shortcut icon" type="image/png" href="{{asset('front/image/favicon.png')}}">	

	<link rel="preconnect" href="{{asset('//fonts.gstatic.com/')}}" crossorigin="">

	<!-- PICK ONE OF THE STYLES BELOW -->
    <link href="{{asset('css/classic.css')}}" rel="stylesheet"> 
	<!-- <link href="{{asset('css/corporate.css')}}" rel="stylesheet"> -->
	<!-- <link href="{{asset('css/modern.css')}}" rel="stylesheet"> -->
	{{-- <script src="{{asset('js/settings.js')}}"></script> --}}

	<!-- BEGIN SETTINGS -->
	<!-- You can remove this after picking a style -->
	<style>
		body {
			opacity: 0;
		}
	</style>
	<!-- END SETTINGS -->
	@toastr_css
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content ">
				<a class="sidebar-brand" href="{{url('/')}}">
          			<i class="align-middle" data-feather="box"></i>
          			<span class="align-middle"> Investigation & Monitoring Cell</span>
        		</a>
				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Admin Panel
                    </li>
                    <li class="sidebar-item {{Request::is('admin/dashboard')?'active':''}}">
						<a class="sidebar-link" href="{{route('admin.dashboard.index')}}">
							<i class="align-middle" data-feather="list"></i> <span class="align-middle">Dashboard</span>
						</a>
					</li>
					<li class="sidebar-item">
						<a href="{{url('#users')}}" data-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle" data-feather="monitor"></i> <span class="align-middle">User</span>
						</a>
						<ul id="users" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.user.create')}}">Create New User</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.user.index')}}">All User</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.user.actives')}}">Active User</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.user.blocks')}}">Block User</a></li>
						</ul>
					</li>
					<li class="sidebar-item {{Request::is('admin/challan')?'active':''}}">
						<a class="sidebar-link" href="{{route('admin.challan.index')}}">
							<i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Challan</span>
						</a>
					</li>
					<li class="sidebar-item {{Request::is('admin/profile')?'active':''}}">
						<a class="sidebar-link" href="{{route('admin.profile.index')}}">
							<i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Profile</span>
						</a>
					</li>
				</ul>

				<div class="sidebar-bottom d-none d-lg-block">
					<div class="media">
						<img class="rounded-circle mr-3" src="{{asset('img\avatars\avatar.jpg')}}" alt="Chris Wood" width="40" height="40">
						<div class="media-body">
							<h5 class="mb-1"> Investigation & Monitoring Cell</h5>
							<div>
								<i class="fas fa-circle text-success"></i> Online
							</div>
						</div>
					</div>
				</div>

			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light bg-white">
				<a class="sidebar-toggle d-flex mr-2">
          			<i class="hamburger align-self-center"></i>
       			</a>
				<div class="navbar-collapse collapse">
					<ul class="navbar-nav ml-auto">
					
						<li class="nav-item dropdown">
						

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="{{url('#')}}" data-toggle="dropdown">
                <img src="{{asset('img\avatars\avatar.jpg')}}" class="avatar img-fluid rounded-circle mr-1" alt="Chris Wood"> <span class="text-dark">Admin</span>
              </a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="{{route('admin.logout')}}">Sign out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

					@yield('contents')
				
				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-left">
							{{-- <ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="{{url('#')}}">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="{{url('#')}}">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="{{url('#')}}">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="{{url('#')}}">Terms of Service</a>
								</li>
							</ul> --}}
						</div>
						<div class="col-6 text-right">
							<p class="mb-0">
								&copy; 2021 - <a href="tel:03030672683" class="text-muted">DEVELOPED BY AS</a>
							</p>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="{{asset('js\app.js')}}"></script>
	@toastr_js
	@toastr_render
	@yield('scripts')
</body>

</html>