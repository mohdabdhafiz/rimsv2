<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PERSONEL</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item">
                    <a href="<?= site_url('peranan/daftarPengguna/'.$penggunaBerjaya->pengguna_peranan_bil) ?>">
                        <i class="bi bi-file-earmark-text"></i>
                        Borang Daftar Pengguna Mengikut Peranan <?= strtoupper($penggunaBerjaya->pengguna_peranan_nama) ?>
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    <i class="bi bi-file-earmark-text"></i>
                    Pendaftaran Pengguna BERJAYA!
                </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section bg-light">
        
    <div class="alert alert-success my-5">
        <h1 class="alert-heading">Pendaftaran Berjaya!</h1>
        Pendaftaran baharu pengguna mengikut peranan telah berjaya!
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">
                <i class="bi bi-people"></i>
                Maklumat Pengguna
            </h1>
            <div class="row g-5">
                <div class="col-12 col-lg-3 col-md-4 col-sm-6">
                    <strong>Nama:</strong>
                    <br /><?= strtoupper($penggunaBerjaya->nama_penuh) ?>
                </div>
                <div class="col-12 col-lg-3 col-md-4 col-sm-6">
                    <strong>Nombor Kad Pengenalan:</strong>
                    <br /><?= $penggunaBerjaya->pengguna_ic ?>
                </div>
                <div class="col-12 col-lg-3 col-md-4 col-sm-6">
                    <strong>Nombor Telefon:</strong>
                    <br /><?= $penggunaBerjaya->no_tel ?>
                </div>
                <div class="col-12 col-lg-3 col-md-4 col-sm-6">
                    <strong>Jawatan:</strong>
                    <br /><?= $penggunaBerjaya->pekerjaan ?>
                </div>
                <div class="col-12 col-lg-3 col-md-4 col-sm-6">
                    <strong>Penempatan:</strong>
                    <br /><?= $penggunaBerjaya->pengguna_tempat_tugas ?>
                </div>
                <div class="col-12 col-lg-3 col-md-4 col-sm-6">
                    <strong>Waktu Pendaftaran:</strong>
                    <br /><?= $penggunaBerjaya->pengguna_waktu ?>
                </div>
            </div>
        </div>
    </div>


    </section>

</main>


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>