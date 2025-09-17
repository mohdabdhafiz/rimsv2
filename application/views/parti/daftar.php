<div class="mt-3 mb-5">
    <h2 class="display-2"><?php echo $title; ?></h2>
</div>

<?php echo validation_errors(); ?>

<?php echo form_open('parti/daftar'); ?>

    <div class="mb-3 mt-5">
        <label for="parti_nama" class="form-label">Nama Parti</label>
        <input type="text" name="parti_nama" class="form-control"/>
    </div>

    <div class="mb-3">
        <label for="parti_singkatan" class="form-label">Nama Singkatan Parti</label>
        <input type="text" name="parti_singkatan" id="parti_singkatan" class="form-control">
    </div>

    <input type="hidden" id="parti_pengguna" name="parti_pengguna" value="<?php echo $this->session->userdata('pengguna_bil'); ?>">
    <input type="hidden" id="parti_logo" name="parti_logo" value="1">

    <div class="mb-3">
        <input type="submit" name="submit" value="Daftar Parti" class="btn btn-primary"/>
    </div>
</form>