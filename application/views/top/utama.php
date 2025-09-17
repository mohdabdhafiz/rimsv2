<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url() ?>">RIMS</a></li>
    <li class="breadcrumb-item active" aria-current="page">Laman Utama</li>
  </ol>
</nav>

<div class="mb-3">
    <?php $this->load->view('top/nav'); ?>
</div>

<div class="row g-3">
    <?php 
    $namaNegeri = array();
    foreach($senaraiNegeri as $negeri){
        $namaNegeri[] = $negeri->nt_nama;
    }
    array_multisort($namaNegeri, SORT_ASC, $senaraiNegeri);
    foreach($senaraiNegeri as $negeri): ?>
    <div class="col-12 col-lg-3 col-md-4">
        <div class="p-3">
        <a href="<?= base_url() ?>index.php/negeri/bil/<?= $negeri->nt_bil ?>">
            <img src="<?= base_url() ?>assets/bendera/<?= $negeri->nt_nama_fail ?>" alt="<?= $negeri->nt_nama ?>" class="img-fluid w-100">
            <br> <div class="text-center mt-3"><?= $negeri->nt_nama ?></div>
        </a>
        </div>
    </div>
    <?php endforeach; ?>
</div>