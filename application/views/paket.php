<?php if ($this->session->flashdata('paket')) { ?>
    <div class="paket" data-flashdata="<?= $this->session->flashdata('paket'); ?>"></div>
<?php } ?>
<?php if ($this->session->flashdata('gagal_simpan')) { ?>
    <div class="gagal_simpan" data-flashdata="<?= $this->session->flashdata('gagal_simpan'); ?>"></div>
<?php } ?>
<div class="card shadow">
    <div class="card-header d-sm-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Paket Cucian</h6>
        <div class="d-flex justify-content-between">
            <div class="dropdown mr-1">
                <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-filter"></i> Filter Data
                </button>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Jenis</div>
                    <a class="dropdown-item" href="<?= base_url('filter/paket/Semua') ?>">Semua</a>
                    <a class="dropdown-item" href="<?= base_url('filter/paket/Kiloan') ?>">Kiloan</a>
                    <a class="dropdown-item" href="<?= base_url('filter/paket/Satuan') ?>">Satuan</a>
                </div>
            </div>
            <?php if ($this->session->userdata('role') == 'Admin') { ?>
                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambah" role="button"><i class="fas fa-fw fa-plus"></i> Tambah Data</a>
            <?php } ?>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Outlet</th>
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
                            <td>Rp. <?= number_format($m->harga, 0, ",", "."); ?></td>
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
                        <th scope="col">Outlet</th>
                        <?php if ($this->session->userdata('role') == 'Admin') { ?>
                            <th scope="col" class="text-center">Aksi</th>
                        <?php } ?>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header card-header px-4">
                <h5 class="modal-title text-primary font-weight-bold" id="exampleModalLabel">Tambah Data Paket Cucian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-primary">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('paket/aksi_tambah') ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <?php if (!empty(validation_errors())) { ?>
                        <div class="alert alert-danger font-italic font-weight-bold" role="alert">
                            <?= validation_errors() ?>
                        </div>
                    <?php } ?>
                    <div class="row px-2">
                        <div class="col">
                            <div class="mb-3 row">
                                <div class="col">
                                    <label for="nama" class="col-formlabel">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama_paket" autocomplete="off" value="<?= set_value('nama_paket'); ?>">
                                </div>
                                <div class="col">
                                    <label for="harga" class="col-formlabel">Harga</label>
                                    <input type="text" class="form-control" id="harga" name="harga" autocomplete="off" value="<?= set_value('harga'); ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <label for="jenis" class="col-formlabel">Jenis Paket</label>
                                    <select class="custom-select" arialabel="Default select example" name="jenis">
                                        <option value="" disabled selected>Pilih Jenis</option>
                                        <option value="Satuan" <?= set_value('jenis') == 'Satuan' ? 'selected' : null ?>>Satuan</option>
                                        <option value="Kiloan" <?= set_value('jenis') == 'Kiloan' ? 'selected' : null ?>>Kiloan</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="id_outlet" class="col-formlabel">Outlet</label>
                                    <select class="custom-select" arialabel="Default select example" name="id_outlet">
                                        <option value="" disabled selected>Pilih Outlet</option>
                                        <?php foreach ($outlet as $row) { ?>
                                            <option value="<?= $row->id_outlet ?>" <?= set_value('id_outlet') == $row->id_outlet ? 'selected' : null ?>><?= $row->nama ?></option>
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

<!-- Modal Ubah -->
<?php $no = 1;
foreach ($paket as $row) : ?>
    <div class="modal fade" id="ubah<?= $row->id_paket ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header card-header px-4">
                    <h5 class="modal-title text-primary font-weight-bold" id="exampleModalLabel">Ubah Data Paket Cucian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-primary">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?= base_url('paket/aksi_ubah') ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <?php if (!empty(validation_errors())) { ?>
                            <div class="alert alert-danger font-italic font-weight-bold" role="alert">
                                <?= validation_errors() ?>
                            </div>
                        <?php } ?>
                        <div class="row px-2">
                            <div class="col">
                                <div class="mb-3 row">
                                    <input type="hidden" name="id_paket" value="<?= $row->id_paket ?>">
                                    <div class="col">
                                        <label for="nama" class="col-formlabel">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama_paket" value="<?= $row->nama_paket ?>" autocomplete="off">
                                    </div>
                                    <div class="col">
                                        <label for="harga" class="col-formlabel">Harga</label>
                                        <input type="text" class="form-control" id="harga" name="harga" value="<?= $row->harga ?>" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col">
                                        <label for="jenis" class="col-formlabel">Jenis Paket</label>
                                        <select class="custom-select" arialabel="Default select example" name="jenis">
                                            <option value="Satuan" <?= $row->jenis == "Satuan" ? 'selected' : null ?>>Satuan</option>
                                            <option value="Kiloan" <?= $row->jenis == "Kiloan" ? 'selected' : null ?>>Kiloan</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="id_outlet" class="col-formlabel">Outlet</label>
                                        <select class="custom-select" arialabel="Default select example" name="id_outlet">
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