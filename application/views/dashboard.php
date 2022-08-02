<div class="row">
    <div class="col-3">
        <div class="mb-4">
            <div class="card border-left-primary shadow h-100 py-1">
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
            <div class="card border-left-success shadow h-100 py-1">
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
            <div class="card border-left-warning shadow h-100 py-1">
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
            <div class="card border-left-danger shadow h-100 py-1">
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
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th Scope="col">No </th>
                        <th scope="col">Kode Invoice</th>
                        <th scope="col">Nama Pelanggan</th>
                        <th scope="col">Nama Paket</th>
                        <th scope="col">Total Biaya</th>
                        <th scope="col">Tanggal Masuk</th>
                        <th scope="col">Tanggal Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($data_transaksi as $m) {
                    ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td>
                                <h6><?= $m->kode_invoice; ?></h6>
                            </td>
                            <td><?= $m->nama_member; ?></td>
                            <td><?= $m->nama_paket; ?> - Rp. <?= number_format($m->harga_paket); ?></td>
                            <td>Rp. <?= number_format($m->total_biaya); ?></td>
                            <td><?= $m->tgl; ?></td>
                            <td><?= $m->tgl_bayar; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
                <thead>
                    <tr>
                        <th Scope="col">No </th>
                        <th scope="col">Kode Invoice</th>
                        <th scope="col">Nama Pelanggan</th>
                        <th scope="col">Nama Paket</th>
                        <th scope="col">Total Biaya</th>
                        <th scope="col">Tanggal Masuk</th>
                        <th scope="col">Tanggal Bayar</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>