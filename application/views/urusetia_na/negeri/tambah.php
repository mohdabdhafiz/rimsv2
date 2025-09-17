<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS - KONFIGURASI</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('negeri') ?>">
                    <i class="bi bi-file-earmark-text"></i>
                    Negeri</a></li>
                <li class="breadcrumb-item active">
                    <i class="bi bi-plus"></i>
                    Tambah Negeri
                </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section bg-light">
        
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">
                <i class="bi bi-plus"></i>
                Tambah Negeri
            </h1>
        </div>
    </div>


    </section>

</main>


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>