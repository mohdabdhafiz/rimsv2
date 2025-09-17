<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PERSONEL</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('pengguna') ?>">Laman</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('ppd') ?>">Laman PPN</a></li>
                <li class="breadcrumb-item active">Utama</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="row g-3 mb-3">
        <div class="col-12 col-lg-3 col-md-4 col-sm-6">
            <a href="<?= site_url('ppn/daftarPpn') ?>" class="btn btn-primary shadow-sm w-100">Daftar PPN</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">
                Maklumat Pengarah Negeri
            </h1>
            <div class="row g-3">
                <div class="col-12 col-lg-3 col-md-4 col-sm-6">
                    <p><strong>Nama Penuh</strong></p>
                    <h3><?= strtoupper($ppn->nama) ?></h3>
                </div>
            </div>

    </section>


</main>


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>