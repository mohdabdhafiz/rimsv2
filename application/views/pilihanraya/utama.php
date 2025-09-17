
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><?php echo anchor(base_url(), 'RIMS'); ?> </li>
          <li class="breadcrumb-item active" aria-current="page"><i class='bx bxs-city'></i> Pilihan Raya</li>
        </ol>
      </nav>

<div class="p-3 border rounded mb-3">
  <h3>PILIHAN RAYA</h3>
  <div class="row g-3 mt-3">
    <div class="col-12 col-lg-4 col-md-6 col-sm-12">
      <?php echo anchor('pilihanraya', 'Pilihan Raya', "class='btn btn-primary w-100'"); ?>
    </div>
    <div class="col-12 col-lg-4 col-md-6 col-sm-12">
      <?php echo anchor('pilihanraya/tambah', 'Daftar Pilihan Raya', "class='btn btn-secondary w-100'"); ?>
    </div>
    <div class="col-12 col-lg-4 col-md-6 col-sm-12">
      <?php echo anchor('winnable_candidate', 'Winnable Candidate Parlimen', "class='btn btn-info w-100'"); ?>
    </div>
  </div>
</div>

<div class="row g-3 mb-3">
  <?php foreach($senarai_pilihanraya as $pilihanraya): ?>
  <div class="col-12 col-lg-6 col-md-6 col-sm-12 d-flex align-items-stretch">
    <div class="p-3 border rounded w-100 d-flex flex-column">
      <h3><?php echo $pilihanraya->pilihanraya_nama; ?></h3>
      <p><?php echo $pilihanraya->pilihanraya_singkatan; ?></p>
      <p>Tahun <?php $t = date_format(date_create($pilihanraya->pilihanraya_tahun), "Y"); echo $t; ?></p>
      <p>Status Pengemaskinian Maklumat : <?php echo $pilihanraya->pilihanraya_status; ?></p>
      <div class="row g-3 mt-auto">
        <div class="col-12 col-lg-6 col-md-6 col-sm-12">
          <?php echo anchor('pilihanraya/info/'.$pilihanraya->pilihanraya_bil, 'KEMASKINI', array('class' => 'btn btn-outline-info w-100')); ?>
        </div>
        <div class="col-12 col-lg-6 col-md-6 col-sm-12">
          <a href="<?= site_url('pilihanraya/senaraiGrading/'.$pilihanraya->pilihanraya_bil) ?>" class="btn btn-outline-primary w-100">SENARAI GRADING</a>
        </div>
        <div class="col-12 col-lg-6 col-md-6 col-sm-12">
          <?php echo anchor('pilihanraya/padam/'.$pilihanraya->pilihanraya_bil, 'PADAM', array('class' => 'btn btn-outline-danger w-100')); ?>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>