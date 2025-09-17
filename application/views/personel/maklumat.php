<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PERSONEL</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url("personel") ?>">Personel</a></li>
                <li class="breadcrumb-item active"><?= $personel->nama_penuh ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">

    <a href="<?= site_url('personel/carian') ?>" class="btn btn-outline-info shadow-sm mb-3"><i class="bi bi-caret-left"></i> Kembali Carian</a>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Maklumat Personel</h1>
            <div class="row g-3">
                <div class="col-12 col-lg-3 col-md-6 col-sm-12">
                    <div class=""><strong>Nombor Siri</strong></div>
                    <div class="text-secondary"><?= $personel->bil ?></div>
                </div>
                <div class="col-12 col-lg-3 col-md-6 col-sm-12">
                    <div class=""><strong>Nama Penuh</strong></div>
                    <div class="text-secondary"><?= $personel->nama_penuh ?></div>
                </div>
                <div class="col-12 col-lg-3 col-md-6 col-sm-12">
                    <div class=""><strong>Nombor Kad Pengenalan</strong></div>
                    <div class="text-secondary"><?= $personel->pengguna_ic ?></div>
                </div>
                <div class="col-12 col-lg-3 col-md-6 col-sm-12">
                    <div class=""><strong>Jawatan</strong></div>
                    <div class="text-secondary"><?= $personel->pekerjaan ?></div>
                </div>
                <div class="col-12 col-lg-3 col-md-6 col-sm-12">
                    <div class=""><strong>Penempatan</strong></div>
                    <div class="text-secondary"><?= $personel->pengguna_tempat_tugas ?></div>
                </div>
                <div class="col-12 col-lg-3 col-md-6 col-sm-12">
                    <div class=""><strong>Nombor Telefon</strong></div>
                    <div class="text-secondary"><?= $personel->no_tel ?></div>
                </div>
                <div class="col-12 col-lg-3 col-md-6 col-sm-12">
                    <div class=""><strong>e-Mel</strong></div>
                    <div class="text-secondary"><?= $personel->emel ?></div>
                </div>
                <div class="col-12 col-lg-3 col-md-6 col-sm-12">
                    <div class=""><strong>Maklumat Didaftarkan Pada</strong></div>
                    <div class="text-secondary"><?= $personel->pengguna_waktu ?></div>
                </div>
            </div>
        </div>
    </div>

    

    <?php if(!empty($senaraiLaporanProgram)): ?>
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Senarai Laporan RIMS@PROGRAM</h1>
            <p>Bilangan Laporan : <?= count($senaraiLaporanProgram) ?></p>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombor Siri</th>
                            <th>Nama Program</th>
                            <th>Tarikh dan Masa Program</th>
                            <th>Negeri</th>
                            <th>Daerah</th>
                            <th>Parlimen</th>
                            <th>DUN</th>
                            <th>Status Laporan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($senaraiLaporanProgram as $program): ?>
                        <tr>
                            <td><?= $program->programBil ?></td>
                            <td><a href="<?= site_url("program/bil/".$program->programBil) ?>"><?= $program->programNama ?></a></td>
                            <td><?= $program->programTarikhMasa ?></td>
                            <td><?= $program->negeriNama ?></td>
                            <td><?= $program->daerahNama ?></td>
                            <td><?= $program->parlimenNama ?></td>
                            <td><?= $program->dunNama ?></td>
                            <td><?= $program->programStatus ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Senarai Akaun Yang Sama</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombor Siri Akaun</th>
                        <th>Nama Penuh Pengguna Akaun</th>
                        <th>Nombor Kad Pengenalan Pengguna Akaun</th>
                        <th>Nombor Telefon Pengguna Akaun</th>
                        <th>Operasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($senaraiAkaunDuplicate as $akaun): ?>
                    <tr>
                        <td><?= $akaun->bil ?></td>
                        <td><?= $akaun->nama_penuh ?></td>
                        <td><?= $akaun->pengguna_ic ?></td>
                        <td><?= $akaun->no_tel ?></td>
                        <td>
                            <a href="<?= site_url('personel/senaraiSync/'.$akaun->bil) ?>" class="btn btn-outline-primary shadow-sm"><i class="bi bi-arrow-repeat"></i> Sync Laporan</a>
                            <a href="<?= site_url('personel/padamAkaun/'.$akaun->bil) ?>" class="btn btn-outline-danger shadow-sm"><i class="bi bi-eraser"></i> Padam Akaun</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    </section>

</main>

<?php $this->load->view($footer); ?>