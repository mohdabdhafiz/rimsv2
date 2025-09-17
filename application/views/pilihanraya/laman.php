<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">UTAMA</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('parlimen') ?>">PILIHAN RAYA</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Modul Jangkaan Calon</h1>
            <hr>
            <div class="row g-3">
                <div class="col-12 col-lg-12 col-md-12 col-sm-12">
                    <a href="<?= site_url('winnable_candidate') ?>" class="btn btn-outline-primary shadow-sm w-100">Laman Utama</a>
                </div>
            </div>
            <hr>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Senarai Pilihan Raya Parlimen</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">NOMBOR SIRI</th>
                            <th class="text-start">PILIHAN RAYA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach($senaraiPruParlimen as $pp):
                        ?>
                        <tr>
                            <td class="text-center"><?= $pp->pruBil ?></td>
                            <td class="text-start"><?= $pp->pruNama ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Senarai Pilihan Raya DUN</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">NOMBOR SIRI</th>
                            <th class="text-start">PILIHAN RAYA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach($senaraiPruDun as $pd):
                        ?>
                        <tr>
                            <td class="text-center"><?= $pd->pruBil ?></td>
                            <td class="text-start"><?= $pd->pruNama ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </section>


</main>


<?php $this->load->view($footer); ?>