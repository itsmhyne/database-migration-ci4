<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>
</head>

<body>

    <center>
        <h1>Print Bukti Peminjaman Ruangan</h1>
        <hr>
    </center>

    <table>
        <tr>
            <td>Peminjaman Nomor</td>
            <td>: <b><?= $peminjaman->peminjaman_nomor ?></b></td>
        </tr>
        <tr>
            <td>Ruangan</td>
            <td>: <b><?= $peminjaman->ruangan_nama ?></b></td>
        </tr>
        <tr>
            <td>Waktu Dipinjam</td>
            <td>: <b><?= $peminjaman->created_time ?></b></td>
        </tr>
        <tr>
            <td>Peminjam</td>
            <td>: <b><?= $peminjaman->komunitas_nama ?></b></td>
        </tr>
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