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
                <div class="col-12 col-lg-3">
                    <p>
                        <strong>Bilangan Laporan:</strong>
                        <br><?= count($senaraiLks) ?>
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
                                        <th scope="col">Nombor Siri</th>
                                        <th scope="col">Timestamp</th>
                                        <th scope="col">e-Mel</th>
                                        <th scope="col">Tarikh Laporan</th>
                                        <th scope="col">Nama Pelapor</th>
                                        <th scope="col">Nombor Telefon</th>
                                        <th scope="col">Negeri</th>
                                        <th scope="col">Daerah</th>
                                        <th scope="col">Parlimen</th>
                                        <th scope="col">DUN</th>
                                        <th scope="col">Kawasan</th>
                                        <th scope="col">Pekerjaan</th>
                                        <th scope="col">Julat Umur</th>
                                        <th scope="col">Kaum</th>
                                        <th scope="col">Jantina</th>
                                        <th scope="col">Sentimen</th>
                                        <th scope="col">Perkara</th>
                                        <th scope="col">Ulasan</th>
                                        <th scope="col">Isu Positif</th>
                                        <th scope="col">Isu Neutral</th>
                                        <th scope="col">Isu Negatif</th>
                                        <th scope="col">Ulasan Isu</th>
                                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach($senaraiLks as $lks): ?>
                        <tr>
                            <td><strong><?= $lks->stBil ?></strong></td>
                                        <td><?= !empty($lks->stPenggunaWaktu) ? date('d M Y, h:i A', strtotime($lks->stPenggunaWaktu)) : '-' ?></td>
                                        <td><?= $lks->emel ?></td>
                                        <td><?= !empty($lks->stTarikhLaporan) ? date('d M Y', strtotime($lks->stTarikhLaporan)) : '-' ?></td>
                                        <td><?= $lks->nama_penuh ?></td>
                                        <td><?= $lks->no_tel ?></td>
                                        <?php 
                                            $namaNegeri = "-";
                                            $namaDaerah = "-";
                                            $namaParlimen = "-";
                                            $namaDun = "-";
                                            if(!empty($lks->stDaerahBil)){
                                                $daerah = $dataDaerah->daerah($lks->stDaerahBil);
                                                if ($daerah) {
                                                    $namaNegeri = $daerah->nt_nama;
                                                    $namaDaerah = $daerah->nama;
                                                }
                                            }    
                                            if(!empty($lks->stParlimenBil)){
                                                $parlimen = $dataParlimen->parlimen_bil($lks->stParlimenBil);
                                                if ($parlimen) $namaParlimen = $parlimen->pt_nama;
                                            }
                                            if(!empty($lks->stDunBil)){
                                                $dun = $dataDun->dun_bil($lks->stDunBil);
                                                if ($dun) $namaDun = $dun->dun_nama;
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
                                        <td>
                                            <?php 
                                                $sentiment = $lks->stSentimen;
                                                $textClass = 'text-secondary'; // Lalai
                                                if ($sentiment == 'Positif') {
                                                    $textClass = 'text-success';
                                                } elseif ($sentiment == 'Negatif') {
                                                    $textClass = 'text-danger';
                                                } elseif ($sentiment == 'Neutral') {
                                                    $textClass = 'text-primary';
                                                }
                                            ?>
                                            <span class="<?= $textClass ?>"><?= $sentiment ?></span>
                                        </td>
                                        <td><?= $lks->stPerkara ?></td>
                                        <td><?= $lks->stAlasan ?></td>
                                        <td><?= $lks->stIsuPositif ?></td>
                                        <td><?= $lks->stIsuNeutral ?></td>
                                        <td><?= $lks->stIsuNegatif ?></td>
                                        <td><?= $lks->stIsuAlasan ?></td>
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