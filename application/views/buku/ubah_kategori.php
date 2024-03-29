<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9">
            <?= $this->session->flashdata('pesan'); ?>
                <div class="form-group row">
                    <div class="col-lg-3">
                        <?php if (validation_errors()) {
                            $this->session->set_flashdata('pesan', 'div class="alert alert-danger alert-message" role="alert> Nama Katergori Tidak Boleh Kosong</div>');
                            redirect ('buku/ubahKategori/' . $k['id']);
                        } ?>
                        <?php foreach ($kategori as $k) { ?>
                            <form action="<?= base_url('buku/ubahKategori'); ?>" method="post">
                                <div class="from-group">
                                    <input type="hidden" name="id" id="id" value="<?php echo $k['id']; ?>">
                                    <input type="text" class="form-control form-control-user" id="kategori" name="kategori" placeholder="Masukan Kategori Buku" value="<?= $k['kategori']; ?>">
                                </div>
                                <div class="form-group">
                                    <input type="button" class="form-control form-control-user btn btn-dark col-lg-6 mt-3" value="Kembali" onclick="window.history.go(-1)">
                                    <input type="submit" class="form-control form-control-user btn btn-primary col-lg-6 mt-3" value="Update">
                                </div>
                            </form>
                    <?php } ?>
                    </div>
                </div>
        </div>
    </div>                  
</div> 