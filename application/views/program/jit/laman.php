<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PROGRAM</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('program') ?>">RIMS@PROGRAM</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('jit') ?>">INTEGRASI JOM MOBILE</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">JAPEN ON MOBILE INTERGRATION</h1>
            <hr>
            <div class="row g-3">
                <div class="col-12">
                    <a href="<?= site_url('jit/carian') ?>" class="btn btn-primary shadow-sm w-100">Carian Terperinci</a>
                </div>
            </div>
            <hr>
        </div>
    </div>



    </section>


</main>


<?php $this->load->view($footer); ?>