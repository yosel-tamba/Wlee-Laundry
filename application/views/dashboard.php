<div class="row">
    <div class="col-3">
        <div class="mb-4">
            <div class="card border-left-primary shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary mb-1">TRANSAKSI</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $transaksi; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="mb-4">
            <div class="card border-left-success shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success mb-1">PELANGGAN</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $member; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="mb-4">
            <div class="card border-left-warning shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning mb-1">PENGGUNA</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pengguna; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-cog fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="mb-4">
            <div class="card border-left-danger shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger mb-1">PAKET CUCIAN</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $paket; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box-open fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card shadow">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Data Transaksi Terkini</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode Invoice</th>
                        <th scope="col">Pelanggan</th>
                        <th scope="col">Outlet</th>
                        <th scope="col">Masuk</th>
                        <th scope="col">Diambil</th>
                        <th scope="col">Total Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($data_transaksi as $m) {
                        $where = ['id_outlet' => $m->id_outlet];
                        $outlet = $this->m_crud->edit_data($where, 'tb_outlet')->result();
                        $harga_awal = 0;
                        $qty = 0;
                        $where = ['id_transaksi' => $m->id_transaksi];
                        $id_paket = $this->m_crud->edit_data($where, 'tb_detail_transaksi')->result();
                        foreach ($id_paket as $data) {
                            $qty = $data->qty;
                            $where = ['id_paket' => $data->id_paket];
                            $detail = $this->m_crud->edit_data($where, 'tb_paket')->result();
                            foreach ($detail as $p) {
                                $harga_awal += $p->harga * $qty;
                            }
                        }
                        $harga_awal += $m->biaya_tambahan;
                        $harga_awal += $m->pajak;
                        $harga_diskon = ($m->diskon / 100) * $harga_awal;
                        $total_biaya = ceil($harga_awal - $harga_diskon);
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td>
                                <h6><?= $m->kode_invoice; ?></h6>
                            </td>
                            <td><?= $m->nama_member; ?></td>
                            <td>
                                <?php foreach ($outlet as $data) : ?>
                                    <?= $m->id_outlet == $data->id_outlet ? $data->nama : null ?>
                                <?php endforeach ?>
                            </td>
                            <td><?= $m->tgl ?></td>
                            <td><?= $m->tgl_bayar; ?></td>
                            <td>Rp. <?= number_format($total_biaya, 0, ",", ".") ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode Invoice</th>
                        <th scope="col">Pelanggan</th>
                        <th Scope="col">Outlet</th>
                        <th scope="col">Masuk</th>
                        <th scope="col">Diambil</th>
                        <th scope="col">Total Biaya</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>