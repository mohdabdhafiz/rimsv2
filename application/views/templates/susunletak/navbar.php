<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="<?= site_url('utama') ?>" class="logo d-flex align-items-center">
      <img src="<?= base_url('assets/img/logo_japen.png') ?>" alt="Logo JaPen">
      <span class="d-none d-lg-block">RIMS</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><div class="search-bar">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
      <input type="text" name="query" placeholder="Carian" title="Masukkan kata kunci carian">
      <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
  </div><nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item d-block d-lg-none">
        <a class="nav-link nav-icon search-bar-toggle " href="#">
          <i class="bi bi-search"></i>
        </a>
      </li><li class="nav-item dropdown">
        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-bell"></i>
          <span class="badge bg-primary badge-number">4</span>
        </a><ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
          <li class="dropdown-header">
            Anda mempunyai 4 notifikasi baharu
          </li>
          </ul>
      </li><li class="nav-item dropdown">
        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-chat-left-text"></i>
          <span class="badge bg-success badge-number">3</span>
        </a><ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
           <li class="dropdown-header">
              Anda mempunyai 3 mesej baharu
            </li>
            </ul>
      </li><li class="nav-item dropdown pe-3">
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="<?= base_url('assets/img/profile-img.jpg') ?>" alt="Profile" class="rounded-circle">
          <span class="d-none d-md-block dropdown-toggle ps-2"><?= htmlspecialchars($this->session->userdata('pengguna_nama') ?? 'Pengguna') ?></span>
        </a><ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6><?= htmlspecialchars($this->session->userdata('pengguna_nama') ?? 'Pengguna') ?></h6>
            <span><?= htmlspecialchars($this->session->userdata('peranan') ?? 'Peranan') ?></span>
          </li>
          <li><hr class="dropdown-divider"></li>
          <li>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <i class="bi bi-person"></i>
              <span>Profil Saya</span>
            </a>
          </li>
          <li><hr class="dropdown-divider"></li>
          <li>
            <a class="dropdown-item d-flex align-items-center" href="<?= site_url('pengguna/logout') ?>">
              <i class="bi bi-box-arrow-right"></i>
              <span>Log Keluar</span>
            </a>
          </li>
        </ul></li></ul>
  </nav></header>

