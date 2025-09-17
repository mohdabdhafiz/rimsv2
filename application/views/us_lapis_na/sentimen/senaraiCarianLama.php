<?php 
$this->load->view('us_lapis_na/susunletak/atas');
$this->load->view('us_lapis_na/susunletak/sidebar');
$this->load->view('us_lapis_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@LKS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('sentimen') ?>">RIMS@LKS</a></li>
                <li class="breadcrumb-item active">Hasil Carian Laporan Khas Sentimen</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
            <h1 class="card-title">Ketetapan Carian</h1>
            <a href="<?= site_url('sentimen/carian') ?>" class="btn btn-outline-primary shadow-sm">Cari Semula</a>
            </div>
            <div class="row g-3">
                <div class="col-12 col-lg-6">
                    <p>
                        <strong>Tarikh Mula (Timestamp):</strong>
                        <br><?= $tarikhMula ?>
                    </p>
                </div>
                <div class="col-12 col-lg-6">
                    <p>
                        <strong>Tarikh Tamat (Timestamp):</strong>
                        <br><?= $tarikhTamat ?>
                    </p>
                </div>
                <?php if(!empty($pilihanNegeri)): ?>
                <div class="col-12 col-lg-3">
                    <p>
                        <strong>Negeri</strong>
                        <br><?= $pilihanNegeri ?>
                    </p>
                </div>
                <?php endif; ?>
                <div class="col-12 col-lg-3">
                    <p>
                        <strong>Kawasan:</strong>
                        <br><?= $kawasan ?>
                    </p>
                </div>
                <div class="col-12 col-lg-3">
                    <p>
                        <strong>Pekerjaan:</strong>
                        <br><?= $pekerjaan ?>
                    </p>
                </div>
                <div class="col-12 col-lg-3">
                    <p>
                        <strong>Julat Umur:</strong>
                        <br><?= $julatUmur ?>
                    </p>
                </div>
                <div class="col-12 col-lg-3">
                    <p>
                        <strong>Kaum:</strong>
                        <br><?= $kaum ?>
                    </p>
                </div>
                <div class="col-12 col-lg-3">
                    <p>
                        <strong>Sentimen:</strong>
                        <br><?= $sentimen ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <?php if(empty($senaraiLks)): ?>
    <div class="alert alert-warning">
        Tiada carian yang dijumpai.
    </div>
    <?php endif; ?>

    <?php if(!empty($senaraiLks)): ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Senarai Laporan Khas Sentimen</h5>
            <div class="table-responsive">
                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th>Nombor Siri</th>
                            <th>Timestamp</th>
                            <th>e-Mel</th>
                            <th>Tarikh Laporan</th>
                            <th>Nama Pelapor</th>
                            <th>Nombor Telefon</th>
                            <th>Negeri</th>
                            <th>Daerah</th>
                            <th>Parlimen</th>
                            <th>DUN</th>
                            <th>Kawasan</th>
                            <th>Pekerjaan</th>
                            <th>Julat Umur</th>
                            <th>Kaum</th>
                            <th>Jantina</th>
                            <th>Sentimen</th>
                            <th>Ulasan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($senaraiLks as $lks): ?>
                        <tr>
                            <td><?= $lks->stBil ?></td>
                            <td><?= $lks->stPenggunaWaktu ?></td>
                            <td><?= $lks->emel ?></td>
                            <td><?= $lks->stTarikhLaporan ?></td>
                            <td><?= $lks->nama_penuh ?></td>
                            <td><?= $lks->no_tel ?></td>
                            <?php 
                            $namaNegeri = "";
                            $namaDaerah = "";
                            $namaParlimen = "";
                            $namaDun = "";
                            if(!empty($lks->stDaerahBil)){
                                $daerah = $dataDaerah->daerah($lks->stDaerahBil);
                                $namaNegeri = $daerah->nt_nama;
                                $namaDaerah = $daerah->nama;
                            }    
                            if(!empty($lks->stParlimenBil)){
                                $parlimen = $dataParlimen->parlimen_bil($lks->stParlimenBil);
                                $namaParlimen = $parlimen->pt_nama;
                            }
                            if(!empty($lks->stDunBil)){
                                $dun = $dataDun->dun_bil($lks->stDunBil);
                                $namaDun = $dun->dun_nama;
                            }
                            ?>
                            <td><?= $namaNegeri ?></td>
                            <td><?= $namaDaerah ?></td>
                            <td><?= $namaParlimen ?></td>
                            <td><?= $namaDun ?></td>
                            <td><?= $lks->stKawasan ?></td>
                            <td><?= $lks->stPekerjaan ?></td>
                            <td><?= $lks->stUmur ?></td>
                            <td><?= $lks->stKaum ?></td>
                            <td><?= $lks->stJantina ?></td>
                            <td><?= $lks->stSentimen ?></td>
                            <td><?= $lks->stAlasan ?></td>
                            <td><?= $lks->stTapisan ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endif; ?>

    </section>

</main>


<?php $this->load->view('us_lapis_na/susunletak/bawah'); ?>