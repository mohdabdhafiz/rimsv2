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
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('pilihanraya') ?>">Pilihan Raya</a></li>
                <li class="breadcrumb-item active"><?= $pilihanraya->pilihanraya_singkatan ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <?php if($pilihanraya->pilihanraya_jenis == 'PARLIMEN'): ?>

    <section class="section">

        <div class="row">

            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Penjuru</h5>
                        <div class="table-responsive">
                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th>Penjuru</th>
                                        <th>Bilangan Parlimen / DUN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $bilanganPenjuru = $dataCalonParlimen->kiraanPenjuru($pilihanraya->pilihanraya_bil);
                                    foreach($bilanganPenjuru as $penjuru): ?>
                                    <tr>
                                        <td><?= $penjuru->bilanganPenjuru ?></td>
                                        <td><?= $penjuru->kiraPenjuru ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

    <?php endif; ?>


    </main>


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>