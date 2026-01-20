<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url() ?>">
      <i class="bi bi-grid"></i>
      <span>Utama</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-item">
    <a href="#" class="nav-link collapsed" data-bs-target="#lapis2-nav" data-bs-toggle="collapse">
      <i class="bi bi-file-earmark-plus"></i>
      <span>RIMS@LAPIS2.0</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="lapis2-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= site_url('lapis2') ?>">
          <i class="bi bi-circle"></i><span>LAMAN UTAMA RIMS@LAPIS2.0</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('lapis2/dashboard') ?>">
          <i class="bi bi-circle"></i><span>DASHBOARD</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('lapis2/senaraiLaporan') ?>">
          <i class="bi bi-circle"></i><span>SENARAI LAPORAN</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('lapis2/tambahLaporan') ?>">
          <i class="bi bi-circle"></i><span>TAMBAH LAPORAN</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item">
    <a href="#" class="nav-link collapsed" data-bs-target="#sismap-nav" data-bs-toggle="collapse">
      <i class="bi bi-file-lock"></i>
      <span>RIMS@SISMAP</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="sismap-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= site_url('harian') ?>">
          <i class="bi bi-circle"></i><span>Etnografi</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('pilihanraya') ?>">
          <i class="bi bi-circle"></i><span>Pilihan Raya</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('scoresheet') ?>">
          <i class="bi bi-circle"></i><span>Score Sheet</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('dp') ?>">
          <i class="bi bi-circle"></i><span>Maklumat Daftar Pengundi</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('') ?>">
          <i class="bi bi-circle"></i><span>Negeri</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('') ?>">
          <i class="bi bi-circle"></i><span>Daerah</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('') ?>">
          <i class="bi bi-circle"></i><span>Parlimen</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('') ?>">
          <i class="bi bi-circle"></i><span>DUN</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('') ?>">
          <i class="bi bi-circle"></i><span>Daerah Mengundi</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('') ?>">
          <i class="bi bi-circle"></i><span>Jangkaan Calon</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item">
    <a href="#" class="nav-link collapsed" data-bs-target="#lapis-nav" data-bs-toggle="collapse">
      <i class="bi bi-files"></i>
      <span>RIMS@LAPIS</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="lapis-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <?php foreach($senaraiKluster as $kluster): ?>
      <li>
        <a href="<?= site_url('lapis/'.$kluster->kit_shortform) ?>">
          <i class="bi bi-circle"></i>
          <span><?= $kluster->kit_nama ?></span>
        </a>
      </li>
      <?php endforeach; ?>
    </ul>
  </li>

  <li class="nav-item">
    <a href="#" class="nav-link collapsed" data-bs-target="#sentimen-nav" data-bs-toggle="collapse">
      <i class="bi bi-files"></i>
      <span>RIMS@LPK</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="sentimen-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= site_url('sentimen') ?>">
          <i class="bi bi-circle"></i>
          <span>Laman</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('sentimen/senarai') ?>">
          <i class="bi bi-circle"></i>
          <span>Senarai Laporan</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('sentimen/borang') ?>">
          <i class="bi bi-circle"></i>
          <span>Borang Laporan</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item">
    <a href="#" class="nav-link collapsed" data-bs-target="#bencana-nav" data-bs-toggle="collapse">
      <i class="bi bi-globe"></i>
      <span>RIMS@BENCANA</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="bencana-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= site_url('bencana') ?>">
          <i class="bi bi-circle"></i>
          <span>Laman</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('bencana/senarai') ?>">
          <i class="bi bi-circle"></i>
          <span>Senarai</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('bencana/carian') ?>">
          <i class="bi bi-search"></i>
          <span>Carian</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('bencana/tambah') ?>">
          <i class="bi bi-search"></i>
          <span>Tambah</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item">
    <a href="#" class="nav-link collapsed" data-bs-target="#program-nav" data-bs-toggle="collapse">
      <i class="bi bi-file-ruled"></i>
      <span>RIMS@PROGRAM</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="program-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= site_url('program') ?>">
          <i class="bi bi-circle"></i>
          <span>Laman</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('program/senarai') ?>">
          <i class="bi bi-circle"></i>
          <span>Senarai</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('program/tambah') ?>">
          <i class="bi bi-circle"></i>
          <span>Tambah</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('program/senarai_kemaskini') ?>">
          <i class="bi bi-circle"></i>
          <span>Kemaskini</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('program/senarai_padam') ?>">
          <i class="bi bi-circle"></i>
          <span>Padam</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item">
    <a href="#" class="nav-link collapsed" data-bs-target="#obp-nav" data-bs-toggle="collapse">
      <i class="bi bi-file-person"></i>
      <span>RIMS@OBP</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="obp-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= site_url('obp') ?>">
          <i class="bi bi-circle"></i>
          <span>Laman</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('obp/senarai') ?>">
          <i class="bi bi-circle"></i>
          <span>Senarai</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('obp/tambah') ?>">
          <i class="bi bi-circle"></i>
          <span>Tambah Maklumat OBP</span>
        </a>
      </li>
    </ul>
  </li>

  <!-- End Components Nav -->

  <?php if(empty($pengguna->pengguna_status)): ?>

  <li class="nav-heading">Pentadbir</li>

  <li class="nav-item">
    <a href="#" class="nav-link collapsed" data-bs-target="#pengguna-nav" data-bs-toggle="collapse">
      <i class="bi bi-person"></i>
      <span>RIMS@PERSONEL</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="pengguna-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= site_url('pengguna') ?>">
          <i class="bi bi-circle"></i>
          <span>Laman</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('pengguna/status_tambah') ?>">
          <i class="bi bi-circle"></i>
          <span>Senarai</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('pengguna/tambah') ?>">
          <i class="bi bi-circle"></i>
          <span>Tambah</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('pengguna/pertukaran') ?>">
          <i class="bi bi-circle"></i>
          <span>Pertukaran</span>
        </a>
      </li>
    </ul>
  </li>

<?php endif; ?>

</ul>

</aside><!-- End Sidebar-->