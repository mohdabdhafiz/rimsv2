<div class="container">
    <div class="p-3 border rounded mb-3">
        <h3>TAMBAH PERANAN</h3>
    </div>
    <div class="p-3 border rounded mb-3">
        <p>Tambah Peranan Baharu</p>
        <?php echo validation_errors(); ?>
        <?php echo form_open('peranan/proses_tambah'); ?>
            <div class="mb-3">
                <label for="peranan_nama" class="form-label">Nama Peranan :</label>
                <input type="text" name="peranan_nama" id="peranan_nama" class="form-control">
            </div>
            <input type="hidden" name="peranan_petugas" value="0">
            <input type="hidden" name="peranan_waktu" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <input type="hidden" name="peranan_pencipta" value="<?php echo $this->session->userdata('pengguna_bil'); ?>">
            <button type="submit" class="btn btn-primary w-100">Tambah Peranan</button>
        </form>
    </div>

</div>