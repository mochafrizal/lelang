<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
	<form class="form-inline mr-auto">
		<ul class="navbar-nav mr-3">
			<li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
			<!-- <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li> -->
		</ul>
	</form>
	<ul class="navbar-nav navbar-right">
		<li class="dropdown">
			<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
				<img alt="image" src="" class="rounded-circle mr-1" onerror="this.src='<?php echo base_url() ?>assets/avatar-1.png'">
				<div class="d-sm-none d-lg-inline-block">Welcome!</div>
			</a>
			<div class="dropdown-menu dropdown-menu-right">
				<div class="dropdown-divider"></div>
				<a class="dropdown-item has-icon text-danger" href="<?php echo base_url() ?>login/logout">
					<i class="fas fa-sign-out-alt"></i> Logout
				</a>

				
			</div>
		</li>
	</ul>
</nav>
<div class="main-sidebar">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand">
			<a href="<?php echo base_url() ?>">My Brand</a>
		</div>
		<div class="sidebar-brand sidebar-brand-sm">
			<a href="<?php echo base_url() ?>">Lelang</a>
		</div>
		<ul class="sidebar-menu">
			<li class="menu-header">Menu</li>
			<li class="">
				<a class="nav-link" href="<?php echo base_url() ?>pelelang/baranglelangku">
					<i class="fas fa-th-large"></i><span>Barang Lelangku</span>
				</a>
			</li>
			<li class="">
				<a class="nav-link" href="<?php echo base_url() ?>pelelang/riwayatlelang">
					<i class="fas fa-th-large"></i><span>Riwayat Lelang</span>
				</a>
			</li>
			<li class="">
				<a class="nav-link" href="<?php echo base_url() ?>pelelang/baranglelang">
					<i class="fas fa-th-large"></i><span>Semua Barang Lelang</span>
				</a>
			</li>
			<li class="">
				<a class="nav-link" href="<?php echo base_url() ?>pelelang/profile">
					<i class="fas fa-th-large"></i><span>Update Profile</span>
				</a>
			</li>
		</ul>
	</aside>
</div>