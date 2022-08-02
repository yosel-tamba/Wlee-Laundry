<?php if ($this->session->flashdata('paket')) { ?>
    <div class="paket" data-flashdata="<?= $this->session->flashdata('paket'); ?>"></div>
<?php } ?>
<div class="card shadow">
    <div class="card-header d-sm-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Paket Cucian</h6>
        <div>
            <a href="<?= base_url() . 'paket' ?>" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            <a href="<?= base_url() . 'laporan/paket/' . $jenis ?>" target="_blank" class="btn btn-sm btn-success"><i class="fas fa-fw fa-download"></i> Buat Laporan</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Nama Outlet</th>
                        <?php if ($this->session->userdata('role') == 'Admin') { ?>
                            <th scope="col" class="text-center">Aksi</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($paket as $m) :
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $m->nama_paket; ?></td>
                            <td><?= $m->jenis; ?></td>
                            <td>Rp. <?= number_format($m->harga); ?></td>
                            <td>
                                <?php foreach ($outlet as $row) : ?>
                                    <?= $m->id_outlet == $row->id_outlet ? $row->nama : null ?>
                                <?php endforeach ?>
                            </td>
                            <?php if ($this->session->userdata('role') == 'Admin') { ?>
                                <td class="text-center">
                                    <a data-toggle="modal" data-target="#ubah<?= $m->id_paket ?>" class="btn btn-warning btn-sm" title="Ubah"><i class="fas fa-pen"></i></a>
                                    <a href="<?= base_url() . 'paket/hapus/' . $m->id_paket; ?>" class="btn btn-danger btn-sm tombol-hapus" title="Hapus Data"><i class="fa fa-fw fa-trash"></i></a>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Nama Outlet</th>
                        <?php if ($this->session->userdata('role') == 'Admin') { ?>
                            <th scope="col" class="text-center">Aksi</th>
                        <?php } ?>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Modal Ubah -->
<?php $no = 1;
foreach ($paket as $row) : ?>
    <div class="modal fade" id="ubah<?= $row->id_paket ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header card-header px-4">
                    <h5 class="modal-title text-primary font-weight-bold" id="exampleModalLabel">Ubah Data Paket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?= base_url('paket/aksi_ubah') ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row px-3">
                            <div class="col">
                                <div class="mb-3 row">
                                    <input type="hidden" name="id_paket" value="<?= $row->id_paket ?>">
                                    <div class="col">
                                        <label for="nama" class="col-formlabel">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama_paket" value="<?= $row->nama_paket ?>" autocomplete="off" required>
                                    </div>
                                    <div class="col">
                                        <label for="harga" class="col-formlabel">Harga</label>
                                        <input type="number" class="form-control" id="harga" name="harga" value="<?= $row->harga ?>" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col">
                                        <label for="jenis" class="col-formlabel">Jenis Paket</label>
                                        <select class="form-control" arialabel="Default select example" name="jenis">
                                            <option value="Satuan" <?= $row->jenis == "Satuan" ? 'selected' : null ?>>Satuan</option>
                                            <option value="Kiloan" <?= $row->jenis == "Kiloan" ? 'selected' : null ?>>Kiloan</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="id_outlet" class="col-formlabel">Outlet</label>
                                        <select class="form-control" arialabel="Default select example" name="id_outlet">
                                            <?php foreach ($outlet as $o) { ?>
                                                <option value="<?= $o->id_outlet ?>" <?= $row->id_outlet == $o->id_outlet ? 'selected' : null ?>><?= $o->nama ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <input type="submit" class="btn btn-primary " value="Simpan Data">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?>