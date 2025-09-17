<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@BENCANA</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">RIMS@BENCANA</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Laporan Bencana Siri No. : <?= $bencana->bencana_bil ?></h1>
            <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>Tarikh</th>
                    <td><?= $bencana->bencana_tarikh_laporan ?></td>
                    <th>Pelapor</th>
                    <td><?= $bencana->nama_penuh ?></td>
                </tr>
                <tr>
                    <th>Negeri</th>
                    <td><?= $bencana->nt_nama ?></td>
                    <th>Daerah</th>
                    <td><?= $bencana->nama ?></td>                    
                </tr>
                <tr>
                    <td colspan=4>
                        <strong>Situasi Semasa:</strong><br />
                        <?= $bencana->bencana_situasi ?>
                    </td>
                </tr>
                <tr>
                    <th>Bilangan PPS</th>
                    <td><?= $bencana->bencana_pps ?></td>
                    <th>Jumlah Mangsa</th>
                    <td><?= $bencana->bencana_mangsa ?></td>
                </tr>
                <tr>
                    <th>Bilangan Kematian</th>
                    <td><?= $bencana->bencana_kematian ?></td>
                    <th>Bilangan Hilang</th>
                    <td><?= $bencana->bencana_hilang ?></td>
                </tr>
                <tr>
                    <td colspan=4>
                        <strong>Reaksi Orang Ramai Terhadap Pengurusan Banjir</strong><br />
                        <?= $bencana->bencana_reaksi ?>
                        <?php if(!empty($bencana->bencana_ulasan_reaksi)): ?>
                            <br>
                            <?= $bencana->bencana_ulasan_reaksi ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan=4>
                        <strong>Masalah / Isu Berbangkit Semasa Banjir (PPS / Agensi Terlibat)</strong><br>
                        <?= $bencana->bencana_masalah ?>
                    </td>
                </tr>
                <tr>
                    <td colspan=4>
                        <strong>Lokasi</strong><br>
                        <?= $bencana->bencana_lokasi ?>
                    </td>
                </tr>
                <tr>
                    <td colspan=4>
                        <strong>Cadangan Intervensi</strong><br>
                        <?= $bencana->bencana_intervensi ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <strong>Rumusan</strong><br>
                        <?= $bencana->bencana_rumusan ?>
                    </td>
                </tr>
            </table>
            </div>
        </div>
    </div>



    </section>

</main>


<?php $this->load->view($footer); ?>