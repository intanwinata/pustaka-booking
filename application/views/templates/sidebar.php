 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

 	<!-- Sidebar - Brand -->
 	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url(); ?>admin/index">
 		<div class="sidebar-brand-icon rotate-n-15">
 			<i class="fas fa-book"></i>
 		</div>
 		<div class="sidebar-brand-text mx-3">Pustaka Booking</div>
 	</a>

 	<!-- Divider -->
 	<hr class="sidebar-divider">

 	<!-- Looping Menu-->

 	<!-- Heading -->
 	<div class="sidebar-heading">
 		My Profil
 	</div>

 	<!-- Nav Item - Dashboard -->
 	<li class="nav-item">

 	<li class="nav-item">
 		<a class="nav-link pb-0" href="<?= base_url(); ?>user/index">
 			<i class="fa fa-fw fa-user"></i>
 			<span>Profile</span></a>
 	</li>

 	<!-- Divider -->
 	<hr class="sidebar-divider mt-4">

 	<!-- Heading -->
 	<div class="sidebar-heading">
 		Master Data
 	</div>

 	<!-- Nav Item - Dashboard -->
 	<li class="nav-item">
 		<a class="nav-link pb-0" href="<?= base_url('buku'); ?>">
 			<i class="fas fa-fw fa-book"></i>
 			<span>Data Buku</span>
 		</a>
 	</li>

 	<!-- <li class="nav-item">
    <a class="nav-link pb-0" href="<?= base_url('user/anggota'); ?>">
      <i class="fas fa-fw fa-book"></i>
      <span>Data Anggota</span>
    </a>
  </li> -->

 	<li class="nav-item">
 		<a class="nav-link pb-0" href="<?= base_url('buku/kategori'); ?>">
 			<i class="fas fa-fw fa-book"></i>
 			<span>Kategori Buku</span>
 		</a>
 	</li>

 	<!-- Divider -->
 	<hr class="sidebar-divider mt-4">

 	<!-- Heading -->
 	<div class="sidebar-heading">Transaksi</div>
 	<!-- Nav Item - Dashboard -->
 	<li class="nav-item">

 	<li class="nav-item">
 		<a class="nav-link pb-0" href="<?= base_url('pinjam'); ?>">
 			<i class="fas fa-fw fa-book"></i>
 			<span>Data Pinjam</span>
 		</a>
 	</li>
 	<li class="nav-item">
 		<a class="nav-link pb-0" href="<?= base_url('pinjam/daftarBooking'); ?>">
 			<i class="fas fa-fw fa-book"></i>
 			<span>Data Booking</span>
 		</a>
 	</li>

 	<!-- Divider -->
 	<hr class="sidebar-divider d-one d-md-block">
 	<!-- Nav Item - CHart -->
 	<li class="nav-item">
 		<a class="nav-link pb-0" href="<?= base_url('autentifikasi/logout'); ?>">
 			<i class="fas fa-sign-out-alt"></i>
 			<span>logout</span></a>
 	</li>

 	<!-- Divider -->
 	<hr class="sidebar-divider d-none d-md-block">

 	<!-- Sidebar Toggler (Sidebar) -->
 	<div class="text-center d-none d-md-inline">
 		<button type="submit" class="rounded-circle border-0" id="sidebarToggle"></button>
 	</div>

 </ul>
 <!-- End of Sidebar -->