<?php if ($this->session->flashdata('pelanggan')) { ?>
    <div class="pelanggan" data-flashdata="<?= $this->session->flashdata('pelanggan'); ?>"></div>
<?php } ?>
<?php if ($this->session->flashdata('gagal_simpan')) { ?>
    <div class="gagal_simpan" data-flashdata="<?= $this->session->flashdata('gagal_simpan'); ?>"></div>
<?php } ?>
<div class="card shadow">
    <div class="card-header d-sm-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Pelanggan</h6>
        <div class="d-flex justify-content-between">
            <div class="dropdown mr-1">
                <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-filter"></i> Filter Data
                </button>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Jenis Kelamin</div>
                    <a class="dropdown-item" href="<?= base_url('filter/pelanggan/Semua') ?>">Semua</a>
                    <a class="dropdown-item" href="<?= base_url('filter/pelanggan/Laki-Laki') ?>">Laki-Laki</a>
                    <a class="dropdown-item" href="<?= base_url('filter/pelanggan/Perempuan') ?>">Perempuan</a>
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
                        <th scope="col">Telepon</th>
                        <th scope="col">Kelamin</th>
                        <th scope="col">Alamat</th>
                        <?php if ($this->session->userdata('role') == 'Admin') { ?>
                            <th scope="col" class="text-center">Aksi</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($member as $m) {
                        $kalimat = $m->alamat;
                        $limit = 40;
                        if (strlen($kalimat) > $limit) {
                            $alamat = substr($kalimat, 0, $limit) . "...";
                        } else {
                            $alamat = $kalimat;
                        }
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $m->nama_member; ?></td>
                            <td><?= $m->tlp; ?></td>
                            <td><?= $m->jenis_kelamin; ?></td>
                            <td><?= $alamat; ?></td>
                            <?php if ($this->session->userdata('role') == 'Admin') { ?>
                                <td class="text-center">
                                    <a data-toggle="modal" data-target="#ubah<?= $m->id_member ?>" class="btn btn-warning btn-sm" title="Ubah"><i class="fas fa-pen"></i></a>
                                    <a href="<?= base_url() . 'pelanggan/hapus/' . $m->id_member; ?>" class="btn btn-danger btn-sm tombol-hapus" title="Hapus Data"><i class="fa fa-fw fa-trash"></i></a>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Telepon</th>
                        <th scope="col">Kelamin</th>
                        <th scope="col">Alamat</th>
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
                <h5 class="modal-title text-primary font-weight-bold" id="exampleModalLabel">Tambah Data Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-primary">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('pelanggan/aksi_tambah') ?>" enctype="multipart/form-data">
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
                                    <input type="text" class="form-control" id="nama" name="nama_member" autocomplete="off" value="<?= set_value('nama_member'); ?>">
                                </div>
                                <div class="col">
                                    <label for="tlp" class="col-formlabel">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="tlp" name="tlp" autocomplete="off" value="<?= set_value('tlp'); ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <label for="alamat" class="col-formlabel">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" autocomplete="off" value="<?= set_value('alamat'); ?>">
                                </div>
                                <div class="col">
                                    <label for="jenis_kelamin" class="col-formlabel">Jenis Kelamin</label>
                                    <select class="custom-select" arialabel="Default select example" name="jenis_kelamin">
                                        <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-Laki" <?= set_value('jenis_kelamin') == 'Laki-Laki' ? 'selected' : null ?>>Laki-Laki</option>
                                        <option value="Perempuan" <?= set_value('jenis_kelamin') == 'Perempuan' ? 'selected' : null ?>>Perempuan</option>
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
<?php foreach ($member as $row) : ?>
    <div class="modal fade" id="ubah<?= $row->id_member ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header card-header px-4">
                    <h5 class="modal-title text-primary font-weight-bold" id="exampleModalLabel">Ubah Data Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-primary">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?= base_url('pelanggan/aksi_ubah') ?>" enctype="multipart/form-data">
                        <?php if (!empty(validation_errors())) { ?>
                            <div class="alert alert-danger font-italic font-weight-bold" role="alert">
                                <?= validation_errors() ?>
                            </div>
                        <?php } ?>
                        <div class="row px-2">
                            <div class="col">
                                <div class="mb-3 row">
                                    <input type="hidden" name="id_member" value="<?= $row->id_member ?>">
                                    <div class="col">
                                        <label for="nama" class="col-formlabel">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama_member" value="<?= $row->nama_member ?>" autocomplete="off" required>
                                    </div>
                                    <div class="col">
                                        <label for="tlp" class="col-formlabel">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="tlp" name="tlp" value="<?= $row->tlp ?>" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col">
                                        <label for="alamat" class="col-formlabel">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $row->alamat ?>" autocomplete="off" required>
                                    </div>
                                    <div class="col">
                                        <label for="jenis_kelamin" class="col-formlabel">Jenis Kelamin</label>
                                        <select class="custom-select" arialabel="Default select example" name="jenis_kelamin">
                                            <option value="Laki-Laki" <?= $row->jenis_kelamin == "Laki-Laki" ? 'selected' : null ?>>Laki-Laki</option>
                                            <option value="Perempuan" <?= $row->jenis_kelamin == "Perempuan" ? 'selected' : null ?>>Perempuan</option>
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