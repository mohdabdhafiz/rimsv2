<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS - Senarai Peranan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">Senarai Peranan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section bg-light">
        
    <h1 class="display-1">Senarai Peranan</h1>

    <ol>
        <li>
            <a href="<?= site_url('ppd/senarai') ?>">Senarai Pegawai Penerangan Daerah</a>
        </li>
    </ol>

    </section>

</main>


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>