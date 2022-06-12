<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?= $menu ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right d-none">
                    <button class="btn btn-success btn-sm btn-icon" onclick="dt_add(this)"><i class="fa fa-plus"></i> Tambahkan Ruangan</button>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="tabel-data" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                                        <thead>
                                            <tr class="text-center">
                                                <th>No. Peminjaman</th>
                                                <th>Nama Ruangan</th>
                                                <th width="20%">Status</th>
                                                <th>Waktu Peminjaman</th>
                                                <th>Waktu Dikembalikan</th>
                                                <th width="15%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>

</section>
<!-- /.content -->

<script>
    $(document).ready(function() {
        $('#tabel-data').DataTable({
            ajax: {
                url: "<?php echo base_url('Peminjaman/daftar_peminjaman_fetch') ?>",
                dataSrc: "data",
                type: "POST"
            },
            processing: true,
            serverSide: true,
            columns: [{
                    data: 0
                },
                {
                    data: 1
                },
                {
                    data: 2
                },
                {
                    data: 3
                },
                {
                    data: 4
                },
                {
                    data: 5,
                    searchable: false,
                    orderable: false
                },
            ],
            'autoWidth': false,
            'order': [
                [2, 'asc']
            ]
        });

    });


    function dt_kembalikan(t) {
        swal('Informasi!', 'Mohon maaf fitur ini belum berfungsi', 'info');
    }
    // function dt_kembalikan(t) {
    //     var id = t.getAttribute('target-id');
    //     swal({
    //         title: 'Informasi!',
    //         text: 'Ajukan peminjaman ruangan ini?',
    //         type: 'info',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#A9A9A9',
    //         cancelButtonText: 'Tidak',
    //         confirmButtonText: 'Ya',
    //     }).then(function() {
    //         $.LoadingOverlay("show");
    //         $.post('<?php echo base_url('Peminjaman/ajukan_peminjaman') ?>', {
    //             'id': id
    //         }, function(result, textStatus, xhr) {
    //             $.LoadingOverlay("hide");
    //             if (result.status == 1) {
    //                 swal('Sukses!', result.msg, 'success');
    //                 $('#tabel-data').DataTable().ajax.reload();
    //             } else if (result.status == 2) {
    //                 swal('Peringatan!', result.msg, 'warning');
    //                 $('#tabel-data').DataTable().ajax.reload();
    //             } else {
    //                 swal('Maaf!', 'Server dalam perbaikan!', 'error');
    //             }
    //         }, 'json');
    //     }, function(dismiss) {
    //         if (dismiss === 'cancel') {

    //         }
    //     });
    // }
</script>