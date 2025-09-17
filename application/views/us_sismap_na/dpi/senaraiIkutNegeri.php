<?php

$this->load->view('us_sismap_na/susunletak/atas');
$this->load->view('us_sismap_na/susunletak/navbar');
$this->load->view('us_sismap_na/susunletak/sidebar');
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">RIMS</a></li>
                <li class="breadcrumb-item active">RIMS@SISMAP</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

        <section class="section">

            <?php $this->load->view('us_sismap_na/dpi/nav'); ?>
            
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h1 class="card-title">Negeri</h1>
                                <img src="<?= base_url('assets/bendera/').$negeri->nt_nama_fail ?>" alt="Gambar Bendera <?= $negeri->nt_nama ?>" style="width: 50px; height:50px; object-fit:contain;">
                            </div>
                            <h2 class="display-6 text-center"><?= $negeri->nt_nama ?></h2>
                        </div>
                    </div>
                </div>

                <?php if($bilanganParlimen != 0): ?>

                    <?php if($bilanganDun == 0): ?>
                <div class="col-12 col-lg-12">
                    <?php endif; ?>

                    <?php if($bilanganDun != 0): ?>
                <div class="col-12 col-lg-6">
                    <?php endif; ?>


                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h1 class="card-title">Bilangan Parlimen</h1>
                                <button type="button" class="btn btn-outline-success shadow-sm" data-bs-toggle="modal" data-bs-target="#senaraiParlimen">
                                    Senarai
                                </button>
                            </div>
                            <h2 class="display-6 text-center">
                                <?= $bilanganParlimen ?>
                            </h2>
                        </div>

                        <!-- Large Modal -->
                        

                        <div class="modal fade" id="senaraiParlimen" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="d-flex justify-content-start align-items-center">
                                        <img src="<?= base_url('assets/bendera/').$negeri->nt_nama_fail ?>" alt="Gambar Bendera <?= $negeri->nt_nama ?>" style="width: 50px; height:50px; object-fit:contain;" class='pe-3'>
                                        <h5 class="modal-title">Senarai Parlimen <?= $negeri->nt_nama ?></h5>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="table-responsive">
                                        <table class="table table-sm table-borderless table-hover">
                                            <tbody>
                                                <?php foreach($senaraiParlimen as $parlimen): ?>
                                                <tr>
                                                    <td><?= $parlimen->pt_nama ?></td>
                                                    <td class="text-end"><a href="<?= site_url('dpi/kemaskiniKaumParlimen/'.$parlimen->pt_bil) ?>" class="btn btn-outline-success shadow-sm">Kemaskini</a></td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-outline-success shadow-sm" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                            </div>
                        </div><!-- End Large Modal-->


                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title">Bilangan Pengundi Mengikut Data Parlimen</h1>
                            <h2 class="display-6 text-center" id="bilanganPengundiParlimen">
                                X
                            </h2>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title">Bilangan Pengundi Mengikut Parlimen</h1>
                        </div>
                    </div>

                </div>


                <?php endif; ?>

                <?php if($bilanganDun != 0): ?>
                    
                    <?php if($bilanganParlimen == 0): ?>
                <div class="col-12 col-lg-12">
                    <?php endif; ?>

                    <?php if($bilanganParlimen != 0): ?>
                <div class="col-12 col-lg-6">
                    <?php endif; ?>

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h1 class="card-title">Bilangan DUN</h1>
                                <button type="button" class="btn btn-outline-success shadow-sm" data-bs-toggle="modal" data-bs-target="#senaraiDun">
                                    Senarai
                                </button>
                            </div>
                            <h2 class="display-6 text-center">
                                <?= $bilanganDun ?>
                            </h2>
                        </div>

                        

                        <div class="modal fade" id="senaraiDun" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                <div class="d-flex justify-content-start align-items-center">
                                        <img src="<?= base_url('assets/bendera/').$negeri->nt_nama_fail ?>" alt="Gambar Bendera <?= $negeri->nt_nama ?>" style="width: 50px; height:50px; object-fit:contain;" class='pe-3'>
                                        <h5 class="modal-title">Senarai DUN <?= $negeri->nt_nama ?></h5>
                                    </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-borderless table-hover">
                                            <tbody>
                                                <?php foreach($senaraiDun as $dun): ?>
                                                <tr>
                                                    <td><?= $dun->dun_nama ?></td>
                                                    <td class="text-end"><a href="<?= site_url('dpi/kemaskiniKaumDun/'.$dun->dun_bil) ?>" class="btn btn-outline-success shadow-sm">Kemaskini</a></td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-outline-success shadow-sm" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                            </div>
                        </div><!-- End Large Modal-->


                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title">Bilangan Pengundi Mengikut Data DUN</h1>
                            <h2 class="display-6 text-center" id="bilanganPengundiDun">
                                X
                            </h2>
                        </div>
                    </div>

                    

                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title">Bilangan Pengundi Mengikut DUN</h1>
                        </div>
                    </div>


                </div>

                <?php endif; ?>



            </div>

        </section>
</main>
</div>
</div>

<?php
$this->load->view('us_sismap_na/susunletak/bawah');
?>