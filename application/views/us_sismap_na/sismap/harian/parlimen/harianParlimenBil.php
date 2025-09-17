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
                <li class="breadcrumb-item"><a href="<?= site_url('grading/parlimen') ?>">Senarai Harian Parlimen</a></li>
                <li class="breadcrumb-item active">Maklumat Harian (Nombor Siri: <?= $maklumatHarian->nomborSiri ?>)</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Maklumat Harian</h1>
            <div class="row g-3">
                <div class="col-12 col-lg-6 col-md-6 col-sm-6">
                    <div class="p-3 border rounded shadow-sm">
                        <div><strong>Tarikh</strong></div>
                        <div class="text-secondary"><?= $maklumatHarian->tarikh ?></div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-6 col-sm-6">
                    <div class="p-3 border rounded shadow-sm">
                        <div><strong>Nama Parlimen</strong></div>
                        <div class="text-secondary"><?= strtoupper($maklumatHarian->namaParlimen) ?></div>
                    </div>
                </div>
                <div class="col-12 col-lg-12 col-md-6 col-sm-6">
                    <div class="p-3 border rounded shadow-sm">
                        <div><strong>Nama Pilihan Raya</strong></div>
                        <div class="text-secondary"><?= strtoupper($maklumatHarian->namaPru) ?></div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-6 col-sm-6">
                    <div class="p-3 border rounded shadow-sm" style="<?= $maklumatHarian->color ?>">
                        <div><strong>Grading Parlimen</strong></div>
                        <div><?= strtoupper($maklumatHarian->grading) ?></div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-6 col-sm-6">
                    <div class="p-3 border rounded shadow-sm">
                        <div><strong>Jangkaan Peratusan Keluar Mengundi</strong></div>
                        <div class="text-secondary"><?= number_format($maklumatHarian->keluarMengundi, 2, '.', '') ?></div>
                    </div>
                </div>
                <div class="col-12 col-lg-12 col-md-12 col-sm-6">
                    <div class="p-3 border rounded shadow-sm">
                        <div><strong>Ulasan</strong></div>
                        <div class="text-secondary"><?= strtoupper($maklumatHarian->ulasan) ?></div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-6 col-sm-6">
                    <div class="p-3 border rounded shadow-sm">
                        <div><strong>Tarikh Kemaskini</strong></div>
                        <div class="text-secondary"><?= $maklumatHarian->tarikhKemaskini ?></div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-6 col-sm-6">
                    <div class="p-3 border rounded shadow-sm">
                        <div><strong>Dikemaskini Oleh</strong></div>
                        <div class="text-secondary"><?= $maklumatHarian->namaPelapor ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Maklumat Grading Parlimen <?= ($maklumatHarian->namaParlimen) ?></h1>
            <div class="row g-3">
                <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                    <div class="p-3 border rounded shadow-sm">
                        <div><strong>Tarikh</strong></div>
                        <div><?= $maklumatHarian->tarikh ?></div>
                    </div>
                </div>
                <div class="col-12 col-lg-9 col-md-9 col-sm-12">
                    <div class="p-3 border rounded shadow-sm">
                        <div><strong>Nama Pilihan Raya</strong></div>
                        <div><?= strtoupper($maklumatHarian->namaPru) ?></div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-3 border rounded shadow-sm">
                        <p><strong>Senarai Calon</strong></p>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nombor Siri</th>
                                        <th>Nama Penuh</th>
                                        <th>Umur</th>
                                        <th>Jantina</th>
                                        <th>Parti</th>
                                        <th>Peratusan Sokongan (%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($senaraiCalon as $calon): ?>
                                    <tr>
                                        <td><?= $calon->nomborSiriCalon ?></td>
                                        <td><?= $calon->namaCalon ?></td>
                                        <td><?= $calon->calonUmur ?></td>
                                        <td><?= $calon->calonJantina ?></td>
                                        <td><?= $calon->partiNama ?> (<?= $calon->partiSingkatan ?>)</td>
                                        <td><?= number_format($calon->gradingSokongan, 2, ".", "") ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </section>

</main>


<?php $this->load->view('us_sismap_na/susunletak/bawah'); ?>