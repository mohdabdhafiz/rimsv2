<?php 
$this->load->view('kp_na/susunletak/atas');
$this->load->view('kp_na/susunletak/sidebar');
$this->load->view('kp_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="<?= base_url() ?>">Utama</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">

    <div class="mb-3">
        <h1 class="mb-0">LAPORAN HARIAN</h1>
        <p class="small text-muted">Setakat: <?= date('Y-m-d H:i:s') ?></p>
    </div>

    <?php 

    ?>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">RIMS@LAPIS - Laporan Isu Semasa</h1>
            <div class="row g-3">
                <div class="col-12 col-lg-6 col-md-12 col-sm-12">
                    <div class="">
                        <h3>Bilangan LAPIS Mengikut Negeri</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2">Negeri</th>
                                    <th class="text-end">Bilangan Laporan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($senaraiNegeri as $n): ?>
                                <tr>
                                    <td><img src="assets/bendera/<?= $n->negeriFail ?>" alt="<?= strtoupper($n->negeriNama) ?>" class="img-fluid" style="width:60px; height:auto; object-fit:contain;"></td>
                                    <td><?= strtoupper($n->negeriNama) ?></td>
                                    <td class="text-end">120</td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan=2>JUMLAH</th>
                                    <th class="text-end">120</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-12 col-sm-12">
                    <div class="">
                        <h2>Bilangan LAPIS Mengikut Kluster</h2>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>KLUSTER</th>
                                    <th>BILANGAN LAPORAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>POLITIK</td>
                                    <td>120</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>JUMLAH</th>
                                    <th>120</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="text-end">
                <a href="<?= site_url('lapis/carianPerinci') ?>" class="btn btn-outline-success shadow-sm">
                    <i class="bi bi-search"></i>
                    Carian Terperinci
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">RIMS@LKS - Laporan Khas Sentimen</h1>
            <div class="row g-3">
                <div class="col-12 col-lg-4 col-md-4 col-sm-12 text-center">
                    <h3 class="text-success">Positif</h3>
                    <h1 class="display-1">100</h1>
                    <p class="small text-muted">Bilangan Laporan</p>
                </div>
                <div class="col-12 col-lg-4 col-md-4 col-sm-12 text-center">
                    <h3 class="text-primary">Neutral</h3>
                    <h1 class="display-1">100</h1>
                    <p class="small text-muted">Bilangan Laporan</p>
                </div>
                <div class="col-12 col-lg-4 col-md-4 col-sm-12 text-center">
                    <h3 class="text-danger">Negatif</h3>
                    <h1 class="display-1">100</h1>
                    <p class="small text-muted">Bilangan Laporan</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="text-end">
                <a href="<?= site_url('sentimen/carianPerinci') ?>" class="btn btn-outline-success shadow-sm">
                    <i class="bi bi-search"></i>
                    Carian Terperinci
                </a>
            </div>
        </div>
    </div>

    </section>

</main>




<?php $this->load->view('kp_na/susunletak/bawah'); ?>