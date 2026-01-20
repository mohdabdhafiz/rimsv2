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
      <li><a href="<?= site_url('dm') ?>"><i class="bi bi-circle"></i><span>Daerah Mengundi</span></a></li>
      <li><a href="<?= site_url('dm') ?>"><i class="bi bi-circle"></i><span>Jangkaan Calon</span></a></li>
      <li><a href="<?= site_url('dm') ?>"><i class="bi bi-circle"></i><span>Petugas PRU / PRN / PRK</span></a></li>
      <li><a href="<?= site_url('dm') ?>"><i class="bi bi-circle"></i><span>Hari Penamaan Calon</span></a></li>
      <li><a href="<?= site_url('dm') ?>"><i class="bi bi-circle"></i><span>Aktiviti Kempen Lapangan</span></a></li>
      <li><a href="<?= site_url('dm') ?>"><i class="bi bi-circle"></i><span>Grading</span></a></li>
      <li><a href="<?= site_url('dm') ?>"><i class="bi bi-circle"></i><span>Hari Mengundi</span></a></li>
    </ul>
  </li>

  <li class="nav-item">
    <a href="#" class="nav-link collapsed" data-bs-target="#lapis-nav" data-bs-toggle="collapse">
      <i class="bi bi-files"></i>
      <span>RIMS@LAPIS</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="lapis-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li><a href="<?= site_url('lapis') ?>"><i class="bi bi-circle"></i><span>Laman</span></a></li>
      <li><a href="<?= site_url('lapis/pilih_kluster') ?>"><i class="bi bi-circle"></i><span>Tambah Laporan Baharu</span></a></li>
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

  



  <!-- End Components Nav -->


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
<?php if(!empty($ppd) && $pengguna->bil == $ppd->bil): ?>
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
      <li>
        <a href="<?= site_url('ppd/kemaskiniPegawai') ?>">
          <i class="bi bi-circle"></i>
          <span>Kemaskini PPD</span>
        </a>
      </li>
<?php endif; ?>
    </ul>
  </li>


</ul>

</aside><!-- End Sidebar-->