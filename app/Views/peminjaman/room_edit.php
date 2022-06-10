<div class="form-group row">
    <label for="ruangan_nama" class="col-sm-2 col-form-label">Ruangan</label>
    <div class="col-sm-10">
        <input type="hidden" name="ruangan_id" value="<?= $var->ruangan_id ?>">
        <input type="text" class="form-control" id="ruangan_nama" name="ruangan_nama" placeholder="Nama Ruangan" value="<?= $var->ruangan_nama ?>" required>
    </div>
</div>