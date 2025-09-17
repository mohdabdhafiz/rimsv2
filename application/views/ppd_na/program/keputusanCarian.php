<?php 
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/sidebar');
$this->load->view('ppd_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@KOMUNITI</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('program/keputusanCarian') ?>">Hasil Carian</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">


    <?php $this->load->view('ppd_na/carian'); ?>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">
                <i class="bi bi-search"></i>
                Keputusan Carian
            </h1>
            <p>Terdapat <?= count($senaraiProgram) ?> program mengikut carian yang telah dibuat</p>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>NOMBOR SIRI</th>
                            <th>NAMA PROGRAM</th>
                            <th>NEGERI</th>
                            <th>DAERAH</th>
                            <th>PARLIMEN</th>
                            <th>DUN</th>
                            <th>STATUS LAPORAN</th>
                            <th>TARIKH PROGRAM</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($senaraiProgram as $program): ?>
                        <tr>
                            <td><?= $program->program_bil ?></td>
                            <td><a href="<?= site_url('program/bil/'.$program->program_bil) ?>"><?= strtoupper($program->jt_nama) ?></a></td>
                            <td><?= strtoupper($program->nt_nama) ?></td>
                            <td><?= strtoupper($program->nama) ?></td>
                            <td><?= strtoupper($program->pt_nama) ?></td>
                            <td><?= strtoupper($program->dun_nama) ?></td>
                            <td><?= strtoupper($program->program_status) ?></td>
                            <td><?= $program->program_tarikh_masa ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    </section>


</main>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>