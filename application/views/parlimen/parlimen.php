<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS - PARLIMEN</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">UTAMA</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('parlimen') ?>">PARLIMEN</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('parlimen/negeri/'.$parlimen->nt_bil) ?>">SENARAI PARLIMEN BAGI <?= strtoupper($parlimen->nt_nama) ?></a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('parlimen/bil/'.$parlimen->pt_bil) ?>">PARLIMEN BAGI <?= strtoupper($parlimen->pt_nama) ?></a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <a href="<?= site_url('parlimen/negeri/'.$parlimen->nt_bil) ?>" class="btn btn-info shadow-sm mb-3">KEMBALI</a>
    <a href="<?= site_url('parlimen/kemaskini/'.$parlimen->parlimenBil) ?>" class="btn btn-secondary shadow-sm mb-3">KEMASKINI</a>
    <a href="<?= site_url('parlimen/padam/'.$parlimen->parlimenBil) ?>" class="btn btn-danger shadow-sm mb-3">PADAM</a>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">PARLIMEN <?= $parlimen->parlimenNama ?></h1>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>NAMA PARLIMEN</th>
                        <td><?= strtoupper($parlimen->pt_nama) ?></td>
                    </tr>
                    <tr>
                        <th>NOMBOR SIRI</th>
                        <td><?= $parlimen->pt_bil ?></td>
                    </tr>
                    <tr>
                        <th>NEGERI</th>
                        <td><?= strtoupper($parlimen->nt_nama) ?></td>
                    </tr>
                    <tr>
                        <th>DISEDIAKAN OLEH:</th>
                        <td><?= $parlimen->penggunaNama ?></td>
                    </tr>
                    <tr>
                        <th>DISEDIAKAN PADA:</th>
                        <td><?= $parlimen->penggunaWaktu ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    </section>


</main>


<?php $this->load->view($footer); ?>