<?php if ($this->session->flashdata('pengguna')) { ?>
    <div class="pengguna" data-flashdata="<?= $this->session->flashdata('pengguna'); ?>"></div>
<?php } ?>
<div class="card shadow">
    <div class="card-header d-sm-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Pelanggan</h6>
        <div>
            <a href="<?= base_url() . 'pengguna' ?>" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            <a class="btn btn-success btn-sm" href="<?= base_url() . 'laporan/pengguna/' . $role ?>" target="_blank" role="button"><i class="fas fa-fw fa-download"></i> Buat Laporan</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Role</th>
                        <th scope="col">Nama Outlet</th>
                        <?php if ($this->session->userdata('role') == 'Admin') { ?>
                            <th scope="col" class="text-center">Aksi</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($user as $m) :
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $m->nama_user; ?></td>
                            <td><?= $m->username; ?></td>
                            <td><?= $m->passconf; ?></td>
                            <td><?= $m->role; ?></td>
                            <td>
                                <?php foreach ($outlet as $row) : ?>
                                    <?= $m->id_outlet == $row->id_outlet ? $row->nama : null ?>
                                <?php endforeach ?>
                            </td>
                            <?php if ($this->session->userdata('role') == 'Admin') { ?>
                                <td class="text-center">
                                    <a data-toggle="modal" data-target="#ubah<?= $m->id_user ?>" class="btn btn-warning btn-sm" title="Ubah"><i class="fas fa-pen"></i></a>
                                    <a href="<?= base_url() . 'pengguna/hapus/' . $m->id_user; ?>" class="btn btn-danger btn-sm tombol-hapus" title="Hapus Data"><i class="fa fa-fw fa-trash"></i></a>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Role</th>
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
foreach ($user as $row) : ?>
    <div class="modal fade" id="ubah<?= $row->id_user ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header card-header px-4">
                    <h5 class="modal-title text-primary font-weight-bold" id="exampleModalLabel">Ubah Data Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?= base_url('pengguna/aksi_ubah') ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row px-3">
                            <div class="col">
                                <div class="mb-3 row">
                                    <input type="hidden" name="id_user" value="<?= $row->id_user ?>">
                                    <div class="col">
                                        <label for="nama" class="col-formlabel">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama_user" value="<?= $row->nama_user ?>" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col">
                                        <label for="username" class="col-formlabel">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" value="<?= $row->username ?>" autocomplete="off" required>
                                    </div>
                                    <div class="col">
                                        <label for="password" class="col-formlabel">Password</label>
                                        <input type="text" class="form-control" id="password" name="password" value="<?= $row->passconf ?>" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col">
                                        <label for="id_outlet" class="col-formlabel">Outlet</label>
                                        <select class="form-control" arialabel="Default select example" name="id_outlet">
                                            <?php foreach ($outlet as $o) { ?>
                                                <option value="<?= $o->id_outlet ?>" <?= $row->id_outlet == $o->id_outlet ? 'selected' : null ?>><?= $o->nama ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="role" class="col-formlabel">Role</label>
                                        <select class="form-control" arialabel="Default select example" name="role">
                                            <option value="Admin" <?= $row->role == "Admin" ? 'selected' : null ?>>Admin</option>
                                            <option value="Kasir" <?= $row->role == "Kasir" ? 'selected' : null ?>>Kasir</option>
                                            <option value="Owner" <?= $row->role == "Owner" ? 'selected' : null ?>>Owner</option>
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