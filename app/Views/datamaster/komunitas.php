<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?= $menu ?></h1>
            </div>
            <div class="col-sm-6 d-none">
                <ol class="breadcrumb float-sm-right">
                    <button class="btn btn-success btn-sm btn-icon" onclick="dt_add(this)"><i class="fa fa-plus"></i> Tambahkan Komunitas</button>
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
                                                <th>Foto</th>
                                                <th>Nama</th>
                                                <th>Bidang</th>
                                                <th>Jumlah Anggota</th>
                                                <th>Ketua</th>
                                                <th>Kontak</th>
                                                <th width="10%">Aksi</th>
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

<!-- modal -->
<div class="modal fade" id="modal_validation" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-nonaktifkan" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Form</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body-validation">

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Nonaktifkan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- end modal -->

<!-- modal -->
<div class="modal fade" id="modal_tambah" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="form-simpan" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Form</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body-admin">

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- end modal -->

<!-- button -->
<div id="dt_btn_utils" class="d-none">
    <button class="btn btn-sm btn-warning btn-icon dt-edit"><i class="fa fa-edit"></i></button>
    <button class="btn btn-sm btn-danger btn-icon dt-delete"><i class="fa fa-trash"></i></button>
</div>
<!-- end button -->

<script>
    $(document).ready(function() {
        $('#tabel-data').DataTable({
            ajax: {
                url: "<?php echo base_url('Datamaster/komunitas_fetch') ?>",
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
                    data: 5
                },
                {
                    data: 6,
                    searchable: false,
                    orderable: false
                },
            ],
            'autoWidth': false,
        });

    });

    function dt_add(t) {
        $.LoadingOverlay("show");
        $.get('<?php echo base_url('Datamaster/room_modal/room_add') ?>').done(function(data) {
            $.LoadingOverlay("hide");
            $('#modal-body-room').html(data);
            $('#modal_ruangan').modal('show')
        });
    }

    function dt_status(t) {
        var id = t.getAttribute('target-id');
        $.LoadingOverlay("show");
        $.get('<?php echo base_url('Datamaster/komunitas_modal/pass_validation') ?>', {
            'id': $(t).attr('target-id')
        }).done(function(data) {
            $.LoadingOverlay("hide");
            $('#modal-body-validation').html(data);
            $('#modal_validation').modal('show')
        });
    }

    $('#form-ruangan').submit(function(event) {
        $.LoadingOverlay("show");
        $.post('<?php echo base_url('Datamaster/room_save') ?>', $(this).serialize(), function(response, textStatus, xhr) {
            if (response.status == true) {
                toastr.success(response.msg);
                $('#tabel-data').DataTable().ajax.reload();
                $('#modal_ruangan').modal('hide');
                $.LoadingOverlay("hide");
            } else {
                toastr.error(response.msg);
                $.LoadingOverlay("hide");
            }
        }, "json");
        return false;
    });

    function dt_delete(t) {
        var id = t.getAttribute('target-id');
        swal({
            title: 'Peringatan!',
            text: 'Data yang dihapus tidak dapat dikembalikan!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#A9A9A9',
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya',
        }).then(function() {
            $.LoadingOverlay("show");
            $.post('<?php echo base_url('Datamaster/room_delete') ?>', {
                'id': id
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
</script>