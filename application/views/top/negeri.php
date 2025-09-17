<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url() ?>">RIMS</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?= $negeri->nt_nama ?></li>
  </ol>
</nav>

<div class="mb-3">
    <?php $this->load->view('top/nav'); ?>
</div>

<div class="p-3 border rounded mb-3">
    <div class="row">
        <div class="col col-lg-auto">
            <img src="<?= base_url() ?>assets/bendera/<?= $negeri->nt_nama_fail ?>" alt="<?= $negeri->nt_nama ?>" style="max-height:200px;">
        </div>
        <div class="col col-lg-auto">
            <p><strong><?= $negeri->nt_nama ?></strong></p>
        </div>
    </div>
</div>

<?php 
$this->load->view('data_virtualization/negeri/senarai_pilihanraya'); 
?>


