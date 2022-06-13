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
                            <img class="profile-user-img img-fluid img-circle" src="<?= base_url('public/assets') ?>/dist/img/user/<?= $user->user_foto ?>" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"><?= $user->user_name ?></h3>

                        <p class="text-muted text-center">Administrator</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>No. Handphone</b> <a class="float-right"><?= $user->user_phone ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Email</b> <a class="float-right"><?= $user->email ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Friends</b> <a class="float-right"><?= $user->user_address ?></a>
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
                                <form id="ubahProfile" class="form-horizontal" action="<?= base_url('Profile/updateAdmin') ?>" method="POST" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label for="user_name" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="user_name" name="user_name" required value="<?= $user->user_name ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="user_foto" class="col-sm-2 col-form-label">Foto</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" id="user_foto" name="user_foto">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="user_phone" class="col-sm-2 col-form-label">No. Handphone</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="user_phone" name="user_phone" value="<?= $user->user_phone ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="email" name="email" value="<?= $user->email ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="user_address" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="user_address" name="user_address" required><?= $user->user_address ?></textarea>
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