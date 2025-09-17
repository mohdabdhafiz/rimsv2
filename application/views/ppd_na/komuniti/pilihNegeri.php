<?php 
$this->load->view('us_program_na/susunletak/atas');
$this->load->view('us_program_na/susunletak/sidebar');
$this->load->view('us_program_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@KOMUNITI</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('komuniti/tambah') ?>">Negeri</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Pilih Negeri</h1>
            <div class="row g-3">
                <?php foreach($senaraiNegeri as $negeri): ?>
                <div class="col-12 col-lg-3 col-md-4 text-center">
                    <a href="<?= site_url('komuniti/pilihDaerah/'.$negeri->nt_bil) ?>" class="btn btn-outline-primary shadow-sm w-100"><?= $negeri->nt_nama ?></a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    </section>


</main>


<?php $this->load->view('us_program_na/susunletak/bawah'); ?>