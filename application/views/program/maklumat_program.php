<div class="p-3 border rounded mb-3">
  <h1>Status Pendaftaran Program</h1>
  <p>Pendaftaran Program Berjaya!</p>
  <?php foreach($senaraiProgram as $program): ?>
    <p>Nama Program: <?php echo $program->pt_nama; ?></p>
    <p><?php echo anchor('program/bil/'.$program->pt_bil, 'Lihat Maklumat Program', "class = 'btn btn-outline-success btn-sm'"); ?></p>
  <?php endforeach; ?>
  <div class="row g-3">
    <div class="col col-sm-12">
      <?php echo anchor('program', 'Senarai Program', "class = 'btn btn-primary w-100'"); ?>
    </div>
    <div class="col col-sm-12">
      <?php echo anchor('program/tambah', 'Tambah Program', "class = 'btn btn-secondary w-100'"); ?>
    </div>
  </div>
</div>
