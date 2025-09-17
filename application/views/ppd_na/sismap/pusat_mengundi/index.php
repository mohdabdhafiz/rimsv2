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
                <li class="breadcrumb-item active">Senarai Negeri</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="mb-5 mt-5">
        <section class="section">
            <div class="row g-3 mt-3">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Senarai Negeri</h5>
                            </div>

                            <!-- List group with Links and buttons -->
                            <div class="list-group">
                                <?php foreach($senaraiNegeri as $n):?>
                                <a type="button" class="list-group-item list-group-item-action" aria-current="true"
                                    href="<?= site_url('pusat_mengundi/pilihParlimen/'.$n->nt_bil) ?>">
                                    <?= $n->nt_nama ?>
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