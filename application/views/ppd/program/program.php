<div class="mb-1">
    <?php $this->load->view('ppd/program/nav'); ?>
</div>


<?php foreach($senaraiProgram as $program): ?>
  <div class="p-3 border rounded mb-1">
<div class="row g-1">
    <div class="col-auto">
        <div class="p-1">
            <p>
                <strong>Nama Program</strong><br>
                <?php echo $program->pt_nama; ?>
            </p>
        </div>
    </div>
  <div class="col-auto">
    <div class="p-1">
      <p><strong>Tarikh</strong><br> 
      <?php echo date_format(date_create($program->pt_tarikhMasa), "d.m.Y"); ?></p>
    </div>
  </div>
  <div class="col-auto">
    <div class="p-1">
      <p><strong>Masa</strong><br> 
      <?php echo date_format(date_create($program->pt_tarikhMasa), "H.i.s a"); ?></p>
    </div>
  </div>
  <div class="col-auto">
    <div class="p-1">
      <p><strong>Tempat</strong><br>
      <?php echo $program->pt_tempat; ?></p>
    </div>
  </div>
  <div class="col-auto">
    <div class="p-1">
      <p><strong>Perasmi</strong><br>
      <?php echo $program->pt_vip; ?></p>
    </div>
  </div>
  <div class="col-auto">
    <div class="p-1">
      <p><strong>Penceramah</strong><br>
      <?php echo $program->pt_penceramah; ?></p>
    </div>
  </div>
  <div class="col-auto">
    <div class="p-1">
      <p><strong>Jumlah Audien</strong><br>
      <?php echo $program->pt_audien; ?></p>
    </div>
  </div>
  <div class="col-12">
    <div class="p-1">
    <p><strong>Pengisian</strong></p>
    <?php echo $program->pt_pengisian; ?>
    </div>
  </div>
  <div class="col-auto">
    <div class="p-1">
      <p>
        <strong>Anjuran</strong><br>
        <?php echo $program->pt_anjuran; ?>
      </p>
    </div>
  </div>
  <div class="col-auto">
    <div class="p-1">
      <p>
        <strong>Jenis Program</strong><br>
        <?php echo $data_jenis->jenis($program->pt_jenisBil)->jt_nama; ?>
      </p>
    </div>
  </div>
</div>
  <?php echo anchor('program/kemaskini/'.$program->pt_bil, 'Kemaskini Program', "class = 'btn btn-sm btn-outline-secondary'"); ?>
</div>
<div class="p-3 border rounded mb-1">
<b><?php if(isset($response)) echo $response; ?></b>
<p><strong>Gambar-Gambar Program</strong></p>
<?php echo form_open_multipart('program/tambah_gambar/');?>
<div class="row g-1 mt-1">
<div class="col-auto">
  <div class="mb-1">
    <input type='file' name='userfile' size="20" class = "form-control">
  </div>
</div>
<div class="col-auto">
  <input type="hidden" name="inputBilProgram" value="<?php echo $program->pt_bil; ?>">
  <input type='submit' value='Upload' name='upload' class = "btn btn-sm btn-outline-secondary"/>
</div>
</div>

  </form>
</div>

<div class="row g-1 mb-1">
  <?php foreach($senaraiGambar as $gambar): ?>
  <div class="col-auto d-flex flex-column text-center">
    <div class="p-3 border">
        <img src="<?php echo base_url(); ?>assets/<?php echo $gambar->gt_nama; ?>" alt="<?php echo $program->pt_nama; ?>" style="height:200px;" class="rounded mb-1">
        <?php echo anchor('program/padam_gambar/'.$gambar->gt_bil, 'Padam Gambar', "class='btn btn-outline-danger btn-sm w-100 mt-auto'"); ?>
    </div>
  </div>
<?php endforeach; ?>
</div>
<?php endforeach; ?>
