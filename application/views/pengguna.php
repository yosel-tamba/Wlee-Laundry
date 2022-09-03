<?php if ($this->session->flashdata('pengguna')) { ?>
    <div class="pengguna" data-flashdata="<?= $this->session->flashdata('pengguna'); ?>"></div>
<?php } ?>
<?php if ($this->session->flashdata('gagal_simpan')) { ?>
    <div class="gagal_simpan" data-flashdata="<?= $this->session->flashdata('gagal_simpan'); ?>"></div>
<?php } ?>
<div class="card shadow">
    <div class="card-header d-sm-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Pengguna</h6>
        <div class="d-flex justify-content-between">
            <div class="dropdown mr-1">
                <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-filter"></i> Filter Data
                </button>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Role</div>
                    <a class="dropdown-item" href="<?= base_url('filter/pengguna/Semua') ?>">Semua</a>
                    <a class="dropdown-item" href="<?= base_url('filter/pengguna/Admin') ?>">Admin</a>
                    <a class="dropdown-item" href="<?= base_url('filter/pengguna/Kasir') ?>">Kasir</a>
                    <a class="dropdown-item" href="<?= base_url('filter/pengguna/Owner') ?>">Owner</a>
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
                                <?php foreach ($outlet as $row) { ?>
                                    <?= $row->id_outlet == $m->id_outlet ? $row->nama : null ?>
                                <?php } ?>
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

<!-- Modal Tambah -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header card-header px-4">
                <h5 class="modal-title text-primary font-weight-bold" id="exampleModalLabel">Tambah Data Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-primary">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('pengguna/aksi_tambah') ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <?php if (!empty(validation_errors())) { ?>
                        <div class="alert alert-danger font-italic font-weight-bold" role="alert">
                            <?= validation_errors() ?>
                        </div>
                    <?php } ?>
                    <div class="row px-2">
                        <div class="col-lg-4">
                            <div class=" text-center ">
                                <label for="nama">Foto Profil</label>
                                <p>
                                    <input accept="image/*" type='file' id="foto" name="foto" onchange="loadFile(event)" style="display: none;">
                                </p>
                                <span>
                                    <img class="rounded-circle border border-secondary" id="output" width="200px" height="200px" src="<?= base_url('assets/img/foto_profil/user.png') ?>" />
                                </span>
                                <p>
                                    <label for="foto" class="btn btn-info mt-2" style="cursor: pointer;">Unggah Foto</label>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="mb-3 row">
                                <div class="col">
                                    <label for="nama" class="col-formlabel">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama_user" autocomplete="off" value="<?= set_value('nama_user'); ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <label for="username" class="col-formlabel">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" autocomplete="off" value="<?= set_value('username'); ?>">
                                </div>
                                <div class="col">
                                    <label for="password" class="col-formlabel">Password</label>
                                    <input type="text" class="form-control" id="password" name="password" autocomplete="off" value="<?= set_value('password'); ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <label for="id_outlet" class="col-formlabel">Outlet</label>
                                    <select class="custom-select" arialabel="Default select example" name="id_outlet">
                                        <option value="" disabled selected>Pilih Outlet</option>
                                        <?php foreach ($outlet as $row) { ?>
                                            <option value="<?= $row->id_outlet ?>" <?= set_value('id_outlet') == $row->id_outlet ? 'selected' : null ?>><?= $row->nama ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="role" class="col-formlabel">Role</label>
                                    <select class="custom-select" arialabel="Default select example" name="role">
                                        <option value="" disabled selected>Pilih Role</option>
                                        <option value="Admin" <?= set_value('role') == 'Admin' ? 'selected' : null ?>>Admin</option>
                                        <option value="Kasir" <?= set_value('role') == 'Kasir' ? 'selected' : null ?>>Kasir</option>
                                        <option value="Owner" <?= set_value('role') == 'Owner' ? 'selected' : null ?>>Owner</option>
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
<?php
$no = 1;
foreach ($user as $row) : ?>
    <div class="modal fade" id="ubah<?= $row->id_user ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header card-header px-4">
                    <h5 class="modal-title text-primary font-weight-bold" id="exampleModalLabel">Ubah Data Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-primary">&times;</span>
                    </button>
                </div>
                <form method="post" action="<?= base_url('pengguna/aksi_ubah') ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <?php if (!empty(validation_errors())) { ?>
                            <div class="alert alert-danger font-italic font-weight-bold" role="alert">
                                <?= validation_errors() ?>
                            </div>
                        <?php } ?>
                        <div class="row px-2">
                            <div class="col-lg-4">
                                <div class=" text-center ">
                                    <input type='hidden' name="foto_default" value="<?= $row->foto ?>">
                                    <label for="nama">Foto Profil</label>
                                    <!-- <p>
                                        <input accept="image/*" type='file' id="foto1" name="foto" onchange="loadFile1(event)" style="display: none;">
                                    </p> -->
                                    <span>
                                        <img class="rounded-circle border border-secondary" id="output1" width="200px" height="200px" src="<?= base_url('assets/img/foto_profil/') . $row->foto ?>" />
                                    </span>
                                    <!-- <p>
                                        <label for="foto1" class="btn btn-info mt-2" style="cursor: pointer;">Unggah Foto</label>
                                    </p> -->
                                </div>
                            </div>
                            <div class="col-lg-8">
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
                                        <select class="custom-select" arialabel="Default select example" name="id_outlet">
                                            <?php foreach ($outlet as $o) { ?>
                                                <option value="<?= $o->id_outlet ?>" <?= $row->id_outlet == $o->id_outlet ? 'selected' : null ?>><?= $o->nama ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="role" class="col-formlabel">Role</label>
                                        <select class="custom-select" arialabel="Default select example" name="role">
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

<script type="text/javascript">
    // Tambah
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
    // Ubah
    // var loadFile1 = function(event) {
    //     var output1 = document.getElementById('output1');
    //     output1.src = URL.createObjectURL(event.target.files[0]);
    // };
</script>