<div class="p-3 rounded border mb-3">
    <h3>Tambah Kluster Isu</h3>
    <div class="row g-3 mt-3">
        <div class="col-12 col-lg-3 col-md-4">
            <?php echo anchor(base_url(), 'Laman Utama', "class='btn btn-sm btn-outline-success w-100'"); ?>
        </div>
        <div class="col-12 col-lg-3 col-md-4">
            <?php echo anchor('cpi/kluster_isu', 'Kluster Isu', "class='btn btn-sm btn-outline-success w-100'"); ?>
        </div>
        <div class="col-12 col-lg-3 col-md-4">
            <?php echo anchor('cpi/senarai_kluster_isu', 'Senarai Kluster Isu', "class='btn btn-sm btn-outline-success w-100'"); ?>
        </div>
        <div class="col-12 col-lg-3 col-md-4">
            <?php echo anchor('cpi/tambah_kluster_isu', 'Tambah Kluster Isu Baharu', "class='btn btn-sm btn-outline-success w-100'"); ?>
        </div>
    </div>
</div>

<div class="p-3 border rounded mb-3">
    <?php echo validation_errors(); ?>
    <?php echo form_open('cpi/proses_tambah_kluster_isu'); ?>
        <p><strong>Tambah Kluster Isu Baharu</strong></p>
        <div class="mb-3">
            <label for="input_nama" class="form-label">1) Nama Kluster Isu:</label>
            <input type="text" name="input_nama" id="input_nama" class="form-control">
        </div>
        <div class="mb-3">
            <label for="input_deskripsi" class="form-label">2) Keterangan:</label>
            <textarea name="input_deskripsi" id="input_deskripsi" cols="10" rows="5" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="input_shortform" class="form-label">3) Nama Singkatan:</label>
            <input type="text" name="input_shortform" id="input_shortform" class="form-control">
        </div>
        <input type="hidden" name="input_pengguna_bil" value="<?= $this->session->userdata('pengguna_bil'); ?>">
        <input type="hidden" name="input_pengguna_waktu" value="<?= date('Y-m-d H:i:s'); ?>">
        <button type="submit" class="btn btn-sm btn-outline-success w-100">Tambah</button>
    </form>
</div>