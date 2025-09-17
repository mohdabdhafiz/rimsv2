<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link <?= ($this->uri->segment(1) == 'utama' || $this->uri->segment(1) == '') ? '' : 'collapsed' ?>" href="<?= site_url('utama') ?>">
        <i class="bi bi-grid"></i>
        <span>Papan Pemuka Utama</span>
      </a>
    </li><li class="nav-heading">Modul Utama</li>

    <li class="nav-item">
      <a class="nav-link <?= ($this->uri->segment(1) == 'personel') ? '' : 'collapsed' ?>" href="<?= site_url('personel') ?>">
        <i class="bi bi-people"></i>
        <span>RIMS@PERSONEL</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= ($this->uri->segment(1) == 'sismap') ? '' : 'collapsed' ?>" href="<?= site_url('sismap') ?>">
        <i class="bi bi-flag"></i>
        <span>RIMS@SISMAP</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= ($this->uri->segment(1) == 'lapis') ? '' : 'collapsed' ?>" href="<?= site_url('lapis') ?>">
        <i class="bi bi-chat-square-text"></i>
        <span>RIMS@LAPIS</span>
      </a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link <?= ($this->uri->segment(1) == 'kelabmalaysiaku') ? '' : 'collapsed' ?>" href="<?= site_url('kelabmalaysiaku') ?>">
        <i class="bi bi-collection"></i>
        <span>RIMS@KELABMALAYSIAKU</span>
      </a>
    </li>
    
    </ul>
</aside>