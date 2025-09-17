<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@KOMUNITI</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('komuniti') ?>">RIMS@KOMUNITI</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('komuniti') ?>">LAPORAN LIBAT URUS KOMUNITI</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Laporan Libat Urus Komuniti</h1>
            <hr>
            <div class="row g-3">
                <div class="col-12 col-lg col-md-4 col-sm-4 d-flex align-items-stretch">
                    <a href="<?= site_url('komuniti/libatUrus') ?>" class="btn btn-outline-info shadow-sm w-100 d-flex flex-column">Laman Laporan Libat Urus Komuniti</a>
                </div>
                <div class="col-12 col-lg col-md-4 col-sm-4 d-flex align-items-stretch">
                    <a href="<?= site_url('komuniti/senaraiLibatUrus') ?>" class="btn btn-outline-info shadow-sm w-100 d-flex flex-column">Senarai Laporan Libat Urus Komuniti</a>
                </div>
                <div class="col-12 col-lg col-md-4 col-sm-4 d-flex align-items-stretch">
                    <a href="<?= site_url('komuniti/tambahLibatUrus') ?>" class="btn btn-outline-info shadow-sm w-100 d-flex flex-column">Tambah Laporan</a>
                </div>
                <div class="col d-flex align-items-stretch">
                    <a href="<?= site_url('luk/pilihanPerjumpaan') ?>" class="btn btn-outline-info shadow-sm w-100 d-flex flex-column">Pilihan Perjumpaan</a>
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
                            <td class="text-center"><?= $urus->bilanganPerjumpaan ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr class="text-white bg-secondary">
                            <th colspan=2 class="text-center">JUMLAH KESELURUHAN PERJUMPAAN</th>
                            <th class="text-center"><?= $jumlahKeseluruhan ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if(!empty($senaraiProgramPpd)): ?>
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Rumusan Keseluruhan Anggota Pejabat Penerangan Daerah (<?= date("Y") ?>)</h1>
                <p><em>Ruangan ini hanya untuk perhatian dan tindakan Pegawai Penerangan Daerah sahaja.</em></p>
                <hr>
                <div class="row g-3">
                    <div class="col-12">
                        <a href="<?= site_url('komuniti/senaraiLibatUrusPelapor') ?>" class="btn btn-warning shadow-sm w-100">Senarai Penuh Laporan Libat Urus Komuniti Mengikut Pelapor</a>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered table-hovered">
                        <thead>
                            <tr class="bg-warning">
                                <th>NAMA</th>
                                <th class="text-center">BILANGAN PERJUMPAAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $jumlah2 = 0; foreach($senaraiProgramPpd as $pPpd): $jumlah2 = $jumlah2 + $pPpd->jumlah; ?>
                            <tr>
                                <td><?= $pPpd->pelaporNama ?></td>
                                <td class="text-center"><?= $pPpd->jumlah ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>JUMLAH KESELURUHAN</th>
                                <th class="text-center"><?= $jumlah2 ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>

    </section>


</main>


<?php $this->load->view($footer); ?>