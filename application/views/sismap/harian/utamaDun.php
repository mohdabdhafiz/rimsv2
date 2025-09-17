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
                <li class="breadcrumb-item active">ETNOGRAFI HARIAN MENGIKUT DUN</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Etnografi Harian Mengikut DUN</h1>
            <hr>
            <div class="row g-3">
                <div class="col-12 col-lg-4 col-md-4 col-sm-4">
                    <a href="<?= site_url('harian') ?>" class="btn btn-outline-secondary shadow-sm w-100">Etnografi</a>
                </div>
                <div class="col-12 col-lg-4 col-md-4 col-sm-4">
                    <a href="<?= site_url('harian/utamaDmDun') ?>" class="btn btn-outline-secondary shadow-sm w-100">Etnografi Mengikut Daerah Mengundi (DM) DUN</a>
                </div>
                <div class="col-12 col-lg-4 col-md-4 col-sm-4">
                    <a href="<?= site_url('harian/carianDun') ?>" class="btn btn-outline-secondary shadow-sm w-100">Carian Terperinci Mengikut DUN</a>
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
                            <th>DUN</th>
                            <th>PRU</th>
                            <th>KELUAR MENGUNDI</th>
                            <th>ATAS PAGAR</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($senaraiHarianDun as $hd): ?>
                        <tr>
                            <td><a href="<?= site_url('harian/laporanDun/'.$hd->hdBil) ?>">LAPORAN <?= $hd->hdBil ?></a></td>
                            <td><?= $hd->hdTarikh ?></td>
                            <td><?= $hd->negeriNama ?></td>
                            <td><?= $hd->dunNama ?></td>
                            <td><?= $hd->pruNama ?></td>
                            <td><?= $hd->hdAtasPagar ?></td>
                            <td><?= $hd->hdKeluarMengundi ?></td>
                            <td><?= $hd->hdStatus ?></td>
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