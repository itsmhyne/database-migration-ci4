<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?= $menu ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <button class="btn btn-success btn-sm btn-icon" onclick="dt_add(this)"><i class="fa fa-plus"></i> Tambahkan Admin</button>
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
                                                <th>Nama</th>
                                                <th>Foto</th>
                                                <th>No. Handphone</th>
                                                <th>Email</th>
                                                <th>Alamat</th>
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

<!-- modal -->
<div class="modal fade" id="modal_validation" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
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

<script>
    $(document).ready(function() {
        $('#tabel-data').DataTable({
            ajax: {
                url: "<?php echo base_url('Manajemen/admin_fetch') ?>",
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
        });

    });

    function dt_add(t) {
        $.LoadingOverlay("show");
        $.get('<?php echo base_url('Manajemen/manajemen_modal/tambah_admin') ?>').done(function(data) {
            $.LoadingOverlay("hide");
            $('#modal-body-admin').html(data);
            $('#modal_tambah').modal('show')
        });
    }


    function dt_status(t) {
        var id = t.getAttribute('target-id');
        $.LoadingOverlay("show");
        $.get('<?php echo base_url('Manajemen/manajemen_modal/pass_validation') ?>', {
            'id': $(t).attr('target-id')
        }).done(function(data) {
            $.LoadingOverlay("hide");
            $('#modal-body-validation').html(data);
            $('#modal_validation').modal('show')
        });
    }

    $('#form-nonaktifkan').submit(function(event) {
        $.LoadingOverlay("show");
        $.post('<?php echo base_url('Manajemen/nonaktifkan_akun') ?>', $(this).serialize(), function(response, textStatus, xhr) {
            if (response.status == true) {
                toastr.success(response.msg);
                $('#tabel-data').DataTable().ajax.reload();
                $('#modal_validation').modal('hide');
                $.LoadingOverlay("hide");
            } else {
                toastr.error(response.msg);
                $.LoadingOverlay("hide");
            }
        }, "json");
        return false;
    });

    $('#form-simpan').submit(function(event) {
        $.LoadingOverlay("show");
        $.post('<?php echo base_url('Manajemen/tambah_admin') ?>', $(this).serialize(), function(response, textStatus, xhr) {
            if (response.status == true) {
                toastr.success(response.msg);
                $('#tabel-data').DataTable().ajax.reload();
                $('#modal_tambah').modal('hide');
                $.LoadingOverlay("hide");
            } else {
                toastr.error(response.msg);
                $.LoadingOverlay("hide");
            }
        }, "json");
        return false;
    });
</script>