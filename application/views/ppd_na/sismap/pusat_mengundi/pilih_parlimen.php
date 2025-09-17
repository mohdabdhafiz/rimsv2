<?php
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/navbar');
$this->load->view('ppd_na/susunletak/sidebar');
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">RIMS</a></li>
                <li class="breadcrumb-item active">RIMS@SISMAP</li>
                <li class="breadcrumb-item active">Pusat Mengundi</li>
                <li class="breadcrumb-item active">Senarai Parlimen</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <a class="btn btn-info rounded-pill" data-placement="top" href="<?php echo site_url('pusat_mengundi/index'); ?>"><i
            class="bi bi-arrow-90deg-left"></i></a>
        <section class="section">
            <div class="row g-3 mt-3">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Senarai Pusat Parlimen Mengundi</h5>
                            </div>

                            <!-- List group with Links and buttons -->
                            <div class="list-group">
                                <?php foreach($senaraiParlimen as $p): ?>
                                <a type="button" class="list-group-item list-group-item-action" aria-current="true" href="<?= site_url('pusat_mengundi/pilihDaerah/'.$p->pt_bil) ?>">
                                    <?= $p->pt_nama ?>
                                </a>
                                <?php endforeach; ?>
                            </div><!-- End List group with Links and buttons -->
                        </div>
                    </div>
                </div>
        </section>
</main>
</div>
</div>
<?php
$this->load->view('ppd_na/susunletak/bawah')
?>