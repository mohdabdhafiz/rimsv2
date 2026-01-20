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
    </ul>
  </li>

  <li class="nav-item">
    <a href="#" class="nav-link collapsed" data-bs-target="#komuniti-nav" data-bs-toggle="collapse">
      <i class="bi bi-file-person"></i>
      <span>RIMS@KOMUNITI</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="komuniti-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= site_url('komuniti') ?>">
          <i class="bi bi-circle"></i>
          <span>Laman</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('komuniti/senarai') ?>">
          <i class="bi bi-circle"></i>
          <span>Senarai</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('komuniti/daftar') ?>">
          <i class="bi bi-circle"></i>
          <span>Daftar Komuniti</span>
        </a>
      </li>
    </ul>
  </li>

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
      <li><a href="<?= site_url('lapis') ?>"><i class="bi bi-circle"></i><span>Laman</span></a></li>
      <li><a href="<?= site_url('lapis/pilih_kluster') ?>"><i class="bi bi-circle"></i><span>Tambah Laporan Baharu</span></a></li>
    </ul>
  </li>

  <li class="nav-item">
    <a href="#" class="nav-link collapsed" data-bs-target="#sentimen-nav" data-bs-toggle="collapse">
      <i class="bi bi-files"></i>
      <span>RIMS@LKS</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="sentimen-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= site_url('sentimen') ?>">
          <i class="bi bi-circle"></i>
          <span>Laman RIMS@LKS</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('sentimen/senarai') ?>">
          <i class="bi bi-circle"></i>
          <span>Senarai LKS</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('sentimen/borang') ?>">
          <i class="bi bi-circle"></i>
          <span>Borang LKS</span>
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
      <li>
        <a href="<?= site_url('ppd/kemaskiniPegawai') ?>">
          <i class="bi bi-circle"></i>
          <span>Kemaskini PPD</span>
        </a>
      </li>
    </ul>
  </li>

<?php endif; ?>

</ul>

</aside><!-- End Sidebar-->