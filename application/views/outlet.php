<?php if ($this->session->flashdata('outlet')) { ?>
    <div class="outlet" data-flashdata="<?= $this->session->flashdata('outlet'); ?>"></div>
<?php } ?>
<div class="card shadow">
    <div class="card-header d-sm-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Outlet</h6>
        <div>
            <a class="btn btn-success btn-sm" href="<?= base_url() . 'laporan/outlet' ?>" target="_blank" role="button"><i class="fas fa-fw fa-download"></i> Buat Laporan</a>
            <?php if ($this->session->userdata('role') == 'Admin') { ?>
                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambah" role="button"><i class="fas fa-fw fa-plus"></i> Tambah Data</a>
            <?php } ?>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Nomor Telepon</th>
                        <th scope="col">Alamat</th>
                        <?php if ($this->session->userdata('role') == 'Admin') { ?>
                            <th scope="col" class="text-center">Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($outlet as $m) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $m->nama; ?></td>
                            <td><?= $m->tlp; ?></td>
                            <td><?= $m->alamat; ?></td>
                            <?php if ($this->session->userdata('role') == 'Admin') { ?>
                                <td class="text-center">
                                    <a data-toggle="modal" data-target="#ubah<?= $m->id_outlet ?>" class="btn btn-warning btn-sm" title="Ubah"><i class="fas fa-pen"></i></a>
                                    <a href="<?= base_url() . 'outlet/hapus/' . $m->id_outlet; ?>" class="btn btn-danger btn-sm tombol-hapus" title="Hapus Data"><i class="fa fa-fw fa-trash"></i></a>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Nomor Telepon</th>
                        <th scope="col">Alamat</th>
                        <?php if ($this->session->userdata('role') == 'Admin') { ?>
                            <th scope="col" class="text-center">Action</th>
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
                <h5 class="modal-title text-primary font-weight-bold" id="exampleModalLabel">Tambah Data Outlet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('outlet/aksi_tambah') ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row px-3">
                        <div class="col">
                            <div class="mb-3 row">
                                <div class="col">
                                    <label for="nama" class="col-formlabel">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" required>
                                </div>
                                <div class="col">
                                    <label for="tlp" class="col-formlabel">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="tlp" name="tlp" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <label for="alamat" class="col-formlabel">Alamat</label>
                                    <textarea type="text" class="form-control" id="alamat" name="alamat" autocomplete="off" required></textarea>
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
foreach ($outlet as $row) : ?>
    <div class="modal fade" id="ubah<?= $row->id_outlet ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header card-header px-4">
                    <h5 class="modal-title text-primary font-weight-bold" id="exampleModalLabel">Ubah Data Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?= base_url('outlet/aksi_ubah') ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row px-3">
                            <div class="col">
                                <div class="mb-3 row">
                                    <input type="hidden" name="id_outlet" value="<?= $row->id_outlet ?>">
                                    <div class="col">
                                        <label for="nama" class="col-formlabel">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $row->nama ?>" autocomplete="off" required>
                                    </div>
                                    <div class="col">
                                        <label for="tlp" class="col-formlabel">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="tlp" name="tlp" value="<?= $row->tlp ?>" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col">
                                        <label for="alamat" class="col-formlabel">Alamat</label>
                                        <textarea type="text" class="form-control" id="alamat" name="alamat" autocomplete="off" required><?= $row->alamat ?></textarea>
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