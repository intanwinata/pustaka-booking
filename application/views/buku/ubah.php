<div class="container-fluid">
	<div class="row mt-3">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					Form Ubah Data Buku
				</div>
				<div class="card-body">
					<?php if (validation_errors()) {
                            $this->session->set_flashdata('pesan', 'div class="alert alert-danger alert-message" role="alert> Nama Katergori Tidak Boleh Kosong</div>');
                            redirect ('buku/ubahBuku/' . $buku[0]->id);
                    } ?>
					<form action="<? base_url('buku/ubahBuku'); ?>" method="post">
						<input type="hidden" name="id" value="<?= $buku[0]->id; ?>">
						<div class="from-group">
							<input type="text" class="form-control form-control-user" id="kategori" name="kategori"
								placeholder="Masukan Kategori Buku" value="<?= $kategori[0]->kategori; ?>">
						</div>
						<div class="form-group">
							<label for="nama">Judul</label>
							<input type="text" class="form-control" name="judul_buku" id="judul_buku"
								value="<?= $buku[0]->judul_buku; ?>">
							<small class="form-text text-danger"><? form_error('judul_buku'); ?></small>
						</div>
						<div class="form-group">
							<label for="pengarang">Pengarang</label>
							<input type="text" class="form-control" name="pengarang" id="pengarang"
								value="<?= $buku[0]->pengarang; ?>">
							<small class="form-text text-danger"><? form_error('pengarang'); ?></small>
						</div>
						<div class="form-group">
							<label for="penerbit">Penerbit</label>
							<input type="text" class="form-control" name="penerbit" id="penerbit"
								value="<?= $buku[0]->penerbit; ?>">
							<small class="form-text text-danger"><? form_error('penerbit'); ?></small>
						</div>
						<div class="form-group">
							<label for="tahun_terbit">Tahun Terbit</label>
							<input type="text" class="form-control" name="tahun_terbit" id="tahun_terbit"
								value="<?= $buku[0]->tahun_terbit; ?>">
							<small class="form-text text-danger"><? form_error('tahun_terbit'); ?></small>
						</div>
						<div class="form-group">
							<label for="isbn">ISBN</label>
							<input type="text" class="form-control" name="isbn" id="isbn" value="<?= $buku[0]->isbn; ?>">
							<small class="form-text text-danger"><? form_error('isbn'); ?></small>
						</div>
						<div class="form-group">
							<label for="stok">Stok</label>
							<input type="text" class="form-control" name="stok" id="stok" value="<?= $buku[0]->stok; ?>">
							<small class="form-text text-danger"><? form_error('stok'); ?></small>
						</div>
						<div class="form-group">
							<label for="dipinjam">DiPinjam</label>
							<input type="text" class="form-control" name="dipinjam" id="dipinjam"
								value="<?= $buku[0]->dipinjam; ?>">
							<small class="form-text text-danger"><? form_error('dipinjam'); ?></small>
						</div>
						<div class="form-group">
							<label for="dibooking">DiBooking</label>
							<input type="text" class="form-control" name="dibooking" id="dibooking"
								value="<?= $buku[0]->dibooking; ?>">
							<small class="form-text text-danger"><? form_error('dibooking'); ?></small>
						</div>
						<button type="submit" name="ubah" class="btn btn-primary float-right">Ubah Data</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>