<?php $no = 1;
foreach ($transaksi as $row) :
    $harga_paket = 0;
    $qty = 0;
    $where = ['id_transaksi' => $row->id_transaksi];
    $id_paket = $this->m_crud->edit_data($where, 'tb_detail_transaksi')->result();
    foreach ($id_paket as $data) {
        $qty = $data->qty;
        $where = ['id_paket' => $data->id_paket];
        $detail = $this->m_crud->edit_data($where, 'tb_paket')->result();
        foreach ($detail as $p) {
            $harga_paket += $p->harga * $qty;
        }
    }
    $harga_awal = $harga_paket + $row->biaya_tambahan + $row->pajak;
    $harga_diskon = ($row->diskon / 100) * $harga_awal;
    $total_biaya = ceil($harga_awal - $harga_diskon);
?>
    <?php if ($this->session->flashdata('transaksi')) { ?>
        <div class="transaksi" data-flashdata="<?= $this->session->flashdata('transaksi'); ?>"></div>
    <?php } ?>
    <div class="card shadow">
        <div class="card-header d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Detail Transaksi</h6>
        </div>
        <form method="post" name="detail" action="<?= base_url('transaksi/detail_aksi') ?>" enctype="multipart/form-data">
            <input type="hidden" name="id_transaksi" value="<?= $row->id_transaksi ?>">
            <input type="hidden" name="harga_paket" value="<?= $harga_paket ?>">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="kode_invoice" class="col-formlabel">Kode Invoice</label>
                                <input type="text" class="form-control" id="kode_invoice" name="kode_invoice" value="<?= $row->kode_invoice ?>" disabled>
                            </div>
                            <div class="col">
                                <label for="id_member" class="col-formlabel">Pelanggan</label>
                                <select class="custom-select" arialabel="Default select example" name="id_member">
                                    <?php foreach ($member as $m) { ?>
                                        <option value="<?= $m->id_member ?>" <?= $row->id_member == $m->id_member ? 'selected' : null ?>><?= $m->nama_member ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col">
                                <label for="status" class="col-formlabel">Status</label>
                                <select class="custom-select" arialabel="Default select example" name="status">
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
                                <select class="custom-select text-gray-900" arialabel="Default select example" disabled name="id_outlet">
                                    <?php foreach ($outlet as $o) { ?>
                                        <option value="<?= $o->id_outlet ?>" <?= $o->id_outlet == $row->id_outlet ? 'selected' : null ?>><?= $o->nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col">
                                <label for="id_user" class="col-formlabel">Pengguna</label>
                                <select class="custom-select" arialabel="Default select example" name="id_user">
                                    <?php foreach ($pengguna as $u) { ?>
                                        <option value="<?= $u->id_user ?>" <?= $row->id_user == $u->id_user ? 'selected' : null ?>><?= $u->nama_user ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col">
                                <label for="tgl" class="col-formlabel">Tanggal Masuk</label>
                                <input type="date" class="form-control" id="tgl" name="tgl" value="<?= $row->tgl ?>">
                            </div>
                            <div class="col">
                                <label for="tgl_bayar" class="col-formlabel">Tanggal Bayar</label>
                                <input type="date" class="form-control" id="tgl_bayar" name="tgl_bayar" value="<?= date('Y-m-d') ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
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
                        <div class=" row">
                            <div class="col-lg-4">
                                <label for="id_paket" class="col-formlabel">Tambah Paket</label>
                                <select class="custom-select" id="id_paket" name="id_paket" onChange="document.location.href=this.options[this.selectedIndex].value;">
                                    <option value="" disabled selected>-- Pilih Paket --</option>
                                    <?php
                                    $where_paket = ['id_outlet' => $row->id_outlet];
                                    $paket = $this->m_crud->edit_data($where_paket, 'tb_paket')->result();
                                    foreach ($paket as $p) {
                                    ?>
                                        <option class="d-flex justify-content-between" value="<?= base_url('transaksi/tambah_paket/') . $p->id_paket . "/" . $row->id_transaksi ?>"><?= $p->nama_paket ?> | Rp. <?= $p->harga ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-8">
                                <label for="id_paket" class="col-formlabel">Paket</label>
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Nama Paket</th>
                                                <th class="text-center">Harga</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-center">Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $where = ['id_transaksi' => $row->id_transaksi];
                                            $id_paket = $this->m_crud->edit_data($where, 'tb_detail_transaksi')->result();
                                            foreach ($id_paket as $data) {
                                                $where = ['id_paket' => $data->id_paket];
                                                $detail = $this->m_crud->edit_data($where, 'tb_paket')->result();
                                                foreach ($detail as $p) {
                                            ?>
                                                    <tr>
                                                        <td class="text-center"><?= $data->id_paket == $p->id_paket ? $p->nama_paket : null ?></td>
                                                        <td class="text-center">Rp. <?= $data->id_paket == $p->id_paket ? number_format($p->harga, 0, ",", ".") : null ?></td>
                                                        <td class="text-center"><?= $data->qty ?></td>
                                                        <td class="text-center">
                                                            <a href="<?= base_url('transaksi/hapus_paket/') . $data->id_detail_transaksi ?>" class="btn btn-danger btn-sm tombol-hapus"><i class="fas fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-auto">
                        <div class="row d-flex align-items-center">
                            <div class="col-auto">
                                <h3 for="total_biaya" class="fw-bold">Total Biaya</h3>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control fw-bold form-control-lg" id="total_biaya" name="total_biaya" value="Rp. <?= number_format($total_biaya, 0, ",", ".") ?>" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg text-right mt-1">
                        <a href="<?= base_url('transaksi/nota/' . $row->id_transaksi); ?>" target="blank" class="btn btn-danger"> Print Nota </a>
                        <input type="submit" class="btn btn-primary " value="Simpan Data">
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php endforeach ?>