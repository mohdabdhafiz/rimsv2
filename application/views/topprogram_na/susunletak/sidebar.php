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
      <li>
        <a href="<?= site_url('komuniti/carian') ?>">
          <i class="bx bi-circle"></i>
          <span>Daftar Ahli Komuniti</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item">
    <a href="#" class="nav-link collapsed" data-bs-target="#kelabmalaysiaku-nav" data-bs-toggle="collapse">
      <i class="bi bi-file-person"></i>
      <span>RIMS@KELABMALAYSIAKU</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="kelabmalaysiaku-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= site_url('kelabmalaysiaku') ?>">
          <i class="bi bi-circle"></i>
          <span>Laman</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('kelabmalaysiaku/senarai') ?>">
          <i class="bi bi-circle"></i>
          <span>Senarai</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('kelabmalaysiaku/daftar') ?>">
          <i class="bi bi-circle"></i>
          <span>Daftar Kelab Malaysiaku</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('kelabmalaysiaku/carian') ?>">
          <i class="bx bi-circle"></i>
          <span>Daftar Ahli Kelab Malaysiaku</span>
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
        <a href="<?= site_url('ketuaUnit/kemaskini') ?>">
          <i class="bi bi-circle"></i>
          <span>Lantikan PP BPKPM</span>
        </a>
      </li>
    </ul>
  </li>

<?php endif; ?>

<?php if(empty($pengguna->pengguna_status)): ?>

<li class="nav-heading">Konfigurasi</li>

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

<li class="nav-item">
  <a href="#" class="nav-link collapsed" data-bs-target="#agensi-nav" data-bs-toggle="collapse">
    <i class="bi bi-gear"></i>
    <span>SENARAI AGENSI LAIN</span>
    <i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="agensi-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
    <li>
      <a href="<?= site_url('konfigurasi/senaraiAgensi') ?>">
        <i class="bi bi-circle"></i>
        <span>Senarai</span>
      </a>
    </li>
    <li>
      <a href="<?= site_url('konfigurasi/tambahSenaraiAgensi') ?>">
        <i class="bi bi-circle"></i>
        <span>Tambah</span>
      </a>
    </li>
  </ul>
</li>

<li class="nav-item">
  <a href="#" class="nav-link collapsed" data-bs-target="#penerbitan-nav" data-bs-toggle="collapse">
    <i class="bi bi-gear"></i>
    <span>EDARAN PENERBITAN</span>
    <i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="penerbitan-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
    <li>
      <a href="<?= site_url('konfigurasi/senaraiPenerbitan') ?>">
        <i class="bi bi-circle"></i>
        <span>Senarai</span>
      </a>
    </li>
    <li>
      <a href="<?= site_url('konfigurasi/tambahSenaraiPenerbitan') ?>">
        <i class="bi bi-circle"></i>
        <span>Tambah</span>
      </a>
    </li>
  </ul>
</li>



<?php endif; ?>

</ul>

</aside><!-- End Sidebar-->
