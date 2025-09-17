<?php 
$this->load->view('us_obp_na/susunletak/atas');
$this->load->view('us_obp_na/susunletak/sidebar');
$this->load->view('us_obp_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@OBP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">Urus Setia</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Operasi</h5>
            <?php $this->load->view('us_obp_na/us_obp_nav'); ?>
        </div>
    </div>

    </section>

</main>


<?php $this->load->view('us_obp_na/susunletak/bawah'); ?>