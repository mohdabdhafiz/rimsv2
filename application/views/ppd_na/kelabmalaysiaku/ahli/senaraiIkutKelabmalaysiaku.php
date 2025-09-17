<?php 
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/sidebar');
$this->load->view('ppd_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@KELABMALAYSIAKU</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('kelabmalaysiaku/bil/'.$kelabmalaysiaku->kelabmalaysiaku_bil) ?>"><?= $kelabmalaysiaku->kelabmalaysiaku_nama ?></a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('kelabmalaysiaku/senaraiAhli/'.$kelabmalaysiaku->kelabmalaysiaku_bil) ?>">
                <i class="bi bi-archive"></i>
                Senarai Ahli</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">



    <div class="card">
        <div class="card-body">
            <h1 class="card-title">
            <i class="bi bi-archive"></i>
            Senarai Ahli <?= $kelabmalaysiaku->kelabmalaysiaku_nama ?>
            </h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>NOMBOR AHLI</th>
                            <th>NAMA PENUH</th>
                            <th>JAWATAN</th>
                            <th>ALAMAT</th>
                            <th>NOMBOR TELEFON</th>
                            <th>e-MEL</th>
                            <th>UMUR</th>
                            <th>JANTINA</th>
                            <th>KAUM</th>
                            <th>TARIKH PENDAFTARAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($senaraiAhli as $ahli): ?>
                        <tr>
                            <td><?= $ahli->ka_bil ?></td>
                            <td><?= $ahli->ka_nama ?></td>
                            <td><?= $ahli->ka_jawatan ?></td>
                            <td><?= $ahli->ka_alamat ?></td>
                            <td><?= $ahli->ka_no_telefon ?></td>
                            <td><?= $ahli->ka_emel ?></td>
                            <td><?= $ahli->ka_umur ?></td>
                            <td><?= $ahli->ka_jantina ?></td>
                            <td><?= $ahli->ka_kaum ?></td>
                            <td><?= $ahli->ka_pendaftaran ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    </section>


</main>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>