<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
    /* Gaya untuk Kad Tindakan */
    .action-card { text-decoration: none; }
    .action-card .card { transition: all 0.3s ease-in-out; border-left-width: 4px; }
    .action-card .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px -5px rgba(0,0,0,0.1); background-color: #f8f9fa; }

    /* CSS Baharu untuk Kad Kluster Harian */
    .kluster-card {
        text-decoration: none;
        color: inherit;
    }
    .kluster-card .card {
        transition: all 0.3s ease-in-out;
        border-left-width: 4px;
    }
    .kluster-card .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px -5px rgba(0,0,0,0.1);
        cursor: pointer;
    }
    .kluster-card-icon {
        font-size: 2.5rem;
        opacity: 0.6;
    }
    .kluster-card .count {
        font-size: 2.5rem;
        font-weight: 700;
    }
    .kluster-card-link {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .kluster-card-link:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
</style>

<div class="pagetitle">
  <h1>RIMS@LAPIS</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= site_url('utama') ?>">Home</a></li>
      <li class="breadcrumb-item active">LAPIS</li>
    </ol>
  </nav>
</div><section class="section dashboard">
<div class="row">

    <div class="col-lg-12">

        <div class="row">
            <div class="col-md-6">
                <div class="card info-card sales-card">

                    <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                        <h6>Tindakan</h6>
                        </li>
                        <li>
                        <a class="dropdown-item" href="<?= site_url('cpi/senarai_kluster_isu') ?>">
                            <i class="bi bi-gear-fill"></i> Urus Senarai Kluster
                        </a>
                        </li>
                    </ul>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Kluster Isu</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-journal-text"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= is_array($senarai_kluster) ? count($senarai_kluster) : 0 ?></h6>
                                <span class="text-muted small pt-2 ps-1">Jumlah Kluster</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card info-card customers-card">
                    <div class="card-body">
                        <h5 class="card-title">Laporan Ditolak</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-journal-x"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= $bilanganLaporanTolak->bilangan ?? '0' ?></h6>
                                <span class="text-muted small pt-2 ps-1">Jumlah Laporan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-12">
                <h5 class="card-title pt-2">Tindakan Utama</h5>
            </div>
            <div class="col-lg-4">
                <a href="<?= site_url('lapis/carianTerperinci') ?>" class="action-card">
                    <div class="card shadow-sm border-start border-primary h-100">
                        <div class="card-body text-center p-4">
                            <i class='bx bx-search-alt display-4 text-primary mb-2'></i>
                            <h5 class="card-title fw-bold">Carian Laporan</h5>
                            <p class="card-text small text-muted">Cari laporan menggunakan pelbagai tapisan terperinci.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="<?= site_url("lapis/listArkib") ?>" class="action-card">
                    <div class="card shadow-sm border-start border-success h-100">
                        <div class="card-body text-center p-4">
                            <i class='bx bx-archive display-4 text-success mb-2'></i>
                            <h5 class="card-title fw-bold">Arkib Laporan</h5>
                            <p class="card-text small text-muted">Akses dan semak laporan-laporan dari tahun lepas.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="#" class="action-card" data-bs-toggle="modal" data-bs-target="#muatTurunModal">
                    <div class="card shadow-sm border-start border-warning h-100">
                        <div class="card-body text-center p-4">
                            <i class='bx bxs-download display-4 text-warning mb-2'></i>
                            <h5 class="card-title fw-bold">Muat Turun Laporan</h5>
                            <p class="card-text small text-muted">Jana dan muat turun laporan dalam format Excel/PDF.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-12">
                <h5 class="card-title pt-2">Laporan Hari Ini <span>| <?= date('d M Y') ?></span></h5>
            </div>

            <?php
                // Bantu untuk memadankan ikon dengan kluster
                $kluster_icons = [
                    'politik' => 'bi-megaphone-fill',
                    'ekonomi' => 'bi-graph-up-arrow',
                    'sosial' => 'bi-people-fill',
                    'keselamatan' => 'bi-shield-shaded',
                    'infrastruktur' => 'bi-cone-striped',
                    'kesihatan' => 'bi-bandaid-fill',
                    'alamsekitar' => 'bi-tree-fill',
                    'telekomunikasi' => 'bi-broadcast-pin'
                ];
            ?>

            <?php if (!empty($laporanHarianKluster)): ?>
                <?php foreach($laporanHarianKluster as $kluster): ?>
                    <div class="col-lg-3 col-md-6">
                        <a href="#" class="kluster-card">
                            <div class="card shadow-sm border-start border-primary h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="card-subtitle mt-3 mb-2 text-muted"><?= htmlspecialchars($kluster->kit_nama) ?></h6>
                                            <div class="count text-primary"><?= $kluster->bilangan_hari_ini ?></div>
                                        </div>
                                        <i class="bi <?= $kluster_icons[$kluster->kit_shortform] ?? 'bi-file-earmark-text' ?> kluster-card-icon text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-light text-center">Tiada laporan diterima untuk hari ini.</div>
                </div>
            <?php endif; ?>

        </div>
        
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pilih Kluster Isu</h5>
                        <p>Klik pada salah satu kluster di bawah untuk melihat senarai laporan yang berkaitan.</p>
                        <div class="row g-4">
                            <?php foreach($senarai_kluster as $kluster): ?>
                                <div class="col-md-4 col-lg-3 d-flex align-items-stretch">
                                    <div class="card w-100 kluster-card-link">
                                        <div class="card-body d-flex flex-column text-center">
                                            
                                            <!-- BAHAGIAN UTAMA KAD (BOLEH DIKLIK) -->
                                            <!-- pautan ini akan mengambil semua ruang yang ada (flex-grow-1) -->
                                            <a href="<?= site_url('lapis/terima/' . $kluster->kit_bil) ?>" class="text-decoration-none text-dark flex-grow-1 d-flex flex-column justify-content-center">
                                                <i class="bi bi-folder2-open display-4 text-primary"></i>
                                                <h5 class="card-title mt-2 mb-0"><?= htmlspecialchars(strtoupper($kluster->kit_nama), ENT_QUOTES, 'UTF-8') ?></h5>
                                            </a>

                                            <!-- BUTANG PENTADBIR (DI BAHAGIAN BAWAH) -->
                                            <!-- mt-auto akan menolak butang ini ke bahagian paling bawah kad -->
                                            <div class="mt-auto pt-3">
                                                <a href="<?= site_url('pentadbir_kluster/dashboard/'.$kluster->kit_bil) ?>" class="btn btn-outline-primary btn-sm">
                                                    Papan Pemuka Pentadbir
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Aktiviti Sentimen Terkini</h5>
                        <div class="list-group list-group-flush">
                            <?php if (!empty($senaraiSentimenTerkini)): ?>
                                <?php foreach($senaraiSentimenTerkini as $sentimen): ?>
                                    <div class="list-group-item">
                                        <h6 class="mb-1 text-dark"><?= htmlspecialchars(mb_strimwidth($sentimen->stPerkara, 0, 50, "...")) ?></h6>
                                        <small class="text-muted">
                                            Oleh: <?= htmlspecialchars($sentimen->penggunaNama) ?> | 
                                            <?= date('d M Y', strtotime($sentimen->stTarikhLaporan)) ?>
                                        </small>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="list-group-item text-muted">Tiada laporan sentimen terkini.</div>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer text-center">
                            <a href="<?= site_url('sentimen/senarai') ?>">Lihat Semua Laporan Sentimen</a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Prestasi Pelapor PPD <span>| Mengikut Organisasi</span></h5>

                        <div class="list-group list-group-flush" style="max-height: 300px; overflow-y: auto;">
                            <?php if (!empty($rumusanPpd)): ?>
                                <?php foreach($rumusanPpd as $rumusan): ?>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><?= htmlspecialchars($rumusan->nama_organisasi) ?></span>
                                        <span class="badge bg-primary rounded-pill"><?= $rumusan->total_pelapor ?></span>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="list-group-item text-muted">Tiada data ditemui.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between fw-bold">
                        JUMLAH KESELURUHAN
                        <span><?= $jumlahPelaporPpd ?? '0' ?> Pelapor</span>
                    </div>
                </div>

            </div>
        </div>

</section>