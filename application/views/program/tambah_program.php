<div class="p-3 border rounded mb-3">
  <h3>TAMBAH PROGRAM BAHARU</h3>
  <div class="row g-3 mt-3">
    <div class="col-12 col-lg-3 col-md-6 col-sm-12">
      <?php echo anchor('program', 'Senarai Program', "class = 'btn btn-primary w-100'"); ?>
    </div>
    <div class="col-12 col-lg-3 col-md-6 col-sm-12">
      <?php echo anchor('program/tambah', 'Tambah Program', "class = 'btn btn-secondary w-100'"); ?>
    </div>
    <div class="col-12 col-lg-3 col-md-6 col-sm-12">
      <?php echo anchor('program/recap', 'Recap Program', "class = 'btn btn-info w-100'"); ?>
    </div>
    <div class="col-12 col-lg-3 col-md-6 col-sm-12">
    <?php echo anchor('jenis', 'Jenis Program', "class = 'btn btn-dark w-100'"); ?>
    </div>
  </div>
</div>
<div class="p-3 border rounded">
  <div class="mb-3">
    <h3>Tambah Program</h3>
  </div>
<?php echo validation_errors(); ?>
<?php echo form_open('program/proses_tambah'); ?>
  <div class="mb-3">
    <label for="inputNamaProgram" class="form-label">Nama Program</label>
    <input type="text" class="form-control" id="inputNamaProgram" name = "inputNamaProgram" value = "<?php echo set_value('inputNamaProgram'); ?>">
  </div>
  <div class="mb-3">
    <label for="inputAnjuran" class="form-label">Anjuran</label>
    <select name="inputAnjuran" id="inputAnjuran" class = "form-control">
      <?php foreach($senarai_penganjur as $penganjur): ?>
        <option value="<?php echo $penganjur->jt_pejabat; ?>"><?php echo $penganjur->jt_pejabat; ?></option>
        <?php endforeach; ?>
    </select>
  </div>
  <div class="mb-3">
    <label for="inputMasa" class="form-label">Tarikh dan Masa</label>
    <input type="datetime-local" class="form-control" id="inputMasa" name = "inputMasa" value = "<?php echo set_value('inputMasa'); ?>">
  </div>
  <div class="mb-3">
    <label for="inputTempat" class="form-label">Tempat</label>
    <input type="text" class="form-control" id="inputTempat" name = "inputTempat" value = "<?php echo set_value('inputTempat'); ?>">
  </div>
  <div class="mb-3">
    <label for="inputAudien" class="form-label">Jumlah Audien</label>
    <input type="text" class="form-control" id="inputAudien" name = "inputAudien" value = "<?php echo set_value('inputAudien'); ?>">
  </div>
  <div class="mb-3">
    <label for="inputPengisian">Pengisian</label>
    <textarea name="inputPengisian" rows="8" cols="80" class="form-control" value="<?php echo set_value('inputPengisian'); ?>"></textarea>
  </div>
  <div class="mb-3">
    <label for="inputPenceramah" class="form-label">Penceramah</label>
    <input type="text" class="form-control" id="inputPenceramah" name = "inputPenceramah" value = "<?php echo set_value('inputPenceramah'); ?>">
  </div>
  <div class="mb-3">
    <label for="inputPenutup" class="form-label">Jemputan VIP / Ucapan Penutup</label>
    <input type="text" class="form-control" id="inputPenutup" name = "inputPenutup" value = "<?php echo set_value('inputPenutup'); ?>">
  </div>
  <div class="mb-3">
    <label for="inputJenisBil" class="form-label">Jenis Program</label>
    <select class="form-control" name="inputJenisBil">
      <?php foreach($senaraiJenis as $jenis): ?>
      <option value="<?php echo $jenis->jt_bil; ?>"><?php echo $jenis->jt_nama; ?></option>
    <?php endforeach; ?>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Tambah</button>
  <button type="reset" class = "btn btn-warning">Set Semula</button>
  <?php echo anchor(base_url(), 'Kembali ke Laman Utama', "class = 'btn btn-secondary'"); ?>
</form>
</div>