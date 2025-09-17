<?php 
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/sidebar');
$this->load->view('ppd_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">Pilihan Raya</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Senarai Pilihan Raya</h5>
                <div class="row g-3 mb-3">
                    <?php foreach($senarai_pilihanraya as $pilihanraya): ?>
                    <div class="col-12 col-lg-6 col-md-6 col-sm-12 d-flex align-items-stretch">
                        <div class="p-3 border rounded w-100 d-flex flex-column">
                        <h3><?php echo $pilihanraya->pilihanraya_nama; ?></h3>
                        <p><?php echo $pilihanraya->pilihanraya_singkatan; ?></p>
                        <p>Tahun <?php $t = date_format(date_create($pilihanraya->pilihanraya_tahun), "Y"); echo $t; ?></p>
                        <p>Status Pengemaskinian Maklumat : <?php echo $pilihanraya->pilihanraya_status; ?></p>
                        <div class="row g-3 mt-auto">
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                            <?php echo anchor('pilihanraya/info/'.$pilihanraya->pilihanraya_bil, 'KEMASKINI', array('class' => 'btn btn-outline-info w-100')); ?>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                            <?php echo anchor('pilihanraya/padam/'.$pilihanraya->pilihanraya_bil, 'PADAM', array('class' => 'btn btn-outline-danger w-100')); ?>
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


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>
