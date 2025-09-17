<?php 
$this->load->view('us_sismap_na/susunletak/atas');
$this->load->view('us_sismap_na/susunletak/sidebar');
$this->load->view('us_sismap_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PROGRAM - PERANCANGAN</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('perancanganProgram') ?>">RIMS@PROGRAM</a></li>
                <li class="breadcrumb-item active">Perancangan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Operasi</h1>
    <?php $this->load->view('us_sismap_na/program/perancangan/nav'); ?>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

    <h1 class="card-title">Senarai Program</h1>

    <div class="table-responsive">
        <table class="table datatable">
            <thead>
                <tr>
                    <th>Bil</th>
                    <th>Nombor Siri</th>
                    <th>Negeri</th>
                    <th>Daerah</th>
                    <th>Parlimen</th>
                    <th>DUN</th>
                    <th>Nama Program</th>
                    <th>Tarikh</th>
                    <th>Lokasi</th>
                    <th>Perasmi</th>
                    <th>Kaedah Pelaksanaan</th>
                    <th>Bilangan Peserta</th>
                    <th>Urus Setia</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $bil = 1;
                foreach($senaraiProgram as $program): ?>
                    <tr>
                        <td><?= $bil++ ?></td>
                        <td><?= $program->bil ?></td>
                        <td><?= $program->negeri ?></td>
                        <td><?= $program->daerah ?></td>
                        <td><?= $program->parlimen ?></td>
                        <td><?= $program->dun ?></td>
                        <td><?= $program->nama ?></td>
                        <td><?= $program->tarikh ?></td>
                        <td><?= $program->lokasi ?></td>
                        <td><?= $program->perasmi ?></td>
                        <td><?= $program->kaedah ?></td>
                        <td><?= $program->peserta ?></td>
                        <td><?= $program->urusetia ?></td>
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