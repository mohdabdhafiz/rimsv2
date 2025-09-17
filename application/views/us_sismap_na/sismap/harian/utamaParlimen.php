<?php 
$this->load->view('us_sismap_na/susunletak/atas');
$this->load->view('us_sismap_na/susunletak/sidebar');
$this->load->view('us_sismap_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('harian') ?>">Dashboard Harian</a></li>
                <li class="breadcrumb-item active">Senarai Harian Parlimen</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Senarai Grading Parlimen</h1>
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>Nombor Siri</th>
                            <th>Tarikh</th>
                            <th>Parlimen</th>
                            <th>Pilihan Raya</th>
                            <th>Bilangan Calon</th>
                            <th>Kemaskini Grading</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($senaraiGrading as $g): ?>
                        <tr>
                            <td><?= $g->nomborSiri ?></td>
                            <td><?= $g->tarikhGrading ?></td>
                            <td><?= strtoupper($g->namaParlimen) ?></td>
                            <td><?= strtoupper($g->namaPru) ?></td>
                            <td><?= $g->bilanganCalon ?></td>
                            <td>
                                <?php if($g->bilanganGrading == $g->bilanganCalon): ?>
                                    Selesai
                                <?php else: ?>
                                    Belum
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= site_url('harian/harianParlimenBil/'.$g->nomborSiri) ?>" class="btn btn-outline-primary w-100 shadow-sm">
                                    <div class="d-flex justify-content-between align-items-center">
                                        Lihat
                                        <i class="bi bi-arrow-right-circle"></i>
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    </section>

</main>


<?php $this->load->view('us_sismap_na/susunletak/bawah'); ?>