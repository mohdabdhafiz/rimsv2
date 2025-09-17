<?php 
$this->load->view($header);
$this->load->view($navbar);
$this->load->view($sidebar);
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@KOMUNITI</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">RIMS</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('komuniti') ?>">RIMS@KOMUNITI</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Senarai Laporan Libat Urus Komuniti</h1>
            <hr>
            <div class="row g-3">
                <div class="col-12 col-lg-6 col-md-6 col-sm-6">
                    <a href="<?= site_url('komuniti') ?>" class="btn btn-outline-info shadow-sm w-100">Kembali</a>
                </div>
                <div class="col-12 col-lg-6 col-md-6 col-sm-6">
                    <a href="<?= site_url('komuniti/tambahLibatUrus') ?>" class="btn btn-outline-info shadow-sm w-100">Tambah Laporan</a>
                </div>
            </div>
            <hr>
            <p class="small">Bilangan Laporan: <?= count($senaraiLaporan) ?></p>
            <div class="table-responsive">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>Nombor Siri</th>
                            <th>Aktiviti / Perjumpaan</th>
                            <th>Lokasi</th>
                            <th>Tarikh</th>
                            <th>Masa</th>
                            <th>Bilangan Komuniti</th>
                            <th>Bilangan Kehadiran</th>
                            <th>Catatan/Rumusan</th>
                            <th>Bilangan Gambar / Video</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($senaraiLaporan as $laporan): ?>
                        <tr>
                            <td><?= $laporan->libatUrusBil ?></td>
                            <td><a href="<?= site_url('komuniti/laporanLibatUrus/'.$laporan->libatUrusBil) ?>"><?= strtoupper($laporan->libatUrusNama) ?></a></td>
                            <td><?= strtoupper($laporan->libatUrusLokasi) ?></td>
                            <td><?= $laporan->libatUrusTarikh ?></td>
                            <td><?= $laporan->libatUrusMasa ?></td>
                            <td><?= $laporan->libatUrusBilanganKomuniti ?></td>
                            <td><?= $laporan->libatUrusKehadiran ?></td>
                            <td><?= strtoupper($laporan->libatUrusCatatan) ?></td>
                            <td><?= $laporan->libatUrusBilanganGambar ?></td>
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