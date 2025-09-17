<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="pagetitle">
  <h1>Papan Pemuka Utama</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= site_url('utama') ?>">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><section class="section dashboard">
<div class="row">

    <div class="col-lg-8">
        <div class="row">

            <div class="col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Personel</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= $bilanganLaporan['personel'] ?? '0' ?></h6>
                                <span class="text-muted small pt-2 ps-1">Jumlah Akaun</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Program</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-calendar-event"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= $bilanganLaporan['program'] ?? '0' ?></h6>
                                <span class="text-muted small pt-2 ps-1">Jumlah Laporan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card info-card customers-card">
                     <div class="card-body">
                        <h5 class="card-title">Kelab Malaysiaku</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-collection-fill"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= $bilanganLaporan['kelabmalaysiaku'] ?? '0' ?></h6>
                                <span class="text-muted small pt-2 ps-1">Jumlah Kelab</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card info-card"> <div class="card-body">
                        <h5 class="card-title">Lain-lain Modul</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-grid-3x3-gap"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= ($bilanganLaporan['komuniti'] ?? 0) + ($bilanganLaporan['obp'] ?? 0) ?></h6>
                                <span class="text-muted small pt-2 ps-1">Laporan Komuniti & OBP</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Taburan Laporan Mengikut Modul</h5>
                        <canvas id="myPieChart" style="max-height: 400px;"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div><div class="col-lg-4">
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Pentadbiran Sistem</h5>
                <div class="list-group list-group-flush">
                    <a href="<?= site_url('pengguna') ?>" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="bi bi-person-lines-fill me-3"></i> Pengurusan Pengguna
                    </a>
                    <a href="<?= site_url('peranan') ?>" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="bi bi-key-fill me-3"></i> Pengurusan Peranan
                    </a>
                    <a href="<?= site_url('pegawai') ?>" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="bi bi-person-badge me-3"></i> Pengurusan Pegawai
                    </a>
                    <a href="<?= site_url('japen') ?>" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="bi bi-building me-3"></i> Pengurusan JAPEN
                    </a>
                </div>
            </div>
        </div>

        </div></div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    if (typeof Chart !== 'undefined') {
        const ctx = document.getElementById('myPieChart').getContext('2d');
        const myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Personel", "Program", "Komuniti", "OBP", "Pilihan Raya", "Kelab Malaysiaku"],
                datasets: [{
                    label: 'Bilangan Laporan',
                    data: [
                        <?= $bilanganLaporan['personel'] ?? 0 ?>, 
                        <?= $bilanganLaporan['program'] ?? 0 ?>, 
                        <?= $bilanganLaporan['komuniti'] ?? 0 ?>,
                        <?= $bilanganLaporan['obp'] ?? 0 ?>,
                        <?= $bilanganLaporan['pilihanraya'] ?? 0 ?>,
                        <?= $bilanganLaporan['kelabmalaysiaku'] ?? 0 ?>
                    ],
                    backgroundColor: [
                        '#4154f1', // Biru
                        '#2eca6a', // Hijau
                        '#ff771d', // Oren
                        '#dc3545', // Merah
                        '#6f42c1', // Ungu
                        '#ffc107'  // Kuning
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    }
});
</script>