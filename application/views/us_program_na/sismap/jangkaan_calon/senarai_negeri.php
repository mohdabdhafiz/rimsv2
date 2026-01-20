<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
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
        
        <?php $this->load->view('urusetia_na/sismap/jangkaan_calon/nav'); ?>

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
                                    <a href="<?= site_url('winnable_candidate/negeri/'.$negeri->nt_bil) ?>" class="btn btn-outline-primary">Lihat</a>
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
