<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
	</div>

	<!-- Content Row -->
	<div class="row">

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								Jumlah Produk</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_product ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-box fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
								Jumlah Kategori</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_category ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-list-ul fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Pending Requests Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-danger shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
								Jumlah Pengguna</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_user ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-users fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Pending Requests Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
								Jumlah Barang Dipinjam</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_borrowed ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-boxes fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Content Row -->

	<div class="row">

		<!-- Area Chart -->
		<!-- Form Peminjaman -->
		<div class="col-xl-12 col-lg-12">
			<div class="card shadow mb-4">
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Form Peminjaman Barang</h6>
				</div>
				<!-- Card Body -->
				<div class="card-body">
					<?php 
					if(validation_errors())
					{
						?>
						<div class="alert alert-danger" role="alert">
							<?php echo validation_errors(); ?>
						</div>
						<?php
					}
					?>
					<?php
					if ($this->session->flashdata("success")) {
						?>
						<div class="alert alert-success" role="alert">
							<?php echo $this->session->flashdata("success"); ?>
						</div>
						<?php
					}
					?>
					<?php
					if ($this->session->flashdata("error")) {
						?>
						<div class="alert alert-danger" role="alert">
							<?php echo $this->session->flashdata("error"); ?>
						</div>
						<?php
					}
					?>
					<form class="form-signin" method="POST" action="<?= site_url('home/borrowed_item_create') ?>">
						<?php if ($this->session->userdata('is_admin') == 1) { ?>
							<div class="form-label-group">
								<label for="listCategory">Borrower's Name</label>
								<select class="custom-select" id="listCategory" name="user_id" required>
									<?php foreach ($list_user as $value) { ?>
										<option value="<?= $value->id ?>"><?= $value->name ?></option>
									<?php } ?>
								</select>
							</div>
						<?php } else { ?>
							<fieldset disabled>
								<div class="form-label-group">
									<label for="inputEmail">Borrower's Name</label>
									<input type="text" class="form-control" placeholder="Borrower's Name" value="<?= $this->session->userdata('name'); ?>" required>
									<input type="hidden" name="user_id" value="<?= $this->session->userdata('name'); ?>">
								</div>
							</fieldset>
						<?php } ?>
						<div class="form-label-group">
							<label for="listCategory">Borrowed Goods</label>
							<select class="custom-select" id="listCategory" name="product_id" required>
								<?php foreach ($list_product as $value) { ?>
									<option value="<?= $value->id ?>"><?= $value->name ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="form-label-group">
                            <label>Description</label>
                            <textarea class="form-control"
                                name="description" required></textarea>
						</div>

						<hr class="my-4">

						<button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Content Row -->
	<div class="row">

		<!-- Content Column -->
		<div class="col-lg-6 mb-4">

			<!-- Approach -->
			<div class="card shadow mb-4" style="min-height: 30vh">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
				</div>
				<div class="card-body">
					<p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
						CSS bloat and poor page performance. Custom CSS classes are used to create
						custom components and custom utility classes.</p>
					<p class="mb-0">Before working with this theme, you should become familiar with the
						Bootstrap framework, especially the utility classes.</p>
				</div>
			</div>
		</div>

		<div class="col-lg-6 mb-4">
			<!-- Illustrations -->
			<div class="card shadow mb-4" style="min-height: 30vh">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
				</div>
				<div class="card-body">
					<div class="text-center">
						<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
							src="img/undraw_posting_photo.svg" alt="">
					</div>
					<p>Add some quality, svg illustrations to your project courtesy of <a target="_blank" rel="nofollow"
							href="https://undraw.co/">unDraw</a>, a
						constantly updated collection of beautiful svg images that you can use
						completely free and without attribution!</p>
				</div>
			</div>
		</div>
	</div>

</div>
<!-- /.container-fluid -->