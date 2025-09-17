<?php 
$this->load->view('negeri_na/susunletak/atas');
$this->load->view('negeri_na/susunletak/sidebar');
$this->load->view('negeri_na/susunletak/navbar');
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
        
        <?php $this->load->view('negeri_na/sismap/jangkaan_calon/nav'); ?>

    </section>


    </main>


<?php $this->load->view('negeri_na/susunletak/bawah'); ?>
