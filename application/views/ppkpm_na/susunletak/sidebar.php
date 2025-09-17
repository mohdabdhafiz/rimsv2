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
        <a href="<?= site_url('program/senarai') ?>">
          <i class="bi bi-circle"></i>
          <span>Senarai</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('ppkpm/perancanganProgram') ?>">
          <i class="bi bi-circle"></i>
          <span>Perancangan Program</span>
        </a>
      </li>
      <li>
        <a href="<?= site_url('ppkpm/pelaksanaanProgram') ?>">
          <i class="bi bi-circle"></i>
          <span>Pelaksanaan Program</span>
        </a>
      </li>
    </ul>
  </li>

</ul>

</aside><!-- End Sidebar-->