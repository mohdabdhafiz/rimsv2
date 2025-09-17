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
      <?php 
      foreach($senaraiKluster as $kluster): ?>
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
        <a href="<?= site_url('dokumen') ?>">
          <i class="bi bi-circle"></i>
          <span>Dokumen Sokongan</span>
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

  <li class="nav-item">
    <a href="#" class="nav-link collapsed" data-bs-target="#bencana-nav" data-bs-toggle="collapse">
      <i class="bi bi-globe2"></i>
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
        <a href="<?= site_url('bencana/tambah') ?>">
          <i class="bi bi-circle"></i>
          <span>Borang Laporan</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('bencana/carianTerperinci') ?>">
          <i class="bi bi-search"></i>
          <span>Carian Terperinci</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item">
    <a href="#" class="nav-link collapsed" data-bs-target="#personel-nav" data-bs-toggle="collapse">
      <i class="bi bi-file-person"></i>
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
        <a href="<?= site_url('pengguna/senarai') ?>">
          <i class="bi bi-circle"></i>
          <span>Senarai</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('pengguna/tambah') ?>">
          <i class="bi bi-circle"></i>
          <span>Tambah Pengguna</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-heading">Konfigurasi</li>

  <li class="nav-item">
    <a href="#" class="nav-link collapsed" data-bs-target="#negeri-nav" data-bs-toggle="collapse">
      <i class="bi bi-person"></i>
      <span>Negeri</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="negeri-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= site_url('negeri') ?>">
          <i class="bi bi-circle"></i>
          <span>Laman</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('negeri/senarai') ?>">
          <i class="bi bi-circle"></i>
          <span>Senarai</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('negeri/tambah') ?>">
          <i class="bi bi-circle"></i>
          <span>Tambah</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item">
    <a href="#" class="nav-link collapsed" data-bs-target="#daerah-nav" data-bs-toggle="collapse">
      <i class="bi bi-person"></i>
      <span>Daerah</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="daerah-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= site_url('daerah') ?>">
          <i class="bi bi-circle"></i>
          <span>Laman</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('daerah/senarai') ?>">
          <i class="bi bi-circle"></i>
          <span>Senarai</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('daerah/tambah') ?>">
          <i class="bi bi-circle"></i>
          <span>Tambah</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item">
    <a href="#" class="nav-link collapsed" data-bs-target="#parlimen-nav" data-bs-toggle="collapse">
      <i class="bi bi-person"></i>
      <span>Parlimen</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="parlimen-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= site_url('parlimen') ?>">
          <i class="bi bi-circle"></i>
          <span>Laman</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('parlimen/senarai') ?>">
          <i class="bi bi-circle"></i>
          <span>Senarai</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('parlimen/tambah') ?>">
          <i class="bi bi-circle"></i>
          <span>Tambah</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item">
    <a href="#" class="nav-link collapsed" data-bs-target="#dun-nav" data-bs-toggle="collapse">
      <i class="bi bi-person"></i>
      <span>DUN</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="dun-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= site_url('dun') ?>">
          <i class="bi bi-circle"></i>
          <span>Laman</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('dun/status_tambah') ?>">
          <i class="bi bi-circle"></i>
          <span>Senarai</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('dun/tambah') ?>">
          <i class="bi bi-circle"></i>
          <span>Tambah</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item">
    <a href="#" class="nav-link collapsed" data-bs-target="#kon-pengguna-nav" data-bs-toggle="collapse">
      <i class="bi bi-person"></i>
      <span>Pengguna</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="kon-pengguna-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= site_url('pengguna') ?>">
          <i class="bi bi-circle"></i>
          <span>Laman</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('pengguna/senarai') ?>">
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

  <li class="nav-item">
    <a href="#" class="nav-link collapsed" data-bs-target="#peranan-nav" data-bs-toggle="collapse">
      <i class="bi bi-person"></i>
      <span>Peranan</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="peranan-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= site_url('peranan') ?>">
          <i class="bi bi-circle"></i>
          <span>Laman</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('peranan/senarai') ?>">
          <i class="bi bi-circle"></i>
          <span>Senarai</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('peranan/tambah') ?>">
          <i class="bi bi-circle"></i>
          <span>Tambah</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item">
    <a href="#" class="nav-link collapsed" data-bs-target="#pegawai-nav" data-bs-toggle="collapse">
      <i class="bi bi-person"></i>
      <span>Pegawai</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="pegawai-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= site_url('pegawai') ?>">
          <i class="bi bi-circle"></i>
          <span>Laman</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('pegawai/senarai') ?>">
          <i class="bi bi-circle"></i>
          <span>Senarai</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('pegawai/tambah') ?>">
          <i class="bi bi-circle"></i>
          <span>Tambah</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item">
    <a href="#" class="nav-link collapsed" data-bs-target="#japen-nav" data-bs-toggle="collapse">
      <i class="bi bi-person"></i>
      <span>JaPen</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="japen-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= site_url('japen') ?>">
          <i class="bi bi-circle"></i>
          <span>Laman</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('japen/senarai') ?>">
          <i class="bi bi-circle"></i>
          <span>Senarai</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('japen/tambah') ?>">
          <i class="bi bi-circle"></i>
          <span>Tambah</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item">
  <a href="#" class="nav-link collapsed" data-bs-target="#jenis-nav" data-bs-toggle="collapse">
    <i class="bi bi-gear"></i>
    <span>JENIS PROGRAM</span>
    <i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="jenis-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
    <li>
      <a href="<?= site_url('jenis') ?>">
        <i class="bi bi-circle"></i>
        <span>Laman</span>
      </a>
    </li>
    <li>
      <a href="<?= site_url('jenis/tambah') ?>">
        <i class="bi bi-circle"></i>
        <span>Tambah</span>
      </a>
    </li>
  </ul>
</li>

<li class="nav-item">
  <a href="#" class="nav-link collapsed" data-bs-target="#kandungan-nav" data-bs-toggle="collapse">
    <i class="bi bi-gear"></i>
    <span>SENARAI TAJUK HEBAHAN / CERAMAH PROGRAM</span>
    <i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="kandungan-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
    <li>
      <a href="<?= site_url('konfigurasi/senaraiKandungan') ?>">
        <i class="bi bi-circle"></i>
        <span>Senarai</span>
      </a>
    </li>
    <li>
      <a href="<?= site_url('konfigurasi/tambahSenaraiKandungan') ?>">
        <i class="bi bi-circle"></i>
        <span>Tambah</span>
      </a>
    </li>
  </ul>
</li>

<li class="nav-item">
  <a href="#" class="nav-link collapsed" data-bs-target="#pengisian-nav" data-bs-toggle="collapse">
    <i class="bi bi-gear"></i>
    <span>SENARAI PENGISIAN PROGRAM</span>
    <i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="pengisian-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
    <li>
      <a href="<?= site_url('konfigurasi/senaraiPengisian') ?>">
        <i class="bi bi-circle"></i>
        <span>Senarai</span>
      </a>
    </li>
    <li>
      <a href="<?= site_url('konfigurasi/tambahSenaraiPengisian') ?>">
        <i class="bi bi-circle"></i>
        <span>Tambah</span>
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
    </ul>
  </li>

<?php endif; ?>



</ul>

</aside><!-- End Sidebar-->