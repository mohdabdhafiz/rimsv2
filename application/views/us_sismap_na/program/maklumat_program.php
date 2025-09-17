<div class="mb-1">
    <?php $this->load->view('us_sismap_na/program/nav'); ?>
</div>

<div class="p-3 border rounded mb-1">
  <p><strong>Status Pendaftaran Program</strong></p>
  <p>Pendaftaran Program Berjaya!</p>
  <?php foreach($senaraiProgram as $program): ?>
    <p>
        Nama Program<br> 
        <strong><?php echo $program->pt_nama; ?></strong>
    </p>
    <p><?php echo anchor('program/bil/'.$program->pt_bil, 'Lihat Maklumat Program', "class = 'btn btn-outline-secondary btn-sm'"); ?></p>
  <?php endforeach; ?>
</div>
