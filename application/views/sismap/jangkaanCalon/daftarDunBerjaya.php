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
                <li class="breadcrumb-item"><a href="<?= site_url('winnable_candidate') ?>">JANGKAAN CALON</a></li>
                <li class="breadcrumb-item active">STATUS TAMBAH JANGKAAN CALON DUN</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
    
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Status Tambah Jangkaan DUN</h1>

        </div>
    </div>





    </section>


</main>


<?php $this->load->view($footer); ?>