<?php if ($this->session->flashdata('registrasi')) { ?>
    <div class="registrasi" data-flashdata="<?= $this->session->flashdata('registrasi'); ?>"></div>
<?php } ?>
<div class="card shadow">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Registrasi Pelanggan</h6>
    </div>
    <div class="card-body">
        <form method="post" action="<?= base_url('Registrasi/aksi_tambah') ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="col">
                    <div class="mb-3 row">
                        <div class="col">
                            <label for="nama" class="col-formlabel">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama_member" autocomplete="off" required>
                        </div>
                        <div class="col">
                            <label for="tlp" class="col-formlabel">Nomor Telepon</label>
                            <input type="number" class="form-control" id="tlp" name="tlp" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col">
                            <label for="alamat" class="col-formlabel">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" autocomplete="off" required>
                        </div>
                        <div class="col">
                            <label for="jenis_kelamin" class="col-formlabel">Jenis Kelamin</label>
                            <select class="form-control" arialabel="Default select example" name="jenis_kelamin">
                                <option selected>Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-success" value="Selanjutnya">
                </div>
            </div>
        </form>
    </div>
</div>