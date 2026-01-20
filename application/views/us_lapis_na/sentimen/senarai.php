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
                <li class="breadcrumb-item active">Senarai Laporan Khas Sentimen</li>
            </ol>
        </nav>
    </div><section class="section">
        <div class="row">
            <div class="col-lg-12">

                <?php if(!empty($senaraiLks)): ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Senarai Penuh Laporan Khas Sentimen</h5>
                        <p>Jadual ini boleh ditatal secara mendatar untuk melihat semua lajur.</p>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered datatable">
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
                <?php else: ?>
                <div class="alert alert-info" role="alert">
                    <h4 class="alert-heading">Tiada Data Ditemui</h4>
                    <p>Maaf, tiada data laporan khas sentimen yang tersedia pada masa ini.</p>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </section>

</main>

<?php $this->load->view('us_lapis_na/susunletak/bawah'); ?>