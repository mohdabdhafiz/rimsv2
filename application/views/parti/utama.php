
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><?php echo anchor(base_url(), 'RIMS'); ?> </li>
        <li class="breadcrumb-item active" aria-current="page">Parti</li>
      </ol>
    </nav>

<div class="p-3 border rounded mb-3">
  <h3>PARTI</h3>
  <div class="row g-3 mt-3">
    <div class="col-12 col-lg-4 col-md-4 col-sm-12">
      <?php echo anchor('parti', 'Parti', "class='btn btn-primary w-100'"); ?>
    </div>
    <div class="col-12 col-lg-4 col-md-4 col-sm-12">
      <?php echo anchor('parti/daftar', 'Daftar Parti Baharu', "class='btn btn-secondary w-100'"); ?>
    </div>
    <div class="col-12 col-lg-4 col-md-4 col-sm-12">
      <?php echo anchor('parti/pilihan_parti', 'Konfigurasi Pilihan Parti', "class='btn btn-info w-100'"); ?>
    </div>
  </div>
</div>

<div class="row g-3 mb-3">
  <?php foreach($senarai_parti as $parti): ?>
  <div class="col-12 col-lg-4 col-md-4 col-sm-12 d-flex align-items-stretch">
    <div class="p-3 border rounded d-flex flex-column w-100 text-center" style="<?php echo $parti->parti_warna; ?>">
        <img src="<?php echo base_url('assets/img/').$parti->foto_nama; ?>" class="img-fluid border p-1 bg-light rounded mb-3" style="object-fit: contain;width: 100%;max-height: 300px"/>
        <div class="mt-auto">
        <p><strong><?php echo $parti->parti_nama; ?></strong><br>
          <?php echo $parti->parti_singkatan; ?>
        </p>
        <div class="mt-auto">
          <?php echo anchor('parti/kemaskini/'.$parti->parti_bil, 'KEMASKINI', 'class="btn btn-warning w-100"'); ?>
        </div>
        </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>


