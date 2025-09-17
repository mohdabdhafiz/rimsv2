<div class="p-3 border rounded mb-3">
  <h3>MAKLUMAT PROGRAM</h3>
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


<?php foreach($senaraiProgram as $program): ?>
  <div class="p-3 border rounded mb-3">
<h1><?php echo $program->pt_nama; ?></h1>
<div class="row g-3 mt-3">
  <div class="col-12 col-lg-4 col-md-6 col-sm-12">
    <div class="p-3">
      <p><strong>Tarikh</strong><br> 
      <?php echo date_format(date_create($program->pt_tarikhMasa), "d.m.Y"); ?></p>
    </div>
  </div>
  <div class="col-12 col-lg-4 col-md-6 col-sm-12">
    <div class="p-3">
      <p><strong>Masa</strong><br> 
      <?php echo date_format(date_create($program->pt_tarikhMasa), "H.i.sa"); ?></p>
    </div>
  </div>
  <div class="col-12 col-lg-4 col-md-6 col-sm-12">
    <div class="p-3">
      <p><strong>Tempat</strong><br>
      <?php echo $program->pt_tempat; ?></p>
    </div>
  </div>
  <div class="col-12 col-lg-4 col-md-4 col-sm-12">
    <div class="p-3">
      <p><strong>Perasmi</strong><br>
      <?php echo $program->pt_vip; ?></p>
    </div>
  </div>
  <div class="col-12 col-lg-4 col-md-4 col-sm-12">
    <div class="p-3">
      <p><strong>Penceramah</strong><br>
      <?php echo $program->pt_penceramah; ?></p>
    </div>
  </div>
  <div class="col-12 col-lg-3 col-md-4 col-sm-12">
    <div class="p-3">
      <p><strong>Jumlah Audien</strong><br>
      <?php echo $program->pt_audien; ?></p>
    </div>
  </div>
  <div class="col-12">
    <div class="p-3">
    <p><strong>Pengisian</strong></p>
    <?php echo $program->pt_pengisian; ?>
    </div>
  </div>
  <div class="col-12 col-lg-6 col-md-6 col-sm-12">
    <div class="p-3">
      <p>
        <strong>Anjuran</strong><br>
        <?php echo $program->pt_anjuran; ?>
      </p>
    </div>
  </div>
  <div class="col-12 col-lg-6 col-md-6 col-sm-12">
    <div class="p-3">
      <p>
        <strong>Jenis Program</strong><br>
        <?php echo $data_jenis->jenis($program->pt_jenisBil)->jt_nama; ?>
      </p>
    </div>
  </div>
</div>
<p>
  <?php echo anchor('program/kemaskini/'.$program->pt_bil, 'Kemaskini Program', "class = 'btn btn-primary w-100'"); ?>
</p>
</div>
<div class="p-3 border rounded mb-3">
<b><?php if(isset($response)) echo $response; ?></b>
<h3>Gambar-Gambar Program</h3>
<?php echo form_open_multipart('program/tambah_gambar/');?>
<div class="row g-3 mt-3">
<div class="col">
  <div class="mb-3">
    <input type='file' name='userfile' size="20" class = "form-control">
  </div>
</div>
<div class="col">
  <input type="hidden" name="inputBilProgram" value="<?php echo $program->pt_bil; ?>">
  <input type='submit' value='Upload' name='upload' class = "btn btn-primary"/>
</div>
</div>

  </form>
</div>

<div class="row g-3 mb-3">
  <?php foreach($senaraiGambar as $gambar): ?>
  <div class="col-12 col-lg-6 d-flex flex-column">
    <img src="<?php echo base_url(); ?>assets/<?php echo $gambar->gt_nama; ?>" alt="<?php echo $program->pt_nama; ?>" class="rounded w-100 mb-3">
    <?php echo anchor('program/padam_gambar/'.$gambar->gt_bil, 'Padam Gambar', "class='btn btn-outline-danger btn-sm w-100 mt-auto'"); ?>
  </div>
<?php endforeach; ?>
</div>
<?php endforeach; ?>
