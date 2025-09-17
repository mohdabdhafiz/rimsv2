<div class="p-3 border rounded my-3 pb-0">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><?php echo anchor(base_url(), 'RIMS', 'title="RIMS"'); ?> </li>
          <li class="breadcrumb-item active" aria-current="page"><i class='bx bxs-user'></i> Urus Setia</li>
        </ol>
      </nav>
    </div>

<div class="row g-3 mb-3">
  <div class="col-6 col-lg-3">
    <div class="p-3 border rounded shadow bg-info text-white text-center">
    <h1 class="display-1"><?php echo count($senarai_pilihanraya); ?></h1>
    <small>Pilihan Raya</small>
    <?php echo anchor('pilihanraya', 'Maklumat Lanjut', "class='btn btn-warning w-100 mt-3'"); ?>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="p-3 border rounded shadow bg-info text-white text-center">
      <h1 class="display-1"><?php echo count($senaraiParlimen); ?></h1>
      <small>Bilangan Parlimen</small>
      <?php echo anchor('parlimen', 'Maklumat Lanjut', "class='btn btn-warning w-100 mt-3'"); ?>
    </div>
  </div>
  <div class="col-6 col-lg-6">
    <div class="p-3 border rounded shadow bg-info text-white text-center">
      <h1 class="display-1"><?php echo count($senaraiCalonParlimen); ?></h1>
      <small>Bilangan Pencalonan Parlimen Keseluruhan (Kiraan Mengikut Nama)</small>
      <?php echo anchor('pencalonan', 'Maklumat Lanjut', "class='btn btn-warning w-100 mt-3'"); ?>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="p-3 border rounded shadow bg-info text-white text-center">
      <h1 class="display-1"><?php echo count($senarai_dun); ?></h1>
      <small>Bilangan DUN</small>
      <?php echo anchor('dun', 'Maklumat Lanjut', "class='btn btn-warning w-100 mt-3'"); ?>
    </div>
  </div>
  <div class="col-6 col-lg-6">
    <div class="p-3 border rounded shadow bg-info text-white text-center">
      <h1 class="display-1"><?php echo count($senarai_calon); ?></h1>
      <small>Bilangan Pencalonan DUN Keseluruhan (Kiraan Mengikut Nama)</small>
      <?php echo anchor('pencalonan', 'Maklumat Lanjut', "class='btn btn-warning w-100 mt-3'"); ?>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="p-3 border rounded shadow bg-info text-white text-center">
      <h1 class="display-1"><?php echo count($senarai_parti); ?></h1>
      <small>Bilangan Parti</small>
      <?php echo anchor('parti', 'Maklumat Lanjut', "class='btn btn-warning w-100 mt-3'"); ?>
    </div>
  </div>
  <div class="col-6 col-lg-6">
    <div class="p-3 border rounded shadow bg-info text-white text-center">
      <h1 class="display-1"><?php echo count($senarai_pengguna); ?></h1>
      <small>Bilangan Pengguna</small>
      <?php echo anchor('pengguna', 'Maklumat Lanjut', "class='btn btn-warning w-100 mt-3'"); ?>
    </div>
  </div>
  <div class="col-6 col-lg-6">
    <div class="p-3 border rounded shadow bg-info text-white text-center">
      <h1 class="display-1"><?php echo count($senarai_peranan); ?></h1>
      <small>Bilangan Peranan</small>
      <?php echo anchor('peranan', 'Maklumat Lanjut', "class='btn btn-warning w-100 mt-3'"); ?>
    </div>
  </div>
</div>

<div class="row g-3 mb-3">
  <div class="col col-lg-3 col-md-4 col-sm-6">
    <div class="p-3 border rounded shadow text-center">
      <h1 class="display-1"><?php echo count($senaraiJenisProgram); ?></h1>
      <small>Bilangan Jenis Program</small>
      <?php echo anchor('jenis', 'Maklumat Lanjut', "class='btn btn-primary w-100 mt-3'"); ?>
    </div>
  </div>
  <div class="col col-lg-3 col-md-4 col-sm-6">
    <div class="p-3 border rounded shadow text-center">
    <h1 class="display-1"><?php echo count($senaraiProgram); ?></h1>
    <small>Bilangan Keseluruhan Program</small>
      <?php echo anchor('program', 'Maklumat Lanjut', "class='btn btn-primary w-100 mt-3'"); ?>
    </div>
  </div>
  <?php $jumlahKeseluruhan = 0; 
    foreach($senaraiJenisProgram as $jenisProgram): 
    $program = $dataProgram->senaraiJenis($jenisProgram->jt_bil); 
    $jumlahIkutJenis = count($program) * $jenisProgram->jt_peruntukan;
    $jumlahKeseluruhan = $jumlahKeseluruhan + $jumlahIkutJenis;
    ?>
  <div class="col col-lg-6 col-md-6 col-sm-12">
    <div class="p-3 border rounded shadow text-center">
    <h1 class="display-1"><?php echo count($program); ?></h1>
    <small>Bilangan <?php echo $jenisProgram->jt_nama; ?></small>
      <?php echo anchor('jenis', 'Maklumat Lanjut', "class='btn btn-primary w-100 mt-3'"); ?>
    </div>
  </div>
  <?php endforeach; ?>
  <div class="col col-lg-6 col-md-4 col-sm-6">
    <div class="p-3 border rounded shadow text-center">
    <h1 class="display-1">RM <?php echo number_format($jumlahKeseluruhan, 2, '.', ','); ?></h1>
    <small>Jumlah Peruntukan Keseluruhan Program</small>
      <?php echo anchor('program', 'Maklumat Lanjut', "class='btn btn-primary w-100 mt-3'"); ?>
    </div>
  </div>
</div>






