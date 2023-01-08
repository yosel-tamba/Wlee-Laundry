<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title_pdf; ?></title>
    <link rel="icon" href="<?= base_url('assets/img/wlee.png') ?>">
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
            text-align: center;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>
    <div style="text-align:center">
        <h3> Report Data Outlet</h3>
    </div>
    <table id="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Outlet</th>
                <th>Alamat</th>
                <th>Telepon</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($outlet as $m) {
            ?>
                <tr>
                    <td scope="row"><?= $no++; ?></td>
                    <td><?= $m->nama; ?></td>
                    <td><?= $m->alamat; ?></td>
                    <td><?= $m->tlp; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>