<?php

$this->load->view($header);
$this->load->view($navbar);
$this->load->view($sidebar);
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">RIMS@SISMAP</li>
                <li class="breadcrumb-item active"><a href="<?= site_url('pencalonan') ?>">PENCALONAN</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

        <section class="section">
            
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Senarai Pilihan Raya</h1>
                <hr>
                <div class="row g-3">
                    <div class="col-12 col-lg-12 col-md-12 col-sm-12">
                        <a href="<?= site_url('utama') ?>" class="btn btn-outline-primary shadow-sm w-100">Kembali</a>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>No. Siri</th>
                                <th>Nama</th>
                                <th>Singkatan</th>
                                <th>Tarikh Penamaan Calon</th>
                                <th>Tarikh Lock Status</th>
                                <th>Jenis</th>
                                <th>Status</th>
                                <th>Tarikh Dibina</th>
                                <th>Operasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($senaraiPilihanraya as $pru): ?>
                            <tr>
                                <td><?= $pru->pilihanraya_bil ?></td>
                                <td><?= $pru->pilihanraya_nama ?></td>
                                <td><?= $pru->pilihanraya_singkatan ?></td>
                                <td><?= $pru->pilihanraya_penamaan_calon ?></td>
                                <td><?= $pru->pilihanraya_lock_status ?></td>
                                <td><?= $pru->pilihanraya_jenis ?></td>
                                <td><?= $pru->pilihanraya_status ?></td>
                                <td><?= $pru->pilihanraya_waktu ?></td>
                                <td>
                                    <div class="row g-1">
                                        <div class="col-auto">
                                            <a class="btn btn-outline-primary shadow-sm" href="<?= site_url('pencalonan/maklumat_pencalonan/'.$pru->pilihanraya_bil) ?>">Pencalonan</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        </section>
</main>
</div>
</div>

<?php
$this->load->view($footer);
?>