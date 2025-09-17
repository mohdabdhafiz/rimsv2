<?php 
$this->load->view('us_program_na/susunletak/atas');
$this->load->view('us_program_na/susunletak/sidebar');
$this->load->view('us_program_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PENGGUNA</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('pengguna') ?>">Senarai Pengguna</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">


    <div class="card">
    <div class="card-body">
        <h1 class="card-title">
            <i class="bi bi-person-badge"></i>
            Senarai Pengguna
        </h1>
        <div class="table-responsive">
    <table id="tableP" class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Jawatan</th>
                    <th>Nombor Telefon</th>
                    <th>e-Mel</th>
                    <th>Status</th>
                    <th>Kategori Peranan</th>
                    <th>Operasi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $bil = 1;
                foreach($senarai_anggota as $anggota): ?>
                <tr>
                    <td><?= $anggota->nama_penuh ?></td>
                    <td><?= $anggota->pekerjaan ?></td>
                    <td><?= $anggota->no_tel ?></td>
                    <td><?= $anggota->emel ?></td>
                    <td><?= $anggota->pengguna_status ?></td>
                    <td>1</td>
                    <td>
                        <?= anchor('pengguna/kemaskini_maklumat/'.$anggota->bil, "<i class='bi bi-person-badge'></i> Kemaskini", "class='btn btn-circle btn-sm btn-secondary shadow-sm mb-1'") ?>
                        <a href="<?= site_url('personel/setRole/'.$anggota->bil) ?>" class="btn btn-circle btn-sm btn-success shadow-sm mb-1"><i class='bi bi-person-badge'></i> Lantik Peranan</a>
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