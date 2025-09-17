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
      <i class="bi bi-file-ruled"></i>
      <span>RIMS@SISMAP</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="sismap-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= site_url('sismap') ?>">
          <i class="bi bi-circle"></i>
          <span>SISMAP</span>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item">
    <a href="#" class="nav-link collapsed" data-bs-target="#lapis-nav" data-bs-toggle="collapse">
      <i class="bi bi-file-ruled"></i>
      <span>RIMS@LAPIS</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="lapis-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= site_url('lapis') ?>">
          <i class="bi bi-circle"></i>
          <span>LAPIS</span>
        </a>
      </li>
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

  

</ul>

</aside><!-- End Sidebar-->