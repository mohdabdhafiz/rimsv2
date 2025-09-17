<?php 
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/sidebar');
$this->load->view('ppd_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@KOMUNITI</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">RIMS</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('komuniti') ?>">RIMS@KOMUNITI</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Laporan Libat Urus Komuniti</h1>
            <hr>
            <div class="row g-3">
                <div class="col-12 col-lg-4 col-md-4 col-sm-4">
                    <a href="<?= site_url('komuniti/libatUrus') ?>" class="btn btn-outline-info shadow-sm w-100">Laman Laporan Libat Urus Komuniti</a>
                </div>
                <div class="col-12 col-lg-4 col-md-4 col-sm-4">
                    <a href="<?= site_url('komuniti/senaraiLibatUrus') ?>" class="btn btn-outline-info shadow-sm w-100">Senarai Laporan Libat Urus Komuniti</a>
                </div>
                <div class="col-12 col-lg-4 col-md-4 col-sm-4">
                    <a href="<?= site_url('komuniti/tambahLibatUrus') ?>" class="btn btn-outline-info shadow-sm w-100">Tambah Laporan</a>
                </div>
            </div>
            <hr>
            <?php if(!empty($senaraiKomunitiLibatUrus)): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="text-white bg-primary">
                            <th class="text-center">BIL</th>
                            <th class="text-center">KOMUNITI</th>
                            <th class="text-center">BILANGAN PERJUMPAAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1; $jumlahKeseluruhan = 0; foreach($senaraiKomunitiLibatUrus as $urus): $jumlahKeseluruhan = $jumlahKeseluruhan + $urus->bilanganPerjumpaan; ?>
                        <tr>
                            <td class="text-center"><?= $count++ ?></td>
                            <td class="text-start"><?= strtoupper($urus->komunitiNama) ?></td>
                            <td class="text-end"><?= $urus->bilanganPerjumpaan ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr class="text-white bg-secondary">
                            <th colspan=2 class="text-center">JUMLAH KESELURUHAN PERJUMPAAN</th>
                            <th class="text-end"><?= $jumlahKeseluruhan ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <?php endif; ?>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Rumusan Mengikut Daerah</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">BIL</th>
                        <th>DAERAH</th>
                        <th class="text-center">BILANGAN KOMUNITI</th>
                        <th class="text-center">BILANGAN MENGIKUT PELAPOR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1; foreach($rumusanDaerah as $rd): ?>
                    <tr>
                        <td class="text-center"><?= $count++ ?></td>
                        <td><?= strtoupper($rd->namaDaerah) ?></td>
                        <td class="text-center"><?= $rd->jumlahKomuniti ?></td>
                        <td class="text-center"><?= $rd->jumlahIkutPelapor ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Rumusan Mengikut Parlimen</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">BIL</th>
                        <th>PARLIMEN</th>
                        <th class="text-center">BILANGAN KOMUNITI</th>
                        <th class="text-center">BILANGAN MENGIKUT PELAPOR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1; foreach($rumusanParlimen as $rp): ?>
                    <tr>
                        <td class="text-center"><?= $count++ ?></td>
                        <td><?= strtoupper($rp->namaParlimen) ?></td>
                        <td class="text-center"><?= $rp->jumlahKomuniti ?></td>
                        <td class="text-center"><?= $rp->jumlahIkutPelapor ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Rumusan Mengikut DUN</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">BIL</th>
                        <th>DUN</th>
                        <th class="text-center">BILANGAN KOMUNITI</th>
                        <th class="text-center">BILANGAN MENGIKUT PELAPOR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1; foreach($rumusanDun as $rdn): ?>
                    <tr>
                        <td class="text-center"><?= $count++ ?></td>
                        <td><?= strtoupper($rdn->namaDun) ?></td>
                        <td class="text-center"><?= $rdn->jumlahKomuniti ?></td>
                        <td class="text-center"><?= $rdn->jumlahIkutPelapor ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>



    </section>


</main>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>