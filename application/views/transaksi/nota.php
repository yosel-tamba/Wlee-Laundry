<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota</title>
    <link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
    <link rel="icon" href="<?= base_url('assets/img/wlee.png') ?>">
</head>

<body class="text-dark">
    <div class="mb-4 mt-5 text-center">
        <h3>Wlee Laundry</h3>
        <small>Jl. Siliwangi KM. 15, Manggahang, Kec.Baleendah, Bandung Jawa Barat 40375</small><br>
        <small><strong>Tidak Ada Yang Tidak Bisa Kami Bersihkan</strong></small>
    </div>
    <table>
        <?php foreach ($transaksi as $row) {
            $harga_paket = 0;
            $qty = 0;
            $where = ['id_transaksi' => $row->id_transaksi];
            $id_paket = $this->m_crud->edit_data($where, 'tb_detail_transaksi')->result();
            foreach ($id_paket as $data) {
                $qty = $data->qty;
                $where = ['id_paket' => $data->id_paket];
                $paket[] = $this->m_crud->edit_data($where, 'tb_paket')->result();
                $detail = $this->m_crud->edit_data($where, 'tb_paket')->result();
                foreach ($detail as $p) {
                    $harga_paket += $p->harga * $qty;
                }
            }
            $harga_awal = $harga_paket + $row->biaya_tambahan + $row->pajak;
            $harga_diskon = ($row->diskon / 100) * $harga_awal;
            $total_biaya = ceil($harga_awal - $harga_diskon);
        ?>
            <div class="container mb-5">

                <hr>

                <div class="row">
                    <div class="col text-right">
                        <h5 class="fw-normal">Nama Outlet</h5>
                    </div>
                    <div class="col text-center">
                        <h5 class="fw-normal">:</h5>
                    </div>
                    <div class="col">
                        <h5 class="fw-normal"><?= $row->nama ?></h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col text-right">
                        <h5 class="fw-normal">Nama Pengguna</h5>
                    </div>
                    <div class="col text-center">
                        <h5 class="fw-normal">:</h5>
                    </div>
                    <div class="col">
                        <h5 class="fw-normal"><?= $row->nama_user ?></h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col text-right">
                        <h5 class="fw-normal">Nama Pelanggan</h5>
                    </div>
                    <div class="col text-center">
                        <h5 class="fw-normal">:</h5>
                    </div>
                    <div class="col">
                        <h5 class="fw-normal"><?= $row->nama_member ?></h5>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col text-right">
                        <h5 class="fw-normal">Kode Invoice</h5>
                    </div>
                    <div class="col text-center">
                        <h5 class="fw-normal">:</h5>
                    </div>
                    <div class="col">
                        <h5 class="fw-normal"><?= $row->kode_invoice ?></h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col text-right">
                        <h5 class="fw-normal">Tanggal Masuk</h5>
                    </div>
                    <div class="col text-center">
                        <h5 class="fw-normal">:</h5>
                    </div>
                    <div class="col">
                        <h5 class="fw-normal"><?= $row->tgl ?></h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col text-right">
                        <h5 class="fw-normal">Tanggal Bayar</h5>
                    </div>
                    <div class="col text-center">
                        <h5 class="fw-normal">:</h5>
                    </div>
                    <div class="col">
                        <h5 class="fw-normal"><?= $row->tgl_bayar ?></h5>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col text-right">
                        <h5 class="fw-normal">Nama Paket</h5>
                    </div>
                    <div class="col text-center">
                        <h5 class="fw-normal">:</h5>
                    </div>
                    <div class="col">
                        <?php
                        foreach ($id_paket as $ip) {
                            $id[] = $ip->qty;
                        }
                        foreach ($paket as $value) {
                            foreach ($value as $p) {
                        ?>
                                <h5 class="fw-normal">
                                    <?= '- ' . $p->nama_paket ?>
                                    <?php foreach ($id as $nilai) { ?>
                                        <?= '- ' . $nilai ?>

                            <?php
                                    }
                                }
                            }
                            ?>
                                </h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col text-right">
                        <h5 class="fw-normal">Harga Paket</h5>
                    </div>
                    <div class="col text-center">
                        <h5 class="fw-normal">:</h5>
                    </div>
                    <div class="col">
                        <h5 class="fw-normal">Rp. <?= number_format($harga_paket) ?></h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col text-right">
                        <h5 class="fw-normal">Pajak</h5>
                    </div>
                    <div class="col text-center">
                        <h5 class="fw-normal">:</h5>
                    </div>
                    <div class="col">
                        <h5 class="fw-normal">Rp. <?= number_format($row->pajak) ?></h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col text-right">
                        <h5 class="fw-normal">Biaya Tambahan</h5>
                    </div>
                    <div class="col text-center">
                        <h5 class="fw-normal">:</h5>
                    </div>
                    <div class="col">
                        <h5 class="fw-normal">Rp. <?= number_format($row->biaya_tambahan) ?></h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col text-right">
                        <h5 class="fw-normal">Diskon</h5>
                    </div>
                    <div class="col text-center">
                        <h5 class="fw-normal">:</h5>
                    </div>
                    <div class="col">
                        <h5 class="fw-normal"><?= $row->diskon ?>% = Rp. <?= number_format(($row->diskon / 100) * $harga_awal) ?> </h5>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col text-right">
                        <h5>Total Biaya</h5>
                    </div>
                    <div class="col text-center">
                        <h5>:</h5>
                    </div>
                    <div class="col">
                        <h5>Rp. <?= number_format($total_biaya) ?></h5>
                    </div>
                </div>
                <br>
                <div class="container text-center">
                    <small>Terima Kasih Telah Menggunakan Jasa <strong>Wlee Laundry</strong> Kami.</small><br>
                    <small>Kami Tunggu Kedantangan Anda Yang Berikutnya.</small>
                </div>
            </div>
        <?php } ?>
    </table>
    <script>
        // window.print();
    </script>
</body>

</html>