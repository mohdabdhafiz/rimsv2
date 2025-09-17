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
                    <a href="<?= site_url('peranan/daftarPengguna/'.$peranan->peranan_bil) ?>">
                        <i class="bi bi-file-earmark-text"></i>
                        Borang Daftar Pengguna Mengikut Peranan <?= strtoupper($peranan->peranan_nama) ?>
                    </a>
                </li>
                <li class="breadcrumb-item active">
                    <i class="bi bi-file-earmark-text"></i>
                    Pendaftaran Pengguna Tidak Berjaya
                </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section bg-light">
        
    <div class="alert alert-danger my-5">
        <h1 class="alert-heading">Pendaftaran Tidak Berjaya</h1>
        Terdapat masalah dalam mendaftarkan akaun ini. Pastikan pengguna belum mendaftar sebelum mendaftarkan menggunakan pendekatan ini.
    </div>


    </section>

</main>


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>