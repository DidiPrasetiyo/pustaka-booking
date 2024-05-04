<div class="container-fluid">
    <?= $this->session->flashdata('pesan'); ?>
    <div class="row">
        <div class="col-lg-6">
            <?php if (validation_errors()) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Nama Kategori tidak boleh Kosong</div>');
                redirect('buku/updatekategori/' . $k['id_kategori']);
            } ?>
            <?php foreach ($kategori as $k) { ?>
                <form action="<?= base_url('buku/updateKategori'); ?>" method="post">
                    <div class="form-group">
                        <input type="hidden" name="id_kategori" id="id" value="<?php echo $k['id_kategori']; ?>">
                        <input type="text" class="form-control form-control-user" id="kategori" name="nama_kategori" placeholder="Masukkan Kategori Buku" value="<?= $k['nama_kategori']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="button" class="form-control form-control-user btn btn-dark col-lg-3 mt-3" value="Kembali" onclick="window.history.go(-1)">
                        <input type="submit" class="form-control form-control-user btn btn-primary col-lg-3 mt-3" value="Update">
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>
</div>
