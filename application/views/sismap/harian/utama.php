<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('sismap') ?>">RIMS@SISMAP</a></li>
                <li class="breadcrumb-item active">ETNOGRAFI HARIAN</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Etnografi Harian</h1>
            <div class="row g-3">
                <a href="<?= site_url('harian/utamaParlimen') ?>" class="col-12 col-lg-6 col-md-6 col-sm-12">
                    <div class="p-3 border rounded text-center m-0">
                        <h1 class="display-1">PARLIMEN</h1>
                    </div>
                </a>
                <a href="<?= site_url('harian/utamaDun') ?>" class="col-12 col-lg-6 col-md-6 col-sm-12">
                    <div class="p-3 border rounded text-center m-0">
                        <h1 class="display-1">DUN</h1>
                    </div>
                </a>
            </div>
        </div>
    </div>

    </section>

</main>


<?php $this->load->view($footer); ?>