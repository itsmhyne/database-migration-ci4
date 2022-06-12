<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?= $menu ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <select name="bulan" id="bulan" class="form-control select2" onchange="fetchdata()">
                                <option value="">Bulan</option>
                                <?php foreach ($bulan as $key => $m) : ?>
                                    <option value="<?= $m['bulan_kode'] ?>"><?= $m['bulan_nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <select name="tahun" id="tahun" class="form-control select2" onchange="fetchdata()">
                                <?php foreach ($tahun as $key => $y) : ?>
                                    <option value="<?= $y['YEAR(created_time)'] ?>" <?= $y['YEAR(created_time)'] == date('Y') ? 'selected' : '' ?>><?= $y['YEAR(created_time)'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content" id="content-view">

</section>
<!-- /.content -->
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2()
        fetchdata();
    });

    function fetchdata() {
        var bulan = $('#bulan').val();
        var tahun = $('#tahun').val();
        $.LoadingOverlay('show');
        $.post(base_url('/Dashboard/dashboardData'), {
            'bulan': bulan,
            'tahun': tahun
        }).done(function(data) {
            $.LoadingOverlay("hide");
            $('#content-view').html(data);
        });
    }
</script>