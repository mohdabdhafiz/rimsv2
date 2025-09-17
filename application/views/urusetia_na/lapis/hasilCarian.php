<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@LAPIS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Utama</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="card-title">Hasil Carian</h1>
                    <a href="<?= site_url('lapis') ?>" class="btn btn-outline-primary btn-sm shadow-sm">Cari Semula</a>
                </div>
                <div class="table-responsive mb-3">
                    <table class="table table-sm table-bordered">
                        <tr>
                            <th>Negeri</th>
                            <td><?= $negeri->nt_nama ?></td>
                        </tr>
                        <tr>
                            <th>Kluster</th>
                            <td><?= $kluster->kit_nama ?></td>
                        </tr>
                        <tr>
                            <th>Tahun</th>
                            <td><?= $tahun ?></td>
                        </tr>
                    </table>
                </div>
                <hr>
                <p><strong>Senarai Laporan</strong></p>
                <p>Bilangan Akaun = <?= count($senaraiPelapor) ?> orang.</p>
                <div class="table-responsive">
                    <table class="table-sm datatable">
                        <thead>
                            <tr>
                                <th>BIL</th>
                                <th>TARIKH LAPORAN</th>
                                <th>NAMA PELAPOR</th>
                                <th>JAWATAN PELAPOR</th>
                                <th>PENEMPATAN PELAPOR</th>
                                <th>DAERAH</th>
                                <th>PARLIMEN</th>
                                <th>DUN</th>
                                <th>DAERAH MENGUNDI</th>
                                <th>ISU</th>
                                <th>RINGKASAN ISU</th>
                                <th>LOKASI ISU</th>
                                <th>LATITUDE LOKASI ISU</th>
                                <th>LONGITUDE LOKASI ISU</th>
                                <th>JENIS KAWASAN</th>
                                <th>CADANGAN INTERVENSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($senaraiLaporan as $laporan): ?>
                            <tr>
                                <td><?= $laporan->laporanBil ?></td>
                                <td><?= $laporan->tarikhLaporan ?></td>
                                <td><?= $laporan->nama_penuh ?></td>
                                <td><?= $laporan->pekerjaan ?></td>
                                <td><?= $laporan->pengguna_tempat_tugas ?></td>
                                <td><?= $laporan->nama ?></td>
                                <td><?= $laporan->pt_nama ?></td>
                                <td><?= $laporan->dun_nama ?></td>
                                <td><?= $laporan->ppt_nama ?></td>
                                <td><?php
                                switch($laporan->kit_shortform){
                                    case 'alamsekitar':
                                        echo $laporan->isu_alamsekitar;
                                        break;
                                    case 'ekonomi':
                                        echo $laporan->isu_ekonomi;
                                        break;
                                    case 'infrastruktur':
                                        echo $laporan->isu_infrastruktur;
                                        break;
                                    case 'keselamatan':
                                        echo $laporan->isu_keselamatan;
                                        break;
                                    case 'kesihatan':
                                        echo $laporan->isu_kesihatan;
                                        break;
                                    case 'politik':
                                        echo $laporan->isu_politik;
                                        break;
                                    case 'sosial':
                                        echo $laporan->isu_sosial;
                                        break;
                                    case 'telekomunikasi':
                                        echo $laporan->isu_telekomunikasi;
                                        break;
                                }
                                ?></td>
                                <td><?= $laporan->ringkasan_isu ?></td>
                                <td><?= $laporan->lokasi_isu ?></td>
                                <td><?= $laporan->latitude ?></td>
                                <td><?= $laporan->longitude ?></td>
                                <td><?= $laporan->jenis_kawasan ?></td>
                                <td><?= $laporan->cadangan_intervensi ?></td>
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