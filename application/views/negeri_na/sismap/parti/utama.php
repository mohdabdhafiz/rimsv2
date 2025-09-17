<?php

$this->load->view('negeri_na/susunletak/atas');
$this->load->view('negeri_na/susunletak/navbar');
$this->load->view('negeri_na/susunletak/sidebar');
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('sismap') ?>">RIMS@SISMAP</a></li>
                <li class="breadcrumb-item active">Parti</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

        <section class="section">
            
            
    

<?php $this->load->view('negeri_na/sismap/parti/parti_nav'); ?>

<div class="card">
    <div class="card-body">
<div class="row g-3 my-1">
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
</div>
</div>




        </section>
</main>
</div>
</div>

<?php
$this->load->view('negeri_na/susunletak/bawah');
?>