<div class="mb-3 text-end">
			<?php echo anchor('program', 'Laman Utama Program', "class = 'btn btn-outline-info'"); ?>
      <?php echo anchor('program/tambah', 'Tambah Program', "class = 'btn btn-outline-primary'"); ?>
			<?php echo anchor('program/recap', 'Recap Program', "class = 'btn btn-outline-success'"); ?>
			<?php echo anchor('jenis', 'Jenis Program', "class = 'btn btn-outline-success'"); ?>
</div>
<?php
if(count($dataProgram->semua()) != 0){
$senaraiProgram = $dataProgram->semua();
$maxValue = count($senaraiProgram);
$randomNumber = rand(0, $maxValue);

$senaraiGambar = $dataGambar->semua();
$maxGambar = count($senaraiGambar);
$randomNumberGambar = rand(0, $maxGambar);
$gambar = $dataGambar->gambar($randomNumberGambar);
$program = $dataProgram->programDetail($gambar->gt_bilProgram);
?>

  <div class="mb-3 p-3" style="font-size:20pt; line-height:2rem; width:600px;">

    <img src="<?php echo base_url(); ?>assets/<?php echo $gambar->gt_nama; ?>" alt="<?php echo $program->pt_nama; ?>" class="rounded mb-3" style="object-fit: contain; max-width: 100%; max-height:500px;">



  <p><strong><?php echo strtoupper($program->pt_nama); ?></strong><br />Anjuran <?php echo $program->pt_anjuran; ?><br />
  </p>
  <p><?php echo $program->pt_tempat; ?><br /><?php echo date_format(date_create($program->pt_tarikhMasa), "d.m.Y"); ?><br />

  </p>


  </div>
  <?php } ?>
