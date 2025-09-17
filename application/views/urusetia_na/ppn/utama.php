<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PERSONEL</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('pengguna') ?>">Laman</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('ppd') ?>">Laman PPN</a></li>
                <li class="breadcrumb-item active">Utama</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="row g-3 mb-3">
        <div class="col-12 col-lg-3 col-md-4 col-sm-6">
            <a href="<?= site_url('ppn/daftarPpn') ?>" class="btn btn-primary shadow-sm w-100">Daftar PPN</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">
                Senarai Pengarah Penerangan Negeri Terkini
            </h1>
            <div class="table-responsive">
                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th>Penempatan</th>
                            <th>Nombor Siri</th>
                            <th>Nama Pengarah</th>
                            <th>Jawatan</th>
                            <th>Tarikh Mula Lantikan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1; foreach($senaraiPengarah as $ppn): ?>
                        <tr>
                            <td><?= $ppn->penempatan ?></td>
                            <td><?= $ppn->nomborSiriPengguna ?></td>
                            <td><?= $ppn->namaPengarah ?></td>
                            <td><?= $ppn->jawatanPengarah ?></td>
                            <td><?= $ppn->tarikhMulaLantikan ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </section>


</main>


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>