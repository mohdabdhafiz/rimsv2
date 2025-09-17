<?php 
$this->load->view('us_program_na/susunletak/atas');
$this->load->view('us_program_na/susunletak/sidebar');
$this->load->view('us_program_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PROGRAM - KONFIGURASI</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('konfigurasi') ?>">Konfigurasi</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('konfigurasi/senaraiKandungan') ?>">Senarai Tajuk Hebahan atau Ceramah Program</a></li>
                <li class="breadcrumb-item active"><?= $kandungan->senarai_kandungan_kandungan ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">
                <i class="bi bi-card-text"></i>
                Tajuk Hebahan / Ceramah Program
            </h1>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <td>
                            <span class="small"><strong>Bil</strong></span>
                            <br><?= $kandungan->senarai_kandungan_bil ?>
                        </td>
                        <td>
                            <span class="small"><strong>Didaftarkan oleh</strong></span>
                            <br><?= $kandungan->nama_penuh ?>
                        </td>
                        <td>
                            <span class="small"><strong>Tarikh Kemasukan Data</strong></span>
                            <br><?= $kandungan->senarai_kandungan_pengguna_waktu ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='3'>
                            <span class="small"><strong>Tajuk Hebahan / Ceramah Program</strong></span>
                            <br><?= $kandungan->senarai_kandungan_kandungan ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="row g-3">
                <div class="col-12 col-lg-6 col-md-6">
                <a href="<?= site_url('konfigurasi/kemaskiniSenaraiKandungan/'.$kandungan->senarai_kandungan_bil) ?>" class="btn btn-outline-primary w-100 shadow-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kemaskini Maklumat">
                                        <i class="bi bi-gear"></i>
                                    Kemaskini Maklumat
                                    </a>
                </div>
                <div class="col-12 col-lg-6 col-md-6">
                <a href="<?= site_url('konfigurasi/confirmPadam/'.$kandungan->senarai_kandungan_bil) ?>" class="btn btn-outline-danger w-100 shadow-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Padam Maklumat">
                                        <i class="bi bi-trash"></i>
                                    Padam Maklumat

                                    </a>
                </div>
            </div>
        </div>
    </div>


    </section>

</main>


<?php $this->load->view('us_program_na/susunletak/bawah'); ?>