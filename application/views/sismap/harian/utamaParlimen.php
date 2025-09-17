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
                <li class="breadcrumb-item"><a href="<?= site_url('harian') ?>">ETNOGRAFI HARIAN</a></li>
                <li class="breadcrumb-item active">ETNOGRAFI HARIAN MENGIKUT PARLIMEN</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Etnografi Harian Mengikut Parlimen</h1>
            <hr>
            <div class="row g-3">
                <div class="col-12 col-lg-4 col-md-4 col-sm-4">
                    <a href="<?= site_url('harian') ?>" class="btn btn-outline-primary shadow-sm w-100">Etnografi</a>
                </div>
                <div class="col-12 col-lg-4 col-md-4 col-sm-4">
                    <a href="<?= site_url('harian/utamaDmParlimen') ?>" class="btn btn-outline-primary shadow-sm w-100">Etnografi Mengikut Daerah Mengundi (DM) Parlimen</a>
                </div>
                <div class="col-12 col-lg-4 col-md-4 col-sm-4">
                    <a href="<?= site_url('harian/carianParlimen') ?>" class="btn btn-outline-primary shadow-sm w-100">Carian Terperinci Mengikut Parlimen</a>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped datatable">
                    <thead>
                        <tr>
                            <th>LAPORAN</th>
                            <th>TARIKH</th>
                            <th>NEGERI</th>
                            <th>PARLIMEN</th>
                            <th>PRU</th>
                            <th>KELUAR MENGUNDI</th>
                            <th>ATAS PAGAR</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($senaraiHarianParlimen as $hp): ?>
                        <tr>
                            <td><a href="<?= site_url('harian/laporanParlimen/'.$hp->hpBil) ?>">LAPORAN <?= $hp->hpBil ?></a></td>
                            <td><?= $hp->hpTarikh ?></td>
                            <td><?= $hp->negeriNama ?></td>
                            <td><?= $hp->parlimenNama ?></td>
                            <td><?= $hp->pruNama ?></td>
                            <td><?= $hp->hpAtasPagar ?></td>
                            <td><?= $hp->hpKeluarMengundi ?></td>
                            <td><?= $hp->hpStatus ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </section>

</main>


<?php $this->load->view($footer); ?>