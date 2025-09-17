<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PROGRAM</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('program') ?>">Laman</a></li>
                <li class="breadcrumb-item active">Tambah Laporan Program</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<section class="section">
  <div class="card">
    <div class="card-body">
      <h1 class="card-title">Status Padam Maklumat Program</h1>
      <div class="alert alert-success">
        MAKLUMAT PROGRAM BERJAYA DIPADAM.
      </div>
      <div class="text-center">
        <a href="<?= site_url('program/tambah') ?>" class="btn btn-outline-primary shadow-sm">Tambah Program Baharu</a>
      </div>
    </div>
  </div>

</section>


</main>


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>