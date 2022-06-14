<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Profile Saya</h1>
            </div>
            <div class="col-sm-6 d-none">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">User Profile</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="<?= base_url('public/assets') ?>/dist/img/user/<?= $user->komunitas_logo ?>" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"><?= $user->komunitas_nama ?></h3>

                        <p class="text-muted text-center">User</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Bidang</b> <a class="float-right"><?= $user->bidang ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Jumlah Anggota</b> <a class="float-right"><?= $user->jml_anggota ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Ketua</b> <a class="float-right"><?= $user->ketua ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Kontak</b> <a class="float-right"><?= $user->kontak ?></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link  active" href="#settings" data-toggle="tab">Settings</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">

                            <div class="active tab-pane" id="settings">
                                <form id="ubahProfile" class="form-horizontal" action="<?= base_url('Profile/updateKomunitas') ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label for="komunitas_nama" class="col-sm-2 col-form-label">Nama Komunitas</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="komunitas_nama" name="komunitas_nama" required value="<?= $user->komunitas_nama ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="komunitas_logo" class="col-sm-2 col-form-label">Logo Komunitas</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" id="komunitas_logo" name="komunitas_logo">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kontak" class="col-sm-2 col-form-label">Kontak</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="kontak" name="kontak" value="<?= $user->kontak ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="bidang" class="col-sm-2 col-form-label">Bidang</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="bidang" name="bidang" value="<?= $user->bidang ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jml_anggota" class="col-sm-2 col-form-label">Jumlah Anggota</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="jml_anggota" name="jml_anggota" value="<?= $user->jml_anggota ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="ketua" class="col-sm-2 col-form-label">Ketua</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="ketua" name="ketua" value="<?= $user->ketua ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="username" value="<?= $user->username ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-2 col-form-label">password</label>
                                        <div class="col-sm-5">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="password baru">
                                            <small class="text-danger">*Kosongkan jika tidak ingin mangganti password</small>
                                        </div>
                                        <div class="col-sm-5">
                                            <input type="password" class="form-control" id="password_konfirmasi" name="password_konfirmasi" placeholder="tulis kembali password baru">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Simpan Perubahan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<script>
    $('#ubahProfile').formSubmit(function(response) {
        if (response.status == 1) {
            location.reload()
        }
    });
</script>