<?php $no = 1;
foreach ($transaksi as $row) : ?>
    <div class="modal fade" id="ubah<?= $row->id_transaksi ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header card-header px-4">
                    <h5 class="modal-title text-primary font-weight-bold" id="exampleModalLabel">Detail Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" name="detail" action="<?= base_url('transaksi/detail_aksi') ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row px-3">
                            <div class="col">
                                <div class="mb-3 row">
                                    <div class="col">
                                        <label for="id_transaksi" class="col-formlabel">ID Transaksi</label>
                                        <input type="text" class="form-control" id="id_transaksi" name="id_transaksi" value="<?= $row->id_transaksi ?>" readonly>
                                    </div>
                                    <div class="col">
                                        <label for="kode_invoice" class="col-formlabel">Kode Invoice</label>
                                        <input type="text" class="form-control" id="kode_invoice" name="kode_invoice" value="<?= $row->kode_invoice ?>" readonly>
                                    </div>
                                    <div class="col">
                                        <label for="status" class="col-formlabel">Status</label>
                                        <select class="form-control" arialabel="Default select example" name="status">
                                            <option value="baru" <?= $row->status == 'baru' ? 'selected' : null ?>>baru</option>
                                            <option value="proses" <?= $row->status == 'proses' ? 'selected' : null ?>>proses</option>
                                            <option value="selesai" <?= $row->status == 'selesai' ? 'selected' : null ?>>selesai</option>
                                            <option value="diambil" <?= $row->status == 'diambil' ? 'selected' : null ?>>diambil</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col">
                                        <label for="id_outlet" class="col-formlabel">Outlet</label>
                                        <select class="form-control" arialabel="Default select example" name="id_outlet">
                                            <?php

                                            foreach ($outlet as $o) {
                                            ?>
                                                <option value="<?= $o->id_outlet ?>" <?= $o->id_outlet == $row->id_outlet ? 'selected' : null ?>><?= $o->nama ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="id_user" class="col-formlabel">Pengguna</label>
                                        <select class="form-control" arialabel="Default select example" name="id_user">
                                            <?php foreach ($pengguna as $u) { ?>
                                                <option value="<?= $u->id_user ?>" <?= $row->id_user == $u->id_user ? 'selected' : null ?>><?= $u->nama_user ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="harga" class="col-formlabel">Paket</label>
                                        <select class="form-control" arialabel="Default select example" name="harga_paket" onfocus="startCalc();" onblur="stopCalc();">
                                            <?php foreach ($paket as $p) { ?>
                                                <option value="<?= $p->harga ?>" <?= $row->harga_paket == $p->harga ? 'selected' : null ?>><?= $p->nama_paket ?> - Rp <?= number_format($p->harga) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="id_member" class="col-formlabel">Pelanggan</label>
                                        <select class="form-control" arialabel="Default select example" name="id_member">
                                            <?php foreach ($member as $m) { ?>
                                                <option value="<?= $m->id_member ?>" <?= $row->id_member == $m->id_member ? 'selected' : null ?>><?= $m->nama_member ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col">
                                        <label for="tgl" class="col-formlabel">Tanggal Masuk</label>
                                        <input type="date" class="form-control" id="tgl" name="tgl" value="<?= $row->tgl ?>">
                                    </div>
                                    <div class="col">
                                        <label for="tgl_bayar" class="col-formlabel">Tanggal Bayar</label>
                                        <input type="date" class="form-control" id="tgl_bayar" name="tgl_bayar" value="<?= date('Y-m-d') ?>">
                                    </div>
                                </div>
                                <div class="mb-4 row">
                                    <div class="col">
                                        <label for="jumlah_paket" class="col-formlabel">Jumlah Paket</label>
                                        <input type="number" class="form-control" id="jumlah_paket" name="jumlah_paket" value="<?= $row->jumlah_paket ?>" onfocus="startCalc();" onblur="stopCalc();" autocomplete="off" required>
                                    </div>
                                    <div class="col">
                                        <label for="biaya_tambahan" class="col-formlabel">Biaya Tambahan</label>
                                        <input type="number" class="form-control" id="biaya_tambahan" name="biaya_tambahan" value="<?= $row->biaya_tambahan ?>" onfocus="startCalc();" onblur="stopCalc();" autocomplete="off" required>
                                    </div>
                                    <div class="col">
                                        <label for="pajak" class="col-formlabel">Pajak</label>
                                        <input type="number" class="form-control" id="pajak" name="pajak" value="<?= $row->pajak ?>" onfocus="startCalc();" autocomplete="off" onblur="stopCalc();" required>
                                    </div>
                                    <div class="col">
                                        <label for="diskon" class="col-formlabel">Diskon</label>
                                        <input type="number" class="form-control" id="diskon" name="diskon" value="<?= $row->diskon ?>" onfocus="startCalc();" autocomplete="off" onblur="stopCalc();" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col">
                                        <h3 for="total_biaya" class="col-formlabel">Total Biaya</h2>
                                            <input type="number" class="form-control form-control-lg" id="total_biaya" name="total_biaya" value="<?= $row->total_biaya ?>" onchange="tryNumberFormat(this.form.thirdBox);" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="<?= base_url('transaksi/nota/' . $row->id_transaksi); ?>" target="blank" class="btn btn-danger"> Print Nota </a>
                        <input type="submit" class="btn btn-primary " value="Simpan Data">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?>