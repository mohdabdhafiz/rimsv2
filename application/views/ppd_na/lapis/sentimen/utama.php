<?php 
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/sidebar');
$this->load->view('ppd_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@LAPIS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">RIMS@LAPIS</a></li>
                <li class="breadcrumb-item active">Sentimen</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">

        <?php $this->load->view('ppd_na/lapis/sentimen/nav'); ?>

        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Sentimen</h1>
                <p>Sentimen</p>
            </div>
        </div>

    </section>

</main>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>