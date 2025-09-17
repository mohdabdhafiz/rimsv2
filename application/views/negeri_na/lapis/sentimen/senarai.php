<?php 
$this->load->view('negeri_na/susunletak/atas');
$this->load->view('negeri_na/susunletak/sidebar');
$this->load->view('negeri_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@LPK</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('sentimen') ?>">RIMS@LPK</a></li>
                <li class="breadcrumb-item active">Senarai Laporan Persepsi Terhadap Kerajaan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

   

    <?php if(!empty($senaraiLks)): ?>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Senarai Laporan Persepsi Terhadap Kerajaan</h5>
            <a href="<?= site_url('sentimen/muatTurun') ?>" class="btn btn-outline-primary">Muat Turun</a>
            </div>
            <p>Bilangan Laporan: <?= count($senaraiLks) ?></p>
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
                            <th>Umur</th>
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


<?php $this->load->view('negeri_na/susunletak/bawah'); ?>