<?php $this->load->view('cpi/kluster_isu/nav'); ?>

<div class="p-3 rounded border mb-3">
    <h1>Kemaskini Maklumat Kluster Isu</h1>
    <?php echo form_open('cpi/proses_kemaskini_ki'); ?>
    <div class="mb-3">
        <label for="input_nama" class="form-label">1) Nama Kluster Isu:</label>
        <input type="text" name="input_nama" id="input_nama" value="<?= $kluster_isu->kit_nama ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label for="input_deskripsi" class="form-label">2) Deskripsi Kluster Isu:</label>
        <textarea name="input_deskripsi" id="input_deskripsi" cols="5" rows="5" class="form-control"><?= $kluster_isu->kit_deskripsi ?></textarea>
    </div>
    <input type="hidden" name="input_bil" value="<?= $kluster_isu->kit_bil ?>">
    <button type="submit" class="btn btn-outline-primary w-100">Simpan</button>
    </form>
</div>