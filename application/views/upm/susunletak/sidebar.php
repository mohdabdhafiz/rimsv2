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
    <a href="#" class="nav-link collapsed" data-bs-target="#cpa-nav" data-bs-toggle="collapse">
      <i class="bi bi-file-ruled"></i>
      <span>RIMS@CPA</span>
      <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="cpa-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= site_url('cpa') ?>">
          <i class="bi bi-circle"></i>
          <span>Laman Utama</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('cpa/risikan') ?>">
          <i class="bi bi-circle"></i>
          <span>Risikan Program</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('cpa/pemantauan') ?>">
          <i class="bi bi-circle"></i>
          <span>Pemantauan Lapangan</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('cpa/pelaporan') ?>">
          <i class="bi bi-circle"></i>
          <span>Laporan</span>
        </a>
      </li>
    </ul>
  </li><!-- End RIMS@CPA Nav -->



</ul>

</aside><!-- End Sidebar-->