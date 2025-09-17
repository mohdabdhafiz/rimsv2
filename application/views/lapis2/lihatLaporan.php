<div class="pagetitle">
  <h1>Butiran Laporan</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= site_url('lapis2/senaraiLaporan') ?>">Senarai Laporan</a></li>
      <li class="breadcrumb-item active">Butiran Laporan #<?= htmlspecialchars($laporan->lapis_bil, ENT_QUOTES, 'UTF-8') ?></li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Maklumat Laporan</h5>

          <!-- Butiran Laporan -->
          <div class="row mb-3">
            <div class="col-lg-3 col-md-4 fw-bold">ID Laporan</div>
            <div class="col-lg-9 col-md-8">#<?= htmlspecialchars($laporan->lapis_bil, ENT_QUOTES, 'UTF-8') ?></div>
          </div>

          <div class="row mb-3">
            <div class="col-lg-3 col-md-4 fw-bold">Tarikh Laporan</div>
            <div class="col-lg-9 col-md-8"><?= date('d F Y', strtotime($laporan->lapis_tarikh_laporan)) ?></div>
          </div>
          
          <div class="row mb-3">
            <div class="col-lg-3 col-md-4 fw-bold">Pelapor</div>
            <div class="col-lg-9 col-md-8"><?= htmlspecialchars($laporan->lapis_pelapor_nama, ENT_QUOTES, 'UTF-8') ?></div>
          </div>

          <div class="row mb-3">
            <div class="col-lg-3 col-md-4 fw-bold">Status</div>
            <div class="col-lg-9 col-md-8">
                <?php 
                    $status = $laporan->lapis_status;
                    $badge_class = 'bg-primary';
                    if ($status == 'Laporan Dipinda') $badge_class = 'bg-warning text-dark';
                    if ($status == 'Laporan Ditolak') $badge_class = 'bg-danger';
                ?>
                <span class="badge <?= $badge_class ?>"><?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?></span>
            </div>
          </div>

          <hr>

          <h5 class="card-title mt-4">Butiran Isu</h5>

          <div class="row mb-3">
            <div class="col-lg-3 col-md-4 fw-bold">Tajuk Isu</div>
            <div class="col-lg-9 col-md-8"><?= htmlspecialchars($laporan->lapis_tajuk_isu, ENT_QUOTES, 'UTF-8') ?></div>
          </div>

          <div class="row mb-3">
            <div class="col-lg-3 col-md-4 fw-bold">Kluster</div>
            <div class="col-lg-9 col-md-8"><?= htmlspecialchars($laporan->lapis_kluster_nama, ENT_QUOTES, 'UTF-8') ?></div>
          </div>

          <div class="row mb-3">
            <div class="col-lg-3 col-md-4 fw-bold">Ringkasan Isu</div>
            <div class="col-lg-9 col-md-8">
                <!-- Memaparkan kandungan HTML dari TinyMCE -->
                <?= $laporan->lapis_ringkasan_isu ?>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-lg-3 col-md-4 fw-bold">Cadangan Intervensi</div>
            <div class="col-lg-9 col-md-8">
                <!-- Memaparkan kandungan HTML dari TinyMCE -->
                <?= $laporan->lapis_cadangan_intervensi ?>
            </div>
          </div>

          <hr>

          <h5 class="card-title mt-4">Maklumat Kawasan & Lokasi</h5>

          <div class="row mb-3">
            <div class="col-lg-3 col-md-4 fw-bold">Negeri</div>
            <div class="col-lg-9 col-md-8"><?= htmlspecialchars($laporan->lapis_negeri_nama, ENT_QUOTES, 'UTF-8') ?></div>
          </div>
          <div class="row mb-3">
            <div class="col-lg-3 col-md-4 fw-bold">Daerah</div>
            <div class="col-lg-9 col-md-8"><?= htmlspecialchars($laporan->lapis_daerah_nama, ENT_QUOTES, 'UTF-8') ?></div>
          </div>
          <div class="row mb-3">
            <div class="col-lg-3 col-md-4 fw-bold">Parlimen</div>
            <div class="col-lg-9 col-md-8"><?= htmlspecialchars($laporan->lapis_parlimen_nama, ENT_QUOTES, 'UTF-8') ?></div>
          </div>
          <div class="row mb-3">
            <div class="col-lg-3 col-md-4 fw-bold">DUN</div>
            <div class="col-lg-9 col-md-8"><?= htmlspecialchars($laporan->lapis_dun_nama, ENT_QUOTES, 'UTF-8') ?></div>
          </div>
          <div class="row mb-3">
            <div class="col-lg-3 col-md-4 fw-bold">Daerah Mengundi</div>
            <div class="col-lg-9 col-md-8"><?= htmlspecialchars($laporan->lapis_dm_nama, ENT_QUOTES, 'UTF-8') ?></div>
          </div>
          <div class="row mb-3">
            <div class="col-lg-3 col-md-4 fw-bold">Jenis Kawasan</div>
            <div class="col-lg-9 col-md-8"><?= htmlspecialchars($laporan->lapis_jenis_kawasan, ENT_QUOTES, 'UTF-8') ?></div>
          </div>
          <div class="row mb-3">
            <div class="col-lg-3 col-md-4 fw-bold">Nama Lokasi</div>
            <div class="col-lg-9 col-md-8"><?= htmlspecialchars($laporan->lapis_lokasi, ENT_QUOTES, 'UTF-8') ?></div>
          </div>
          <div class="row mb-3">
            <div class="col-lg-3 col-md-4 fw-bold">Koordinat</div>
            <div class="col-lg-9 col-md-8">
                <a href="https://www.google.com/maps?q=<?= htmlspecialchars($laporan->lapis_latitude, ENT_QUOTES, 'UTF-8') ?>,<?= htmlspecialchars($laporan->lapis_longitude, ENT_QUOTES, 'UTF-8') ?>" target="_blank">
                    <?= htmlspecialchars($laporan->lapis_latitude, ENT_QUOTES, 'UTF-8') ?>, <?= htmlspecialchars($laporan->lapis_longitude, ENT_QUOTES, 'UTF-8') ?>
                </a>
            </div>
          </div>

          <div class="text-center mt-4">
            <a href="<?= site_url('lapis2/senaraiLaporan') ?>" class="btn btn-secondary">Kembali ke Senarai</a>
            <a href="<?= site_url('lapis2/kemaskiniLaporan/' . $laporan->lapis_bil) ?>" class="btn btn-warning">Kemas Kini Laporan</a>
            <!-- KEMAS KINI DI SINI: Menambah butang PDF -->
            <a href="<?= site_url('lapis2/cetakPdf/' . $laporan->lapis_bil) ?>" class="btn btn-danger" target="_blank">
                <i class="bi bi-file-earmark-pdf"></i> Muat Turun PDF
            </a>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>
