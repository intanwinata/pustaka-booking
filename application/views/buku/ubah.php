
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-md-6">

        <div class="card">
            <div class="card-header">
                Form Ubah Data Buku
            </div>
            <div class="card-body">
                <form action="" method="post">
                        <input type="hidden" name="id" value="<?= $buku['id']; ?>">
                    <div class="form-group">
                        <label for="nama">Judul</label>
                        <input type="text" class="form-control" name="judul_buku" id="judul_buku" value="<?= $buku['judul_buku']; ?>">
                        <small class="form-text text-danger"><?= form_error('judul_buku'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="pengarang">Pengarang</label>
                        <input type="text" class="form-control" name="pengarang" id="pengarang" value="<?= $buku['pengarang']; ?>">
                        <small class="form-text text-danger"><?= form_error('pengarang'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="penerbit">Penerbit</label>
                        <input type="text" class="form-control" name="penerbit" id="penerbit" value="<?= $buku['penerbit']; ?>">
                        <small class="form-text text-danger"><?= form_error('penerbit'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="tahun_terbit">Tahun Terbit</label>
                        <input type="text" class="form-control" name="tahun_terbit" id="tahun_terbit" value="<?= $buku['tahun_terbit']; ?>">
                        <small class="form-text text-danger"><?= form_error('tahun_terbit'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="isbn">ISBN</label>
                        <input type="text" class="form-control" name="isbn" id="isbn" value="<?= $buku['isbn']; ?>">
                        <small class="form-text text-danger"><?= form_error('isbn'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="text" class="form-control" name="stok" id="stok" value="<?= $buku['stok']; ?>">
                        <small class="form-text text-danger"><?= form_error('buku'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="dipinjam">DiPinjam</label>
                        <input type="text" class="form-control" name="dipinjam" id="dipinjam" value="<?= $buku['dipinjam']; ?>">
                        <small class="form-text text-danger"><?= form_error('dipinjam'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="dibooking">DiBooking</label>
                        <input type="text" class="form-control" name="dibooking" id="dibooking" value="<?= $buku['dibooking']; ?>">
                        <small class="form-text text-danger"><?= form_error('dibooking'); ?></small>
                    </div>
                    <button type="submit" name="ubah" class="btn btn-primary float-right">Ubah Data</button>
                </form>
            </div>
        </div>

        </div>
    </div>
</div>