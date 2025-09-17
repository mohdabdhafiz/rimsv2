<?php 
$this->load->view($header);
$this->load->view($navbar);
$this->load->view($sidebar);
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@BENCANA</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">RIMS@BENCANA</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
            <h1 class="card-title">Laporan Isu Setempat (LAPIS) Khas Banjir - RIMS@BENCANA</h1>
            <a href="<?= site_url('bencana/tambah') ?>" class="btn btn-outline-primary shadow-sm">
            <i class="bi bi-journal-plus"></i></a>
            </div>
            <p>Laporan Isu Setempat (LAPIS) Khas Banjir adalah untuk melaporkan isu banjir harian bagi tujuan pelaporan kepada pihak pengurusan tertinggi Kementerian Komunikasi. Pegawai Penerangan Daerah perlu melaporkan:</p>
            <ol>
                <li>Reaksi orang ramai terhadap tindakan dan pengurusan banjir.</li>
                <li>Isu / Masalah di PPS / bantuan / perkhidmatan / dll.</li>
            </ol>
            <p>Pastikan semua lokasi masalah yang dihadapi dinyatakan. Laporan ini perlu dihantar selewat-lewatnya jam 4.00 petang setiap hari.</p>
            <p>Sekiranya terdapat isu berbangkit yang perlu diambil perhatian selepas jam 4.00 petang sila hubungi urus setia Puan Norhasila binti Hasan di talian 016-7742408.</p>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">BILANGAN LAPORAN</h1>
                    <dl class="row">
                        <dt class="col-sm-8">Jumlah Laporan Hari Ini <?= date('Y-m-d') ?></dt>
                        <dd class="col-sm-4" id="jumlahLaporanHari">0</dd>
                        <dt class="col-sm-8">Jumlah Laporan Bulan <?= date('M') ?></dt>
                        <dd class="col-sm-4" id="jumlahLaporanBulan">0</dd>
                        <dt class="col-sm-8">Jumlah Laporan Tahun <?= date('Y') ?></dt>
                        <dd class="col-sm-4" id="jumlahLaporan">0</dd>
                    </dl>
                    <p class="small text-muted">Bilangan Laporan yang berstatus 'Terima'</p>
                </div>
            </div>
        </div>
    </div>



    </section>

</main>


<?php $this->load->view($footer); ?>