<?php if ($this->session->flashdata('registrasi')) { ?>
    <div class="registrasi" data-flashdata="<?= $this->session->flashdata('registrasi'); ?>"></div>
<?php } ?>
<?php if ($this->session->flashdata('gagal_simpan')) { ?>
    <div class="gagal_simpan" data-flashdata="<?= $this->session->flashdata('gagal_simpan'); ?>"></div>
<?php } ?>
<div class="card shadow">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Registrasi Pelanggan</h6>
    </div>
    <form method="post" action="<?= base_url('Registrasi/aksi_registrasi') ?>" enctype="multipart/form-data">
        <div class="card-body container">
            <?php if (!empty(validation_errors())) { ?>
                <div class="alert alert-danger font-italic font-weight-bold" role="alert">
                    <?= validation_errors() ?>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col">
                    <div class="mb-3 row">
                        <div class="col">
                            <label for="nama" class="col-formlabel">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama_member" autocomplete="off" value="<?= set_value('nama_member'); ?>">
                        </div>
                        <div class="col">
                            <label for="tlp" class="col-formlabel">Nomor Telepon</label>
                            <input type="number" class="form-control" id="tlp" name="tlp" autocomplete="off" value="<?= set_value('tlp'); ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col">
                            <label for="alamat" class="col-formlabel">Alamat</label>
                            <textarea type="text" class="form-control" id="alamat" name="alamat" autocomplete="off"><?= set_value('alamat'); ?></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col">
                            <label for="jenis_kelamin" class="col-formlabel">Jenis Kelamin</label>
                            <select class="custom-select" arialabel="Default select example" name="jenis_kelamin">
                                <option selected disabled value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki" <?= set_value('jenis_kelamin') == 'Laki-Laki' ? 'selected' : null ?>>Laki-Laki</option>
                                <option value="Perempuan" <?= set_value('jenis_kelamin') == 'Perempuan' ? 'selected' : null ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="id_user" class="col-formlabel">Pengguna</label>
                            <select class="custom-select" arialabel="Default select example" name="id_user">
                                <option disabled selected value="">Pilih Pengguna</option>
                                <?php foreach ($user as $u) { ?>
                                    <option value="<?= $u->id_user ?>" <?= set_value('id_user') == $u->id_user ? 'selected' : null ?>><?= $u->nama_user ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col">
                            <label for="id_outlet" class="col-formlabel">Outlet</label>
                            <select class="custom-select" arialabel="Default select example" name="id_outlet" id="id_outlet">
                                <option disabled selected value="">Pilih Outlet</option>
                                <?php foreach ($outlet as $o) { ?>
                                    <option value="<?= $o->id_outlet ?>" <?= set_value('id_outlet') == $o->id_outlet ? 'selected' : null ?>><?= $o->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="diskon" class="col-formlabel">Diskon</label>
                            <input type="text" class="form-control" id="diskon" name="diskon" autocomplete="off" value="<?= set_value('diskon'); ?>">
                        </div>
                    </div>
                    <div id="paket"></div>
                    <script src="assets/js/jquery.js"></script>
                    <script>
                        $(document).ready(function() {
                            $("#id_outlet").change(function() {
                                $("#paket").val();
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo base_url("index.php/registrasi/listPaket"); ?>",
                                    data: {
                                        id_outlet: $("#id_outlet").val()
                                    },
                                    dataType: "json",
                                    beforeSend: function(e) {
                                        if (e && e.overrideMimeType) {
                                            e.overrideMimeType("application/json;charset=UTF-8");
                                        }
                                    },
                                    success: function(response) {
                                        $("#paket").html(response.list_paket).show();
                                    },
                                    error: function(xhr, ajaxOptions, thrownError) {
                                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                                    }
                                });
                            });
                        });
                    </script>
                    <!-- hidden -->
                    <input type="hidden" name="kode_invoice" value="<?= "INVC-" . (rand(100000000, 999999999)); ?>">
                    <input type="hidden" name="tgl" value="<?= date('Y-m-d') ?>">
                    <input type="hidden" name="status" value="baru">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <input type="submit" class="btn btn-primary" value="Simpan Data">
        </div>
    </form>
</div>