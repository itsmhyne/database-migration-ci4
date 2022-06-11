<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>
</head>
<style>
    .center {
        text-align: center;
    }
</style>

<body>

    <center>
        <h1>Print Rekap Peminjaman Ruangan</h1>
        <hr>
    </center>

    <table width="100%" border="1" cellspacing="0" cellpadding="1">
        <tr>
            <td width="5%">No.</td>
            <td>Nomor Peminjaman</td>
            <td>Ruangan</td>
            <td>Status</td>
            <td>Waktu Peminjaman</td>
        </tr>
        <?php $i = 1;
        foreach ($peminjaman as $key => $value) : ?>
            <tr>
                <td class="center"><?= $i++; ?>.</td>
                <td><?= $value['peminjaman_nomor'] ?></td>
                <td><?= $value['ruangan_nama'] ?></td>
                <td><?= $value['peminjaman_status'] == 1 ? 'Dipinjam' : 'Dikembalikan'  ?></td>
                <td><?= $value['created_time'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- jQuery -->
    <script src="<?= base_url("public/assets") ?>/plugins/jquery/jquery.min.js"></script>
</body>
<script>
    $(document).ready(function() {
        window.print();
    });
</script>

</html>