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

    <?php $this->load->view('us_program_na/us_program_nav'); ?>
    
    <?php $this->load->view('us_program_na/carian'); ?>
    

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Senarai Program</h5>
                <a href="<?= site_url('program/tambah') ?>" class="btn btn-outline-primary shadow-sm">Tambah Program</a>
            </div>
            <div class="table-responsive">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>STATUS</th>
                            <th>NOMBOR SIRI</th>
                            <th>NAMA PELAPOR</th>
                            <th>JAWATAN PELAPOR</th>
                            <th>PENEMPATAN PELAPOR</th>
                            <th>AKAUN PERANAN</th>
                            <th>NAMA PROGRAM</th>
                            <th>NEGERI</th>
                            <th>DAERAH</th>
                            <th>PARLIMEN</th>
                            <th>DUN</th>
                            <th>TARIKH</th>
                            <th>MASA</th>
                            <th>JUMLAH KHALAYAK</th>
                            <th>OPERASI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($senaraiProgram as $p): ?>
                        <tr>
                            <td><?= $p->program_status ?></td>
                            <td><?= $p->program_bil ?></td>
                            <td><?= $p->nama_penuh ?></td>
                            <td><?= $p->pekerjaan ?></td>
                            <td><?= $p->pengguna_tempat_tugas ?></td>
                            <td><?= $p->peranan_nama ?></td>
                            <td><?= $p->jt_nama ?></td>
                            <td><?= $p->nt_nama ?></td>
                            <td><?= $p->nama ?></td>
                            <td><?= $p->pt_nama ?></td>
                            <td><?= $p->dun_nama ?></td>
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
                                        <a href="<?= site_url('program/bil/'.$p->program_bil) ?>" class="btn btn-outline-primary shadow-sm w-100">Lihat</a>
                                    </div>
                                    <div class="col-12">
                                        <a href="<?= site_url('program/kemaskini/'.$p->program_bil) ?>" class="btn btn-outline-primary shadow-sm w-100">Kemaskini</a>
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
