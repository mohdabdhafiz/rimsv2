<?php 
$this->load->view('us_program_na/susunletak/atas');
$this->load->view('us_program_na/susunletak/sidebar');
$this->load->view('us_program_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PROGRAM</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">Rumusan Program</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">


    <?php if(!empty($senaraiRumusanProgram)): ?>
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Rumusan Laporan Program</h1>
            <div class="row g-3">
                <?php foreach($senaraiRumusanProgram as $program): 
                    $sendStatus = bin2hex($program->program_status); ?>
                <div class="col-12 col-lg-4 col-md-4 col-sm-6 d-flex align-items-strech">
                    <div class="p-3 border rounded d-flex justify-content-center align-items-center w-100">
                        <div class="d-flex flex-column text-center w-100">
                            <span><?= $program->program_status ?></span>
                            <span class="display-1">
                                <?= $program->bilanganLaporan ?>
                            </span>
                            <span><em>Bilangan Laporan</em></span>
                            <a href="<?= site_url('program/mengikutNegeri/'.$sendStatus) ?>" class="mt-3 btn btn-sm btn-outline-primary w-100 shadow-sm">
                                Lihat
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>


    </section>


</main>


<?php $this->load->view('us_program_na/susunletak/bawah'); ?>