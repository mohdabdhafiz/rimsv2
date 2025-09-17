<div class="mt-3 mb-5">
    <h2 class="display-2"><?php echo $title; ?></h2>
</div>

<?php echo validation_errors(); ?>

<?php echo form_open('dun/daftar'); ?>

    <div class="mb-3 mt-5">
        <label for="dun_nama" class="form-label">Nama DUN</label>
        <input type="text" name="dun_nama" class="form-control"/>
    </div>

    <div class="mb-3 mt-5">
        <label for="dun_negeri" class="form-label">Negeri</label>
        <input type="text" name="dun_negeri" class="form-control"/>
    </div>

    <input type="hidden" id="dun_pengguna" name="dun_pengguna" value="<?php echo $this->session->userdata("pengguna_bil"); ?>">

    <div class="mb-3">
        <input type="submit" name="submit" value="Tambah DUN" class="btn btn-primary"/>
    </div>
</form>