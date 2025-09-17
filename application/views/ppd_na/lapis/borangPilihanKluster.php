<?php 
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/sidebar');
$this->load->view('ppd_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@LAPIS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">RIMS@LAPIS</a></li>
                <li class="breadcrumb-item active">Tambah Laporan Baharu Mengikut Kluster</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <a href="<?= site_url('utama') ?>" class="btn btn-outline-info mb-3">Kembali</a>

    <section class="section">

        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Tambah Laporan Baharu Mengikut Kluster</h1>
                <div class="row g-3 mb-3">
                    <?php foreach($senarai_kluster as $kluster): ?>
                        <div class="col-12 col-lg-4 d-flex align-item-stretch">
                            <div class="p-3 border rounded w-100 d-flex flex-column">
                                <div>
                                    <p><strong><?= $kluster->kit_nama ?></strong></p>
                            <p><?= $kluster->kit_deskripsi ?></p>
                            </div>
                            <div class="mt-auto">
                                <div class="row g-1">
                                    <div class="col d-flex justify-content-center align-items-stretch">
                                        <?php echo anchor('lapis/'.$kluster->kit_shortform, 'Pilih Kluster Isu', "class='btn btn-sm btn-outline-success w-100 d-flex align-items-center justify-content-center'"); ?>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </section>

</main>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>