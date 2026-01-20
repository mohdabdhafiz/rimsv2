<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url() ?>">
      <i class="bi bi-grid"></i>
      <span>UTAMA</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-item">
    <a href="#" class="nav-link collapsed" data-bs-target="#sismap-nav" data-bs-toggle="collapse">
      <i class="bi bi-file-lock"></i>
      <span>RIMS@SISMAP</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="sismap-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
    <li>
        <a href="<?= site_url('winnable_candidate') ?>">
          <i class="bi bi-circle"></i><span>Modul Jangkaan Calon</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('pencalonan') ?>">
          <i class="bi bi-circle"></i><span>Modul Penamaan Calon</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('grading') ?>">
          <i class="bi bi-circle"></i><span>Modul Grading</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('undi') ?>">
          <i class="bi bi-circle"></i><span>Modul Hari Mengundi</span>
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
        <a href="<?= site_url('dpi') ?>">
          <i class="bi bi-circle"></i><span>Maklumat Daftar Pengundi</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('negeri') ?>">
          <i class="bi bi-circle"></i><span>Negeri</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('daerah') ?>">
          <i class="bi bi-circle"></i><span>Daerah</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('parlimen') ?>">
          <i class="bi bi-circle"></i><span>Parlimen</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('dun') ?>">
          <i class="bi bi-circle"></i><span>DUN</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('parti') ?>">
          <i class="bi bi-circle"></i><span>Parti</span>
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
      <li>
        <a href="<?= site_url('perancanganProgram') ?>">
          <i class="bi bi-circle"></i>
          <span>Perancangan Program</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('perancanganProgram/senarai') ?>">
          <i class="bi bi-circle"></i>
          <span>Senarai Perancangan Program</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('perancanganProgram/tambah') ?>">
          <i class="bi bi-circle"></i>
          <span>Tambah Perancangan Program</span>
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
    <a href="#" class="nav-link collapsed" data-bs-target="#personel-nav" data-bs-toggle="collapse">
      <i class="bi bi-person"></i>
      <span>RIMS@PERSONEL</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="personel-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
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
    </ul>
  </li>

<?php endif; ?>

</ul>

</aside><!-- End Sidebar-->