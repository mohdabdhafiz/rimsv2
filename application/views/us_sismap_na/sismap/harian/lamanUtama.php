<?php 
$this->load->view('us_sismap_na/susunletak/atas');
$this->load->view('us_sismap_na/susunletak/sidebar');
$this->load->view('us_sismap_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('harian') ?>">Harian</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="row g-3">
        <div class="col-12 col-lg-6 col-md-6 col-sm-6">
            <div class="text-center border rounded p-3 bg-white shadow-sm">
                <div class="text-secondary">
                    Parlimen
                </div>
                <div class="display-1">
                    <?= number_format($bilanganGradingParlimen, 0, '', ',') ?>
                </div>
                <div class="small text-secondary">
                    Bilangan Maklumat Grading Parlimen
                </div>
                <a href="<?= site_url("grading/parlimen") ?>" class="btn btn-outline-primary shadow-sm mt-3 w-100">
                    <div class="d-flex justify-content-between align-items-center">
                        Senarai Grading Parlimen
                        <i class="bi bi-arrow-right-circle"></i>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-md-6 col-sm-6">
            <div class="text-center border rounded p-3 bg-white shadow-sm">
                <div class="text-secondary">
                    DUN
                </div>
                <div class="display-1">
                    <?= number_format($bilanganGradingDun, 0, '', ',') ?>
                </div>
                <div class="small text-secondary">
                    Bilangan Maklumat Grading DUN
                </div>
                <a href="<?= site_url("grading/dun") ?>" class="btn btn-outline-primary shadow-sm mt-3 w-100">
                    <div class="d-flex justify-content-between align-items-center">
                        Senarai Grading DUN
                        <i class="bi bi-arrow-right-circle"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>


    </section>

</main>


<?php $this->load->view('us_sismap_na/susunletak/bawah'); ?>