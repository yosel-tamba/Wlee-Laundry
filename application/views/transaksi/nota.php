<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota</title>
    <link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link rel="icon" href="<?= base_url('assets/img/wlee.png') ?>">
</head>

<body class="text-dark">
    <div class="d-flex align-items-center mb-1 mt-4 text-decoration-none justify-content-center">
        <div class="icon h1 mr-3">
            <i class="fas fa-grin-tongue-wink"></i>
        </div>
        <h3 class="h2 font-weight-bold">Wlee Laundry</h3>
    </div>
    <div class="mb-4 text-center">
        Jl. Siliwangi KM. 15, Manggahang, Kec.Baleendah, Bandung Jawa Barat 40375
    </div>
    <div class="container">
        <?php
        $no = 1;
        foreach ($transaksi as $row) {
            $harga_paket = 0;
            $qty = 0;
            $where = ['id_transaksi' => $row->id_transaksi];
            $id_paket = $this->m_data->notaPaket($where)->result();
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
            <div class="d-flex justify-content-between align-items-end mb-3">
                <table>
                    <tr>
                        <td>Kode Invoice</td>
                        <td class="px-3">:</td>
                        <td><?= $row->kode_invoice ?></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td class="px-3">:</td>
                        <td><?= $row->nama_member ?></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td>Tanggal Nota</td>
                        <td class="px-3">:</td>
                        <td><?= $row->tgl_bayar . ' (' . date('H:m:s') . ')' ?></td>
                    </tr>
                </table>
            </div>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Paket</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($id_paket as $paket) { ?>
                        <tr>
                            <th><?= $no++ ?></th>
                            <td class="text-left"><?= $paket->nama_paket ?></td>
                            <td>
                                <div class="d-flex justify-content-between">
                                    <span>Rp.</span>
                                    <label><?= number_format($paket->harga) ?></label>
                                </div>
                            </td>
                            <td><?= $paket->qty ?></td>
                            <td>
                                <div class="d-flex justify-content-between">
                                    <span>Rp.</span>
                                    <label><?= number_format($paket->qty * $paket->harga) ?></label>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <th colspan="4" class="text-right">Diskon</th>
                        <td class="text-right"><?= $row->diskon ?>%</td>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-right">Total Bayar</th>
                        <th>
                            <div class="d-flex justify-content-between">
                                <span>Rp.</span>
                                <label><?= number_format($total_biaya) ?></label>
                            </div>
                        </th>
                    </tr>
                </tbody>
            </table>
        <?php } ?>
        <div class="mt-5 text-center">
            Tidak Ada Yang Tidak Bisa Kami Bershikan.<br>
            <span class="font-weight-bold">Terima Kasih.</span>
        </div>
    </div>
</body>
<script>
    window.print();
</script>

</html>