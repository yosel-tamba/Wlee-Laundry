<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nota</title>
        <link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
    </head>
    <body class="text-dark">
        <div class="mb-4 mt-5 text-center">
            <h3>Wlee Laundry</h3>
            <small>Jl. Siliwangi KM. 15, Manggahang, Kec.Baleendah, Bandung Jawa Barat 40375</small><br>
            <small><strong>Tidak Ada Yang Tidak Bisa Kami Bersihkan</strong></small>
        </div>
        <table>
        <?php foreach($transaksi as $row){
            $harga_awal = $row->biaya_tambahan+$row->pajak+$row->harga_paket;
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
                        <h5 class="fw-normal">ID Transaksi</h5>
                    </div>
                    <div class="col text-center">
                        <h5 class="fw-normal">:</h5>
                    </div>
                    <div class="col">
                        <h5 class="fw-normal"><?= $row->id_transaksi ?></h5>
                    </div>
                </div>

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
                        <h5 class="fw-normal"><?= $row->nama_paket ?></h5>
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
                        <h5 class="fw-normal">Rp. <?= number_format($row->harga_paket) ?></h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col text-right">
                        <h5 class="fw-normal">Banyak Paket</h5>
                    </div>
                    <div class="col text-center">
                        <h5 class="fw-normal">:</h5>
                    </div>
                    <div class="col">
                        <h5 class="fw-normal"><?= $row->jumlah_paket ?>x</h5>
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
                        <h5 class="fw-normal"><?= $row->diskon ?>% = Rp.<?= number_format(($row->diskon/100)*$harga_awal) ?> </h5>
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
                        <h5>Rp. <?= number_format($row->total_biaya) ?></h5>
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
            window.print();
        </script>
    </body>
</html>