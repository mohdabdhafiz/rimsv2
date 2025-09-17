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
                <li class="breadcrumb-item"><a href="<?= site_url('jit') ?>">JIT</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('jit/carian') ?>">CARIAN TERPERINCI</a></li>
                <li class="breadcrumb-item active">KEPUTUSAN CARIAN</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">JAPEN ON MOBILE INTERGRATION</h1>
            <hr>
            <div class="row g-3">
                <div class="col-12 col-lg-6 col-md-6 col-sm-6">
                    <a href="<?= site_url('jit') ?>" class="btn btn-primary shadow-sm w-100">Laman Utama</a>
                </div>
                <div class="col-12 col-lg-6 col-md-6 col-sm-6">
                    <a href="<?= site_url('jit/carian') ?>" class="btn btn-primary shadow-sm w-100">Carian Terperinci</a>
                </div>
            </div>
            <hr>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Keputusan Carian</h1>
            <div class="mb-3">
                <span class="badge rounded-pill bg-success"><?= $programNama ?></span>
                <span class="badge rounded-pill bg-success"><?= $hebahanNama ?></span>
                <span class="badge rounded-pill bg-success"><?= $tarikhMula ?></span>
                <span class="badge rounded-pill bg-success"><?= $tarikhTamat ?></span> 
                <span class="badge rounded-pill bg-success"><?= $negeriNama ?></span> 
            </div>
        </div>
    </div>


    </section>


</main>


<?php $this->load->view($footer); ?>