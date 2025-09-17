<div class="mb-1">
    <?php $this->load->view('ppd/program/nav'); ?>
</div>

<div class="p-3 border rounded mb-3">
  <div class="mb-3">
    <h3>Kemaskini Maklumat <?php echo $program->pt_nama; ?></h3>
  </div>
<?php echo validation_errors(); ?>
<?php echo form_open('program/proses_kemaskini');
$bilanganSoalan = 1; 
?>
<?php if(!empty($senaraiDaerah)): ?>
    <div class="mb-1">
        <label for="inputDaerah" class="form-label"><?= $bilanganSoalan++ ?>) Pilih Daerah: <span style="color:red;">*</span></label>
        <select name="inputDaerah" id="inputDaerah" class="form-control" autofocus>
            <?php foreach($senaraiDaerah as $daerah): 
                $negeriBil = $daerah->negeri_bil; ?>
                <option value="<?= $daerah->bil ?>" <?php if($daerah->bil == $program->pt_daerah){ echo 'selected'; } ?>><?= $daerah->nama ?></option>
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
                <option value="<?= $parlimen->pt_bil ?>" <?php if($parlimen->pt_bil == $program->pt_parlimen){ echo 'selected'; } ?> ><?= $parlimen->pt_nama ?></option>
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
                    <option value="<?= $dun->dun_bil ?>" <?php if($dun->dun_bil == $program->pt_dun){ echo 'selected'; } ?>><?= $dun->dun_nama ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    <?php endif; ?>
  <div class="mb-3">
    <label for="inputNamaProgram" class="form-label">Nama Program</label>
    <input type="text" class="form-control" id="inputNamaProgram" name = "inputNamaProgram" value = "<?php echo $program->pt_nama; ?>">
  </div>
  <div class="mb-3">
    <label for="inputAnjuran" class="form-label">Anjuran</label>
    <select name="inputAnjuran" id="inputAnjuran" class = "form-control">
      <?php foreach($senarai_penganjur as $penganjur): ?>
        <option value="<?php echo $penganjur->jt_pejabat; ?>" <?php if($penganjur->jt_pejabat == $program->pt_anjuran){ echo "selected"; } ?>><?php echo $penganjur->jt_pejabat; ?></option>
        <?php endforeach; ?>
    </select>
  </div>
  <div class="mb-3">
    <label for="inputMasa" class="form-label">Tarikh dan Masa</label>
    <input type="datetime-local" class="form-control" id="inputMasa" name = "inputMasa" value = "<?php echo date('Y-m-d\TH:i', strtotime($program->pt_tarikhMasa)); ?>">
  </div>
  <div class="mb-3">
    <label for="inputTempat" class="form-label">Tempat</label>
    <input type="text" class="form-control" id="inputTempat" name = "inputTempat" value = "<?php echo $program->pt_tempat; ?>">
  </div>
  <div class="mb-3">
    <label for="inputAudien" class="form-label">Jumlah Audien</label>
    <input type="text" class="form-control" id="inputAudien" name = "inputAudien" value = "<?php echo $program->pt_audien; ?>">
  </div>
  <div class="mb-3">
    <label for="inputPengisian">Pengisian</label>
    <textarea id="summernote" name="inputPengisian" rows="8" cols="80" class="form-control" value="<?php echo $program->pt_pengisian; ?>"><?php echo $program->pt_pengisian; ?></textarea>
  </div>
  <div class="mb-3">
    <label for="inputPenceramah" class="form-label">Penceramah</label>
    <input type="text" class="form-control" id="inputPenceramah" name = "inputPenceramah" value = "<?php echo $program->pt_penceramah; ?>">
  </div>
  <div class="mb-3">
    <label for="inputPenutup" class="form-label">Jemputan VIP / Ucapan Penutup</label>
    <input type="text" class="form-control" id="inputPenutup" name = "inputPenutup" value = "<?php echo $program->pt_vip; ?>">
  </div>
  <div class="mb-3">
    <label for="inputJenisBil" class="form-label">Jenis Program</label>
    <select class="form-control" name="inputJenisBil">
      <?php foreach($senaraiJenis as $jenis): ?>
      <option value="<?php echo $jenis->jt_bil; ?>" <?php
        if($jenis->jt_bil == $program->pt_jenisBil){
          echo "selected";
        } 
         ?>><?php echo $jenis->jt_nama; ?></option>
    <?php endforeach; ?>
    </select>
  </div>
  <input type="hidden" name="inputNegeri" value="<?= $negeriBil ?>">
  <input type="hidden" name="inputPengguna" value="<?= $this->session->userdata('pengguna_bil') ?>">
  <input type="hidden" name="inputProgramBil" value="<?php echo $program->pt_bil; ?>">
  <button type="submit" class="btn btn-primary">Kemaskini</button>
  <button type="reset" class = "btn btn-warning">Set Semula</button>
  <?php echo anchor(base_url(), 'Kembali ke Laman Utama', "class = 'btn btn-secondary'"); ?>
</form>
</div>

<script>
$(document).ready(function() {
  $('#summernote').summernote({
  toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']]
  ],
  height: 150
});
});
    </script>