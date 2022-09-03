        </div>
        </div>
        <footer class="sticky-footer bg-white mt-4">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    Full Made With <i class="fas fa-fw fa-heart text-primary"></i> by <strong class="text-primary">Yosel Mikoto</strong> 2021
                </div>
            </div>
        </footer>

        <!-- Modal Profil -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title text-primary font-weight-bold" id="exampleModalLabel">Ubah Profil</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-primary">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="<?= base_url('profil/aksi_ubah') ?>" enctype="multipart/form-data">
                        <div class="modal-body">
                            <?php if (!empty(validation_errors())) { ?>
                                <div class="alert alert-danger font-italic font-weight-bold" role="alert">
                                    <?= validation_errors() ?>
                                </div>
                            <?php } ?>
                            <div class="row px-2">
                                <div class="col-lg-4">
                                    <div class=" text-center ">
                                        <input type='hidden' name="foto_default" value="<?= $this->session->userdata('foto') ?>">
                                        <label for="nama">Foto Profil</label>
                                        <p>
                                            <input accept="image/*" type='file' id="foto2" name="foto" onchange="loadFile2(event)" style="display: none;">
                                        </p>
                                        <span>
                                            <img class="rounded-circle border border-secondary" id="output2" width="200px" height="200px" src="<?= base_url('assets/img/foto_profil/') . $this->session->userdata('foto') ?>" />
                                        </span>
                                        <p>
                                            <label for="foto2" class="btn btn-info mt-2" style="cursor: pointer;">Unggah Foto</label>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="mb-3 row">
                                        <input type="hidden" name="id_user" value="<?= $this->session->userdata('id') ?>">
                                        <div class="col">
                                            <label for="nama" class="col-formlabel">Nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama_user" value="<?= $this->session->userdata('nama_user') ?>" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col">
                                            <label for="username" class="col-formlabel">Username</label>
                                            <input type="text" class="form-control" id="username" name="username" value="<?= $this->session->userdata('username') ?>" autocomplete="off" required>
                                        </div>
                                        <div class="col">
                                            <label for="password" class="col-formlabel">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" value="<?= $this->session->userdata('password') ?>" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col">
                                            <label for="id_outlet" class="col-formlabel">Outlet</label>
                                            <select class="custom-select" arialabel="Default select example" name="id_outlet">
                                                <?php
                                                $outlet = $this->m_crud->get_data('id_outlet', 'tb_outlet')->result();
                                                foreach ($outlet as $o) { ?>
                                                    <option value="<?= $o->id_outlet ?>" <?= $this->session->userdata('outlet') == $o->id_outlet ? 'selected' : null ?>><?= $o->nama ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="role" class="col-formlabel">Role</label>
                                            <select disabled class="custom-select" arialabel="Default select example" name="role">
                                                <option value="Admin" <?= $this->session->userdata('role') == "Admin" ? 'selected' : null ?>>Admin</option>
                                                <option value="Kasir" <?= $this->session->userdata('role') == "Kasir" ? 'selected' : null ?>>Kasir</option>
                                                <option value="Owner" <?= $this->session->userdata('role') == "Owner" ? 'selected' : null ?>>Owner</option>
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
        <!-- End Modal -->
        <script type="text/javascript">
            // Ubah
            var loadFile2 = function(event) {
                var output2 = document.getElementById('output2');
                output2.src = URL.createObjectURL(event.target.files[0]);
            };
        </script>

        <script src="<?= base_url('assets/js/calc.js') ?>"></script>
        <script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/sa2/sweetalert2.all.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/sa2/alert.js') ?>"></script>
        <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
        <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/sb-admin-2.min.js') ?>"></script>
        <script src="<?= base_url('assets/vendor/chart.js/Chart.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/demo/chart-area-demo.js') ?>"></script>
        <script src="<?= base_url('assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
        <script src="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/demo/datatables-demo.js') ?>"></script>
        </body>

        </html>