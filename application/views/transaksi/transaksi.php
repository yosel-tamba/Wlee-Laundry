<?php if ($this->session->flashdata('transaksi')) { ?>
    <div class="transaksi" data-flashdata="<?= $this->session->flashdata('transaksi'); ?>"></div>
<?php } ?>
<div class="card shadow">
    <div class="card-header d-sm-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
        <form action="<?= base_url() . 'filter/aksi_filter_transaksi'; ?>" method="post">
            <div class="d-flex justify-content-end align-items-center">
                <div class="input-group input-group-sm mr-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="dari">Dari</span>
                    </div>
                    <input type="date" class="form-control form-control-sm" id="dari" name="dari" value="<?= date('Y-m-d') ?>">
                </div>
                <div class="input-group input-group-sm mr-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="sampai">Sampai</span>
                    </div>
                    <input type="date" class="form-control form-control-sm" id="sampai" name="sampai" value="<?= date('Y-m-d') ?>">
                </div>
                <input type="submit" class="btn btn-info btn-sm" value="Filter Data">
            </div>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode Invoice</th>
                        <th scope="col">Nama Pelanggan</th>
                        <th scope="col">Tanggal Masuk</th>
                        <th scope="col">Total Biaya</th>
                        <th scope="col">Status</th>
                        <?php if ($this->session->userdata('role') != 'Owner') { ?>
                            <th scope="col">Aksi</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($transaksi as $m) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $m->kode_invoice; ?></td>
                            <td><?= $m->nama_member; ?></td>
                            <td><?= $m->tgl; ?></td>
                            <td>Rp. <?= number_format($m->total_biaya); ?></td>
                            <td class="fw-bold
                            <?= $m->status == 'baru' ? 'text-danger' : null ?>
                            <?= $m->status == 'proses' ? 'text-warning' : null ?>
                            <?= $m->status == 'selesai' ? 'text-primary' : null ?>
                            <?= $m->status == 'diambil' ? 'text-success' : null ?>
                        "><?= $m->status; ?></td>
                            <?php if ($this->session->userdata('role') == 'Admin') { ?>
                                <td class="text-center">
                                    <a data-toggle="modal" data-target="#ubah<?= $m->id_transaksi ?>"" class=" btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="<?= base_url() . 'transaksi/hapus/' . $m->id_transaksi; ?>" class="btn btn-danger btn-sm tombol-hapus"><i class="fas fa-trash"></i></a>
                                </td>
                            <?php } ?>
                            <?php if ($this->session->userdata('role') == 'Kasir') { ?>
                                <td class="text-center">
                                    <a data-toggle="modal" data-target="#ubah<?= $m->id_transaksi ?>"" class=" btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode Invoice</th>
                        <th scope="col">Nama Pelanggan</th>
                        <th scope="col">Tanggal Masuk</th>
                        <th scope="col">Total Biaya</th>
                        <th scope="col">Status</th>
                        <?php if ($this->session->userdata('role') != 'Owner') { ?>
                            <th scope="col">Aksi</th>
                        <?php } ?>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>