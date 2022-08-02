<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?= $title_pdf; ?></title>
   <style>
      #table {
         font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
         border-collapse: collapse;
         width: 100%;
      }

      #table td,
      #table th {
         border: 1px solid #ddd;
         padding: 8px;
      }

      #table tr:nth-child(even) {
         background-color: #f2f2f2;
      }

      #table tr:hover {
         background-color: #ddd;
      }

      #table th {
         padding-top: 10px;
         padding-bottom: 10px;
         text-align: left;
         background-color: #4CAF50;
         color: white;
      }
   </style>
</head>

<body>
   <div style="text-align:center">
      <h3> Report Data Transaksi</h3>
   </div>
   <table id="table">
      <thead>
         <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Kode Invoice</th>
            <th>Tanggal Masuk</th>
            <th>Tanggal Bayar</th>
            <th>Total Biaya</th>
         </tr>
      </thead>
      <tbody>
         <?php
         $no = 1;
         foreach ($transaksi as $m) {
            $total[] = $m->total_biaya;
            $total_pendapat = array_sum($total);
         ?>
            <tr>
               <td scope="row"><?= $no++; ?></td>
               <td><?= $m->nama_member; ?></td>
               <td><?= $m->kode_invoice; ?></td>
               <td><?= $m->tgl; ?></td>
               <td><?= $m->tgl_bayar; ?></td>
               <td>Rp. <?= number_format($m->total_biaya); ?></td>
            </tr>
         <?php } ?>
         <tr>
            <td colspan="5">Total Pendapatan</td>
            <td>Rp. <?= number_format($total_pendapat); ?></td>
         </tr>
      </tbody>
   </table>
</body>

</html>