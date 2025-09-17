
    <h3>DAFTAR PENGGUNA BAHARU</h3>
    <p>Pastikan Pengguna belum mendaftar di dalam sistem ini.</p>
    <p><?php echo anchor('pengguna', 'Laman Pengguna', "class='btn btn-secondary mb-3'"); ?></p>

    <p><strong>BORANG PENDAFTARAN</strong></p>
<?php echo validation_errors(); ?>

<?php echo form_open('pengguna/daftar'); ?>

    <div class="mb-3">
        <label for="nama_penuh" class="form-label">Nama</label>
        <input type="text" name="nama_penuh" class="form-control"/>
    </div>

    <div class="mb-3">
        <label for="no_ic" class="form-label">Nombor Kad Pengenalan</label>
        <input type="text" name="no_ic" id="no_ic" class="form-control">
    </div>

    <div class="mb-3">
        <label for="sah_no_ic" class="form-label">Sila Sahkan Nombor Kad Pengenalan</label>
        <input type="text" name="sah_no_ic" id="sah_no_ic" class="form-control">
    </div>

    <div class="mb-3">
        <label for="no_tel" class="form-label">Nombor Telefon</label>
        <input type="text" name="no_tel" class="form-control"/>
    </div>

    <div class="mb-3">
        <label for="sah_no_tel" class="form-label">Sila Sahkan Nombor Telefon</label>
        <input type="text" name="sah_no_tel" id="sah_no_tel" class="form-control">
    </div>

    <div class="mb-3">
        <label for="emel" class="form-label">e-Mel</label>
        <input type="text" name="emel" id="emel" class="form-control">
    </div>

    <div class="mb-3">
        <input type="submit" name="submit" value="Daftar Pengguna" class="btn btn-primary"/>
    </div>
</form>