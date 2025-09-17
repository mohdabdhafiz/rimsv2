<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="pagetitle">
  <h1>Papan Pemuka: <?= htmlspecialchars($nama_kluster ?? 'Nama Kluster') ?></h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= site_url('utama') ?>">Home</a></li>
      <li class="breadcrumb-item active">Pentadbir Kluster</li>
    </ol>
  </nav>
</div><section class="section dashboard">
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="card info-card sales-card">
            <div class="card-body">
                <h5 class="card-title">Jumlah Laporan</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-journal-text"></i>
                    </div>
                    <div class="ps-3">
                        <h6><?= $statistik->jumlah_laporan ?? '0' ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card info-card revenue-card">
            <div class="card-body">
                <h5 class="card-title">Laporan Diterima</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="ps-3">
                        <h6><?= $statistik->diterima ?? '0' ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card info-card warning-card"> <div class="card-body">
                <h5 class="card-title">Laporan Dipinda</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <div class="ps-3">
                        <h6><?= $statistik->dipinda ?? '0' ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card info-card customers-card">
            <div class="card-body">
                <h5 class="card-title">Laporan Ditolak</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-x-circle"></i>
                    </div>
                    <div class="ps-3">
                        <h6><?= $statistik->ditolak ?? '0' ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Senarai Laporan untuk Disemak</h5>
                <table class="table table-hover datatable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tajuk Laporan</th>
                            <th scope="col">Pelapor</th>
                            <th scope="col">Tarikh</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($senarai_laporan)): ?>
                            <?php foreach($senarai_laporan as $index => $laporan): ?>
                            <tr>
                                <th scope="row"><?= $index + 1 ?></th>
                                <td><?= htmlspecialchars($laporan->lapis_tajuk_isu) ?></td>
                                <td><?= htmlspecialchars($laporan->lapis_pelapor_nama) ?></td>
                                <td><?= date('d M Y', strtotime($laporan->lapis_tarikh_laporan)) ?></td>
                                <td>
                                    <?php 
                                                    $status = $laporan->lapis_status;
                                                    $badge_class = 'bg-primary';
                                                    if ($status == 'Laporan Dipinda') $badge_class = 'bg-warning text-dark';
                                                    if ($status == 'Laporan Ditolak') $badge_class = 'bg-danger';
                                                ?>
                                                <span class="badge <?= $badge_class ?>"><?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?></span>
                                </td>
                                <td>
                                    <a href="<?= site_url('lapis2/kemaskini/' . $laporan->lapis_bil) ?>" class="btn btn-primary btn-sm">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
</section>