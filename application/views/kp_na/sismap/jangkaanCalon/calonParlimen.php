<?php 
$this->load->view('kp_na/susunletak/atas');
$this->load->view('kp_na/susunletak/sidebar');
$this->load->view('kp_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('winnable_candidate/calonParlimen') ?>">Senarai Jangkaan Calon Parlimen</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">

        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Senarai Jangkaan Calon Parlimen</h1>
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>BIL</th>
                                <th>NAMA</th>
                                <th>PARTI</th>
                                <th>PARLIMEN</th>
                                <th>OPERASI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($senaraiCalon as $calon): ?>
                            <tr>
                                <td><?= $calon->calonBil ?></td>
                                <td><?= strtoupper($calon->calonNama) ?></td>
                                <td><?= strtoupper($calon->calonParti) ?></td>
                                <td><?= strtoupper($calon->calonParlimen) ?></td>
                                <td>
                                    <a href="<?= site_url('winnable_candidate/calon/'.$calon->calonBil) ?>" class="btn btn-outline-primary shadow-sm">Lihat</a>
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




<?php $this->load->view('kp_na/susunletak/bawah'); ?>