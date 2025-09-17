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
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Jangkaan Calon</a></li>
                <li class="breadcrumb-item active">Senarai Negeri</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        
        <?php $this->load->view('us_sismap_na/sismap/jangkaan_calon/nav'); ?>

        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Senarai Negeri</h1>
                <div class="table-responsive">
                    <table class="table table-borderless table-hover">
                        <tbody>
                            <?php foreach($senaraiNegeri as $negeri): ?>
                            <tr>
                                <td><?= $negeri->nt_nama ?></td>
                                <td class="text-end">
                                    <div class="row g-1">
                                        <div class="col-auto">
                                            <a href="<?= site_url('winnable_candidate/senaraiParlimen/'.$negeri->nt_bil) ?>" class="btn btn-outline-primary shadow-sm">Parlimen</a>
                                        </div>
                                        <div class="col-auto">
                                            <a href="<?= site_url('winnable_candidate/senaraiDun/'.$negeri->nt_bil) ?>" class="btn btn-outline-primary shadow-sm">DUN</a>
                                        </div>
                                        <div class="col-auto">
                                            <a href="<?= site_url('winnable_candidate/negeri/'.$negeri->nt_bil) ?>" class="btn btn-outline-primary shadow-sm">Semua</a>
                                        </div>
                                    </div>
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


<?php $this->load->view('us_sismap_na/susunletak/bawah'); ?>
