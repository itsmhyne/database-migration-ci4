<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?= $menu ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <button class="btn btn-success btn-sm btn-icon" onclick="dt_rekap(this)"><i class="fa fa-print"></i> Print Rekap</button>
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
                                                <th>Nomor Peminjaman</th>
                                                <th>Nama Ruangan</th>
                                                <th width="20%">Status</th>
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
                url: "<?php echo base_url('Peminjaman/ruangan_dipinjam_fetch') ?>",
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
                }, {
                    data: 2
                },
                {
                    data: 3,
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
        var id = t.getAttribute('target-id');
        var ruangan = t.getAttribute('ruangan-id');
        swal({
            title: 'Peringatan!',
            text: 'Apakah anda yakin untuk mengembalikan peminjaman ruangan ini?',
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#A9A9A9',
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya',
        }).then(function() {
            $.LoadingOverlay("show");
            $.post('<?php echo base_url('Peminjaman/ruangan_dipinjam_dikembalikan') ?>', {
                'id': id,
                'ruangan': ruangan,
            }, function(result, textStatus, xhr) {
                $.LoadingOverlay("hide");
                if (result.status > 0) {
                    swal('Sukses!', result.msg, 'success');
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

    function print_peminjaman(t) {
        var id = t.getAttribute('target-id')
        var x = window.open(base_url('/Peminjaman/ruangan_dipinjam_print_bukti/' + id), '_blank');
        x.focus;
    }

    function dt_rekap() {
        var x = window.open(base_url('/Peminjaman/print_rekap'), '_blank');
        x.focus;
    }
</script>