<div class="card shadow">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Registrasi Transaksi</h6>
    </div>
    <div class="card-body">
        <form method="post" action="<?= base_url('registrasi/aksi_next') ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="col">
                    <div class="mb-3 row">
                        <div class="col">
                            <label for="id_outlet" class="col-formlabel">Outlet</label>
                            <select class="form-control" arialabel="Default select example" name="id_outlet" required>
                                <option>Pilih Outlet</option>
                                <?php foreach ($outlet as $o) { ?>
                                    <option value="<?= $o->id_outlet ?>"><?= $o->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="id_user" class="col-formlabel">Pengguna</label>
                            <select class="form-control" arialabel="Default select example" name="id_user" required>
                                <option>Pilih Pengguna</option>
                                <?php foreach ($user as $u) { ?>
                                    <option value="<?= $u->id_user ?>"><?= $u->nama_user ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="harga" class="col-formlabel">Paket</label>
                            <select class="form-control" arialabel="Default select example" name="harga_paket" required>
                                <option>Pilih Paket</option>
                                <?php foreach ($paket as $p) { ?>
                                    <option value="<?= $p->harga ?>"><?= $p->nama_paket ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col">
                            <label for="kode_invoice" class="col-formlabel">Kode Invoice</label>
                            <input type="text" class="form-control" id="kode_invoice" name="kode_invoice" value="<?= "INVC-" . (rand(100000000, 999999999)); ?>" readonly>
                        </div>
                        <div class="col">
                            <label for="tgl" class="col-formlabel">Tanggal Masuk</label>
                            <input type="date" class="form-control" id="tgl" name="tgl" value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="col">
                            <label for="diskon" class="col-formlabel">Diskon</label>
                            <input type="number" class="form-control" id="diskon" name="diskon" autocomplete="off" required>
                        </div>
                        <!-- hidden -->
                        <select hidden name="id_member">
                            <?php foreach ($member as $m) { ?>
                                <option value="<?= $m->id_member ?>"><?= $m->nama_member ?></option>
                            <?php } ?>
                        </select>
                        <input type="hidden" name="status" value="baru">
                    </div>
                    <input type="submit" class="btn btn-success" value="Simpan Data">
                </div>
            </div>
        </form>
    </div>
</div>