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
                <li class="breadcrumb-item"><a href="<?= site_url('harian') ?>">Harian</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="row g-3 mb-3">
        <div class="col-12 col-lg-6 col-md-6 col-sm-6">
            <div class="text-center border rounded p-3 bg-white shadow-sm">
                <div class="text-secondary">
                    Parlimen
                </div>
                <div class="display-1">
                    <?= number_format($bilanganGradingParlimen, 0, '', ',') ?>
                </div>
                <div class="small text-secondary">
                    Bilangan Maklumat Grading Parlimen
                </div>
                <a href="<?= site_url("grading/parlimen") ?>" class="btn btn-outline-primary shadow-sm mt-3 w-100">
                    <div class="d-flex justify-content-between align-items-center">
                        Senarai Grading Parlimen
                        <i class="bi bi-arrow-right-circle"></i>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-md-6 col-sm-6">
            <div class="text-center border rounded p-3 bg-white shadow-sm">
                <div class="text-secondary">
                    DUN
                </div>
                <div class="display-1">
                    <?= number_format($bilanganGradingDun, 0, '', ',') ?>
                </div>
                <div class="small text-secondary">
                    Bilangan Maklumat Grading DUN
                </div>
                <a href="<?= site_url("grading/dun") ?>" class="btn btn-outline-primary shadow-sm mt-3 w-100">
                    <div class="d-flex justify-content-between align-items-center">
                        Senarai Grading DUN
                        <i class="bi bi-arrow-right-circle"></i>
                    </div>
                </a>
            </div>
        </div>


        <?php foreach($senaraiPilihanraya as $pilihanraya): ?>      
        <div class="col-12 col-lg-4 col-md-6 col-sm-12">
            <div class="border rounded p-3 bg-white shadow-sm h-100 d-flex flex-column">
            <h1 class="display-4 text-truncate"><?= $pilihanraya->pilihanraya_singkatan ?></h1>
            <table class="table table-hover flex-grow-1">
                <tr>
                <th>Nombor Siri</th>
                <td>:</td>
                <td><?= $pilihanraya->pilihanraya_bil ?></td>
                </tr>
                <tr>
                <th>Nama Pilihan Raya</th>
                <td>:</td>
                <td><?= $pilihanraya->pilihanraya_nama ?></td>
                </tr>
                <tr>
                <th>Tarikh Penamaan Calon</th>
                <td>:</td>
                <td><?= $pilihanraya->pilihanraya_penamaan_calon ?></td>
                </tr>
                <tr>
                <th>Tarikh Lock Status</th>
                <td>:</td>
                <td><?= $pilihanraya->pilihanraya_lock_status ?></td>
                </tr>
                <tr>
                <th>Jumlah Parlimen</th>
                <td>:</td>
                <td><?= $pilihanraya->kerusiParlimenBilangan ?></td>
                </tr>
                <tr>
                <th>Jumlah DUN</th>
                <td>:</td>
                <td><?= $pilihanraya->kerusiDunBilangan ?></td>
                </tr>
                <tr>
                <th>Jenis Pilihan Raya</th>
                <td>:</td>
                <td><?= $pilihanraya->pilihanraya_jenis ?></td>
                </tr>
                <tr>
                <th>Status Gerak Kerja</th>
                <td>:</td>
                <td><?= $pilihanraya->pilihanraya_status ?></td>
                </tr>
            </table>
            <?php if ($pilihanraya->pilihanraya_penamaan_calon < date("Y", 2000)): ?>
                <div class="alert alert-danger" role="alert">
                    Sila kemaskini maklumat pilihanraya. Terutamanya tarikh penamaan calon dan tarikh lock status.
                </div>
                <a href="#" class="btn btn-secondary w-100 mt-auto disabled">Lihat Grading</a>
            <?php else: ?>
                <a href="<?= site_url("grading/pru/{$pilihanraya->pilihanraya_bil}") ?>" class="btn btn-primary w-100 mt-auto">Lihat Grading</a>
            <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>



    </div>

    </section>

</main>


<?php $this->load->view('us_sismap_na/susunletak/bawah'); ?>