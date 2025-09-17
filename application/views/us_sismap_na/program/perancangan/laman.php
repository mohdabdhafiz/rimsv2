<?php 
$this->load->view('us_sismap_na/susunletak/atas');
$this->load->view('us_sismap_na/susunletak/sidebar');
$this->load->view('us_sismap_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PROGRAM - PERANCANGAN</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('perancanganProgram') ?>">RIMS@PROGRAM</a></li>
                <li class="breadcrumb-item active">Perancangan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <?php $this->load->view('us_sismap_na/program/perancangan/nav'); ?>



    </section>

</main>


<?php $this->load->view('us_sismap_na/susunletak/bawah'); ?>