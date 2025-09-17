<?php 
$this->load->view('us_program_na/susunletak/atas');
$this->load->view('us_program_na/susunletak/sidebar');
$this->load->view('us_program_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PROGRAM</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    
    <?php $this->load->view('us_program_na/carian'); ?>
    

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Senarai Program Tahun <?= date('Y') ?></h5>
                <div class="btn-group" role="group" aria-label="Operasi Senarai Laporan">
                    <a href="<?= site_url('program/muatTurun') ?>" class="btn btn-outline-primary shadow-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Muat Turun Senarai Program">
                        <i class="bi bi-save2"></i>
                    </a>
                    <a href="<?= site_url('program/tambah') ?>" class="btn btn-outline-primary shadow-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tambah Program">
                        <i class="bi bi-calendar2-plus"></i>
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>STATUS</th>
                            <th>NOMBOR SIRI</th>
                            <th>TARIKH LAPORAN DIBUAT</th>
                            <th>NAMA PELAPOR</th>
                            <th>NOMBOR TELEFON PELAPOR</th>
                            <th>JAWATAN PELAPOR</th>
                            <th>PENEMPATAN PELAPOR</th>
                            <th>NAMA PROGRAM</th>
                            <th>NEGERI</th>
                            <th>DAERAH</th>
                            <th>PARLIMEN</th>
                            <th>DUN</th>
                            <th>LOKASI</th>
                            <th>BILANGAN LOKASI</th>
                            <th>TARIKH</th>
                            <th>MASA</th>
                            <th>JUMLAH KHALAYAK</th>
                            <th>OPERASI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($senaraiProgram as $p): ?>
                        <tr>
                            <td><?= strtoupper($p->program_status) ?></td>
                            <td><?= $p->program_bil ?></td>
                            <td><?= $p->program_pengguna_waktu ?></td>
                            <td><?= strtoupper($p->nama_penuh) ?></td>
                            <td><?= $p->no_tel ?></td>
                            <td><?= strtoupper($p->pekerjaan) ?></td>
                            <td><?= strtoupper($p->pengguna_tempat_tugas) ?></td>
                            <td><?= strtoupper($p->jt_nama) ?></td>
                            <td><?= strtoupper($p->nt_nama) ?></td>
                            <td><?= strtoupper($p->nama) ?></td>
                            <td><?= strtoupper($p->pt_nama) ?></td>
                            <td><?= strtoupper($p->dun_nama) ?></td>
                            <td>
                                <?php if(!empty($p->senarai_lokasi)): ?>
                                    <?= strtoupper($p->senarai_lokasi) ?></td>
                                <?php endif; ?>
                            <td>
                                <?php if(!empty($p->bilangan_lokasi)): ?>
                                    <?= $p->bilangan_lokasi ?>
                                <?php endif; ?>
                            </td>
                            <?php
                            $tarikhProgram = "";
                            $masaProgram = "";
                            $tarikhProgram = date_format(date_create($p->program_tarikh_masa), 'Y-m-d');
                            $masaProgram = date_format(date_create($p->program_tarikh_masa), 'H:i:s');
                            ?>
                            <td><?= $tarikhProgram ?></td>
                            <td><?= $masaProgram ?></td>
                            <td><?= $p->program_khalayak ?></td>
                            <td>
                                <div class="row g-1">
                                    <div class="col-12">
                                        <a href="<?= site_url('program/bil/'.$p->program_bil) ?>" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Maklumat Lanjut">
                                            <i class="bi bi-chevron-right"></i>
                                        </a>
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


<?php $this->load->view('us_program_na/susunletak/bawah'); ?>
