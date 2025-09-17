<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="pagetitle">
  <h1>RIMS@SISMAP</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= site_url('utama') ?>">Home</a></li>
      <li class="breadcrumb-item active">RIMS@SISMAP</li>
    </ol>
  </nav>
</div>

<section class="section dashboard">
    <div class="row">

        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Senarai Pilihan Raya Aktif</h5>
                    
                    <?php if (!empty($senaraiPruAktif)): ?>
                        <div class="row g-3">
                            <?php foreach($senaraiPruAktif as $pru): ?>
                            <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                                <div class="p-3 border rounded text-center w-100 d-flex flex-column shadow-sm">
                                    <h2 class="display-6"><?= htmlspecialchars($pru->pruSingkatan) ?></h2>
                                    <p><?= htmlspecialchars($pru->pruNama) ?></p>
                                    <div class="mt-auto">
                                        <a href="<?= site_url('pilihanraya/bil/'.$pru->pruBil) ?>" class="btn btn-outline-primary w-100">Lihat Maklumat</a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-center text-muted mt-3">Tiada pilihan raya yang aktif pada masa ini.</p>
                    <?php endif; ?>

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Gerak Kerja</h5>
                    <div class="list-group">
                        <a href="<?= site_url('winnable_candidate') ?>" class="list-group-item list-group-item-action">Modul Jangkaan Calon</a>
                        <a href="<?= site_url('pencalonan') ?>" class="list-group-item list-group-item-action">Modul Hari Penamaan Calon</a>
                        <a href="<?= site_url('grading') ?>" class="list-group-item list-group-item-action">Modul Grading</a>
                        <a href="<?= site_url('undi') ?>" class="list-group-item list-group-item-action">Modul Hari Pembuangan Undi</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Operasi</h5>
                    <?php 
                    // Memuatkan navigasi operasi seperti dalam fail asal
                    $this->load->view('us_sismap_na/us_sismap_nav'); 
                    ?>
                </div>
            </div>
        </div>

    </div>
</section>