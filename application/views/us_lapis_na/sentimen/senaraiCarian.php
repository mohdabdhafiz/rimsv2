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
            <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Senarai Laporan Khas Sentimen</h5>
            <?= form_open("sentimen/muatTurun") ?>
            <input type="hidden" name="inputTarikhMula" value="<?= $tarikhMula ?>">
            <input type="hidden" name="inputTarikhTamat" value="<?= $tarikhTamat ?>">
            <button type="submit" class="btn btn-primary">Muat Turun</button>
            <?= form_close() ?>
            </div>
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
                            <th>Perkara</th>
                            <th>Ulasan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($senaraiLks as $lks): ?>
                        <tr>
                            <td><?= $lks->lksBil ?></td>
                            <td><?= $lks->lksTimestamp ?></td>
                            <td><?= $lks->penggunaEmel ?></td>
                            <td><?= $lks->lksTarikhLaporan ?></td>
                            <td><?= $lks->penggunaNama ?></td>
                            <td><?= $lks->penggunaNoTel ?></td>
                            <td><?= $lks->negeriNama ?></td>
                            <td><?= $lks->daerahNama ?></td>
                            <td><?= $lks->parlimenNama ?></td>
                            <td><?= $lks->dunNama ?></td>
                            <td><?= $lks->lksKawasan ?></td>
                            <td><?= $lks->lksPekerjaan ?></td>
                            <td><?= $lks->lksUmur ?></td>
                            <td><?= $lks->lksKaum ?></td>
                            <td><?= $lks->lksJantina ?></td>
                            <td><?= $lks->lksSentimen ?></td>
                            <td><?= $lks->lksPerkara ?></td>
                            <td><?= $lks->lksUlasan ?></td>
                            <td><?= $lks->lksTapisan ?></td>
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