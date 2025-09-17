<?php 
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/sidebar');
$this->load->view('ppd_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@LPK</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">UTAMA</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('sentimen') ?>">RIMS@LPK : LAPORAN PERSEPSI TERHADAP KERAJAAN</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <h2>BILANGAN LAPORAN MENGIKUT PELAPOR BAGI TAHUN <?= date('Y') ?></h2>
    <div class="row g-3">

        <?php foreach($senaraiPelapor as $pelapor): ?>
        <div class="col d-flex align-items-stretch">
            <div class="p-3 border rounded d-flex flex-column w-100 bg-white text-center">
                <div class="my">
                <h1><?= $pelapor->bilanganLaporan ?></h1>
                <p class="mb-0"><?= $pelapor->pelaporNama ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h1 class="card-title">SENARAI BILANGAN LAPORAN PERSEPSI TERHADAP KERAJAAN (LPK) MENGIKUT HARI, MINGGU, BULAN DAN TAHUN</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>#</th>
                            <th>NAMA PEGAWAI</th>
                            <th>JAWATAN PEGAWAI</th>
                            <th><?= date("Y-m-d") ?></th>
                            <th>MINGGU KE <?= date("W") ?></th>
                            <th><?= strtoupper(date("F")) ?></th>
                            <th><?= date("Y") ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($senaraiBilanganLaporan as $sbl): ?>
                            <tr>
                                <th><?= $sbl->pegawaiNomborSiri ?></th>
                                <th><?= $sbl->pegawaiNama ?></th>
                                <th><?= $sbl->pegawaiJawatan ?></th>
                                <th><?= $sbl->laporanHari ?></th>
                                <th><?= $sbl->laporanMinggu ?></th>
                                <th><?= $sbl->laporanBulan ?></th>
                                <th><?= $sbl->laporanTahun ?></th>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <em>KETERANGAN:</em>
                <ol>
                    <li># MERUJUK KEPADA NOMBOR SIRI AKAUN PENGGUNA DALAM RIMS.</li>
                    <li>NAMA PEGAWAI MERUJUK KEPADA NAMA PENUH PEGAWAI YANG DIDAFTARKAN DALAM RIMS.</li>
                    <li>JAWATAN PEGAWAI MERUJUK KEPADA JAWATAN TERAKHIR / SEMASA YANG DIKEMASKINI DALAM RIMS.</li>
                    <li>UNTUK KEMASKINI MAKLUMAT NAMA PEGAWAI DAN JAWATAN PEGAWAI, SILA KEMASKINI DI "MAKLUMAT PENGGUNA" PADA ICON PENGGUNA DISEBELAH ATAS KANAN.</li>
                    <li>"2025-07-01" MERUJUK KEPADA TARIKH HARI INI.</li>
                    <li>MINGGU KE "27" MERUJUK KEPADA BILANGAN MINGGU BAGI SETIAP TAHUN YANG BERMULA PADA HARI ISNIN SETIAP MINGGU.</li>
                    <li>"JULY" MERUJUK KEPADA BULAN PADA HARI INI.</li>
                    <li>"2025" MERUJUK KEPADA TAHUN PADA HARI INI.</li>
                </ol>
            </div>
        </div>
    </div>

    </section>

</main>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>