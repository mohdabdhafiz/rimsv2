<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PROGRAM</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">Urus Setia</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <?php $this->load->view('urusetia_na/program/nav'); ?>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Senarai Laporan Program Yang Difailkan <?= count($senaraiProgramSah) ?></h1>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Program</th>
                            <th>Tarikh Program</th>
                            <th>Tempat Program</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($senaraiProgramSah as $programSah): ?>
                        <tr>
                            <td><?= $programSah->jenis_program ?></td>
                            <td><?= $programSah->tarikh_masa_program ?></td>
                            <td>
                                <?php
                                $tahun = date_format(date_create($programSah->tarikh_masa_program), 'Y');
                                $senaraiLokasi = $dataProgram->senaraiLokasiProgram($programSah->programBil, $peranan, $tahun);
                                ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= site_url('program/'.$programSah->programBil) ?>" class="btn btn-outline-primary shadow-sm">Lihat</a>
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


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>