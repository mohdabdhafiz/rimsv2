<div class="mb-3">
<h3>PERANAN</h3>
<p>Senarai Peranan (Bilangan Peranan: <?php echo count($senaraiPeranan); ?>)</p>

<?php $this->load->view('urusetia_na/peranan/nav'); ?>

<div class="row g-3">
  <div class="col col-lg-4 col-md-4 col-sm-12 d-flex align-self-stretch">
    <div class="border rounded w-100 d-flex">
      <?php echo anchor('peranan/tambah', 'Tambah Peranan Baharu', "class='btn btn-primary w-100 d-flex align-items-center justify-content-center'"); ?>
    </div>
  </div>
  <?php foreach($senaraiPeranan as $peranan): ?>
  <div class="col col-lg-4">
    <div class="p-3 border rounded">
    <p>
      <strong><?php echo $peranan->peranan_nama; ?></strong>
      <br><em><?= $peranan->jt_pejabat ?></em>
    </p>
    <p>Bilangan Pengguna: <?php $bilPengguna = $dataPengguna->bilanganPerananPengguna($peranan->peranan_bil); echo $bilPengguna->bilanganPengguna; ?></p>
    <div class="mt-auto">
    <p><?php echo anchor('peranan/senarai_pengguna/'.$peranan->peranan_bil, 'Senarai Pengguna', "class='btn btn-info w-100'"); ?></p>
    <p><?php echo anchor('peranan/tambah_peranan_pengguna/'.$peranan->peranan_bil, 'Tambah Peranan '.$peranan->peranan_nama, "class='btn btn-primary w-100'"); ?></p>
    </div>
  </div>
  </div>
  <?php endforeach; ?>
</div>
</div>