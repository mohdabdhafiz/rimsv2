<div class="container p-5">
    <h1>TAMBAH PENGUNDI PUTIH</h1>
    <?php echo form_open('pengundi/proses_putih'); ?>
    <div class="mb-3">
        <label for="input_nama" class="form-label">1 - NAMA:</label>
        <input type="text" name="input_nama" id="input_nama" class="form-control">
    </div>
    <div class="mb-3">
        <label for="input_no_ic" class="form-label">2 - NOMBOR KAD PENGENALAN:</label>
        <input type="text" name="input_no_ic" id="input_no_ic" class="form-control">
    </div>
    <div class="mb-3">
        <label for="input_no_tel" class="form-label">3 - NOMBOR TELEFON:</label>
        <input type="text" name="input_no_tel" id="input_no_tel" class="form-control">
    </div>
    <div class="mb-3">
        <label for="input_alamat">4 - ALAMAT:</label>
        <input type="text" name="input_alamat" id="input_alamat" class="form-control">
    </div>
    <div class="mb-3">
        <input type="hidden" name="input_pengguna_bil" value="<?php echo $this->session->userdata('pengguna_bil'); ?>">
        <input type="hidden" name="input_pengguna_waktu" value="<?php echo date("Y-m-d H:i:s"); ?>">
        <button type="submit" class="btn btn-primary w-100">TAMBAH PENGUNDI PUTIH</button>
    </div>
    </form>
</div>