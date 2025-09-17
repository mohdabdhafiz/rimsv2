<div class="mb-1">
    <?php $this->load->view('ppd/program/nav'); ?>
</div>

<div class="p-3 border rounded mb-1">
  <p><strong>Tambah Program Baharu</strong></p>
<?php echo validation_errors(); ?>
<?php echo form_open('program/proses_tambah');
    $bilanganSoalan = 1;
?>
    <?php if(!empty($senaraiDaerah)): ?>
    <div class="mb-1">
        <label for="inputDaerah" class="form-label"><?= $bilanganSoalan++ ?>) Pilih Daerah: <span style="color:red;">*</span></label>
        <select name="inputDaerah" id="inputDaerah" class="form-control" autofocus>
            <?php foreach($senaraiDaerah as $daerah): 
                $negeriBil = $daerah->negeri_bil; ?>
                <option value="<?= $daerah->bil ?>" <?php if($daerah->bil == set_value('inputDaerah')){ echo 'selected'; } ?>><?= $daerah->nama ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <?php endif; ?>

    <?php if(!empty($senaraiParlimen)): ?>
    <div class="mb-1">
        <label for="inputParlimen" class="form-label"><?= $bilanganSoalan++ ?>) Pilih Parlimen:</label>
        <select name="inputParlimen" id="inputParlimen" class="form-control">
            <option value="">Sila pilih..</option>
            <?php foreach($senaraiParlimen as $parlimen): ?>
                <option value="<?= $parlimen->pt_bil ?>" <?php if($parlimen->pt_bil == set_value('inputParlimen')){ echo 'selected'; } ?> ><?= $parlimen->pt_nama ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <?php endif; ?>

    <?php if(!empty($senaraiDun)): ?>
        <div class="mb-1">
            <label for="inputDun" class="form-label"><?= $bilanganSoalan++ ?>) Pilih DUN:</label>
            <select name="inputDun" id="inputDun" class="form-control">
                <option value="">Sila pilih..</option>
                <?php foreach($senaraiDun as $dun): ?>
                    <option value="<?= $dun->dun_bil ?>" <?php if($dun->dun_bil == set_value('inputDun')){ echo 'selected'; } ?>><?= $dun->dun_nama ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    <?php endif; ?>
  <div class="mb-1">
    <label for="inputNamaProgram" class="form-label"><?= $bilanganSoalan++ ?>) Nama Program: <span style="color:red;">*</span></label>
    <input type="text" class="form-control" id="inputNamaProgram" name = "inputNamaProgram" value = "<?php echo set_value('inputNamaProgram'); ?>">
  </div>
  <div class="mb-1">
    <label for="inputAnjuran" class="form-label"><?= $bilanganSoalan++ ?>) Anjuran:</label>
    <select name="inputAnjuran" id="inputAnjuran" class = "form-control">
        <option value="">Sila pilih..</option>
      <?php foreach($senarai_penganjur as $penganjur): ?>
        <option value="<?php echo $penganjur->jt_pejabat; ?>"><?php echo $penganjur->jt_pejabat; ?></option>
        <?php endforeach; ?>
    </select>
  </div>
  <div class="mb-1">
    <label for="inputMasa" class="form-label"><?= $bilanganSoalan++ ?>) Tarikh dan Masa:</label>
    <input type="datetime-local" class="form-control" id="inputMasa" name = "inputMasa" value = "<?php echo set_value('inputMasa'); ?>">
  </div>
  <div class="mb-1">
    <label for="inputTempat" class="form-label"><?= $bilanganSoalan++ ?>) Tempat:</label>
    <input type="text" class="form-control" id="inputTempat" name = "inputTempat" value = "<?php echo set_value('inputTempat'); ?>">
  </div>
  <div class="mb-1">
    <label for="inputAudien" class="form-label"><?= $bilanganSoalan++ ?>) Jumlah Audien:</label>
    <input type="text" class="form-control" id="inputAudien" name = "inputAudien" value = "<?php echo set_value('inputAudien'); ?>">
  </div>
  <div class="mb-1">
    <label for="inputPengisian"><?= $bilanganSoalan++ ?>) Pengisian:</label>
    <textarea name="inputPengisian" rows="8" cols="80" class="form-control" value="<?php echo set_value('inputPengisian'); ?>"></textarea>
  </div>
  <div class="mb-1">
    <label for="inputPenceramah" class="form-label"><?= $bilanganSoalan++ ?>) Penceramah:</label>
    <input type="text" class="form-control" id="inputPenceramah" name = "inputPenceramah" value = "<?php echo set_value('inputPenceramah'); ?>">
  </div>
  <div class="mb-1">
    <label for="inputPenutup" class="form-label"><?= $bilanganSoalan++ ?>) Jemputan VIP / Ucapan Penutup:</label>
    <input type="text" class="form-control" id="inputPenutup" name = "inputPenutup" value = "<?php echo set_value('inputPenutup'); ?>">
  </div>
  <div class="mb-1">
    <label for="inputJenisBil" class="form-label"><?= $bilanganSoalan++ ?>) Jenis Program: <span style="color:red;">*</span></label>
    <select class="form-control" name="inputJenisBil">
        <option value="">Sila pilih..</option>
      <?php foreach($senaraiJenis as $jenis): ?>
      <option value="<?php echo $jenis->jt_bil; ?>"><?php echo $jenis->jt_nama; ?></option>
    <?php endforeach; ?>
    </select>
  </div>
  <input type="hidden" name="inputNegeri" value="<?= $negeriBil ?>">
  <input type="hidden" name="inputPengguna" value="<?= $this->session->userdata('pengguna_bil') ?>">
  <div class="row g-1">
    <div class="col-auto">
    <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
    </div>
    <div class="col-auto">
    <button type="reset" class = "btn btn-sm btn-warning">Set Semula</button>
    </div>
    <div class="col-auto">
    <?php echo anchor(base_url(), 'Kembali ke Laman Utama', "class = 'btn btn-sm btn-secondary'"); ?>
    </div>
  </div>
</form>
</div>