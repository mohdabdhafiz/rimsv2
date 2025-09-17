<div class="p-3 border rounded mb-3">
  <h3>SENARAI PROGRAM</h3>
  <div class="row g-3 mt-3">
    <div class="col-12 col-lg-3 col-md-6 col-sm-12">
      <?php echo anchor('program', 'Senarai Program', "class = 'btn btn-primary w-100'"); ?>
    </div>
    <div class="col-12 col-lg-3 col-md-6 col-sm-12">
      <?php echo anchor('program/tambah', 'Tambah Program', "class = 'btn btn-secondary w-100'"); ?>
    </div>
    <div class="col-12 col-lg-3 col-md-6 col-sm-12">
      <?php echo anchor('kpi', 'KPI Program', "class = 'btn btn-info w-100'"); ?>
    </div>
    <div class="col-12 col-lg-3 col-md-6 col-sm-12">
    <?php echo anchor('jenis', 'Jenis Program', "class = 'btn btn-dark w-100'"); ?>
    </div>
  </div>
</div>
<?php if($senaraiProgram){ ?>
  <div class="row g-3 mb-3">
    <?php foreach($senaraiProgram as $program): ?>
      <div class="col-12 col-lg-4 col-md-6 col-sm-12 d-flex align-items-stretch">
        <div class="p-3 border rounded d-flex flex-column w-100">
          <?php $nama_gambar = $dataGambar->satuGambar($program->pt_bil);
          if(!empty($nama_gambar)){ ?>
            <img src="<?php echo base_url(); ?>assets/<?php echo $nama_gambar->gt_nama; ?>" alt="<?php echo $program->pt_nama; ?>" class="rounded mb-3" style="width:100%; height:200px; object-fit:cover;">
          <?php } ?>
          <h3><?php echo $program->pt_nama; ?></h3>
          <p><?php echo $program->pt_tarikhMasa; ?></p>
          <p><?php echo $program->pt_tempat; ?></p>
          <p><?php echo $program->pt_anjuran; ?></p>
          <p><?php echo $program->pt_audien; ?> orang</p>
          <div class="mt-auto">
            <?php echo anchor('program/bil/'.$program->pt_bil, 'Maklumat Lanjut', "class='btn btn-primary w-100'"); ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php }else{ ?>
  <div class="alert alert-warning">Tiada Program Yang Didaftarkan
</div>
  <?php } ?>
