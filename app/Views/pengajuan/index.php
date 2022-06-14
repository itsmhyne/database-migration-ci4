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
                                                <th>Nama Ruangan</th>
                                                <th width="30%">Nama yang Mengajukan</th>
                                                <th>Pengajuan Catatan</th>
                                                <th>Waktu Pengajuan</th>
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
                url: "<?php echo base_url('Pengajuan/daftar_pengajuan_fetch') ?>",
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
                    data: 4,
                    searchable: false,
                    orderable: false
                },
            ],
            'autoWidth': false,
        });

    });


    function dt_konfirmasi(t) {
        var id = t.getAttribute('target-id');
        var user = t.getAttribute('user-id');
        swal({
            title: 'Peringatan!',
            text: 'Konfirmasi pengajuan peminjaman ruangan untuk user ini?',
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#A9A9A9',
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya',
        }).then(function() {
            $.LoadingOverlay("show");
            $.post('<?php echo base_url('Pengajuan/konfirmasi_pengajuan') ?>', {
                'id': id,
                'user': user
            }, function(result, textStatus, xhr) {
                $.LoadingOverlay("hide");
                if (result.status == 1) {
                    swal('Sukses!', result.msg, 'success');
                    $('#tabel-data').DataTable().ajax.reload();
                } else if (result.status == 2) {
                    swal('Peringatan!', result.msg, 'warning');
                    $('#tabel-data').DataTable().ajax.reload();
                } else {
                    swal('Maaf!', 'Server dalam perbaikan!', 'error');
                }
            }, 'json');
        }, function(dismiss) {
            if (dismiss === 'cancel') {

            }
        });
    }
</script>