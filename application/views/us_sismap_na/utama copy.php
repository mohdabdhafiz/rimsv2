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
                <li class="breadcrumb-item active">LAMAN UTAMA</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Gerak Kerja</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                <thead>    
                <tr>
                        <th class="text-center">BIL</th>
                        <th>MODUL</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td><a href="<?= site_url('winnable_candidate') ?>">Modul Jangkaan Calon</a></td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td><a href="<?= site_url('pencalonan') ?>">Modul Hari Penamaan Calon</a></td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td><a href="<?= site_url('grading') ?>">Modul Grading</a></td>
                        </tr>
                        <tr>
                            <td class="text-center">4</td>
                            <td><a href="<?= site_url('undi') ?>">Modul Hari Pembuangan Undi</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Senarai Pilihan Raya</h1>
            <div class="row g-3">
                <?php foreach($senaraiPruAktif as $pru): ?>
                <div class="col-12 col-lg-3 col-md-6 col-sm-12 d-flex align-items-stretch">
                    <div class="p-3 border rounded text-center w-100 d-flex flex-column">
                        <h2 class="display-6"><?= $pru->pruSingkatan ?></h2>
                        <p><?= $pru->pruNama ?></p>
                        <div class="mt-auto">
                        <a href="<?= site_url('pilihanraya/bil/'.$pru->pruBil) ?>" class="btn btn-outline-primary shadow-sm w-100">Lihat</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Operasi</h5>
            <?php $this->load->view('us_sismap_na/us_sismap_nav'); ?>
        </div>
    </div>

    </section>

</main>


<?php $this->load->view('us_sismap_na/susunletak/bawah'); ?>