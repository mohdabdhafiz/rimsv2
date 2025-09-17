<?php 
$this->load->view('kp_na/susunletak/atas');
$this->load->view('kp_na/susunletak/sidebar');
$this->load->view('kp_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="<?= base_url() ?>">Utama</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Senarai Pilihan Raya</h1>
            <div class="row g-3">
                <?php foreach($senaraiPru as $pru): ?>
                    <div class="col-12 col-lg-3 col-md-4 col-sm-12">
                        <div class="p-3 border rounded">
                            <strong><?= strtoupper($pru->pilihanraya_singkatan) ?> [<?= $pru->pilihanraya_tahun ?>]</strong>
                            <br><?= strtoupper($pru->pilihanraya_nama) ?>
                            <br><em><?= strtoupper($pru->pilihanraya_status) ?></em>
                            <br><a href="<?= site_url('pilihanraya/bil/'.$pru->pilihanraya_bil) ?>" class="btn btn-outline-primary shadow-sm mt-3">Maklumat Penuh</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Senarai Jangkaan Calon</h1>
            <div class="row g-3">
                <div class="col-12 col-lg-6 col-md-12 col-sm-12">
                    <div class="p-3 border rounded">
                        <strong>PARLIMEN</strong>
                        <br><?= $bilanganKerusiParlimen ?> KERUSI PARLIMEN
                        <br><a href="<?= site_url('winnable_candidate/calonParlimen') ?>" class="btn btn-outline-primary shadow-sm mt-3">Senarai Calon</a>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-12 col-sm-12">
                    <div class="p-3 border rounded">
                        <strong>DUN</strong>
                        <br><?= $bilanganKerusiDun ?> KERUSI DUN
                        <br><a href="<?= site_url('winnable_candidate/calonDun') ?>" class="btn btn-outline-primary shadow-sm mt-3">Senarai Calon</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </section>

</main>




<?php $this->load->view('kp_na/susunletak/bawah'); ?>