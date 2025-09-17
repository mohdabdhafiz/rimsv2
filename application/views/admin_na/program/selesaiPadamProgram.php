<?php 
$this->load->view('admin_na/susunletak/atas');
$this->load->view('admin_na/susunletak/sidebar');
$this->load->view('admin_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@ADMIN</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="<?= base_url() ?>">Utama</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Selesai Padam Semua Program</h1>
            <p>Semua Program telah dipadam.</p>
        </div>
    </div>

    </section>

</main>



<?php $this->load->view('admin_na/susunletak/bawah'); ?>