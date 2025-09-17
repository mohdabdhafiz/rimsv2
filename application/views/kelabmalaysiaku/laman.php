<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@KELABMALAYSIAKU</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">UTAMA</a></li>
                <li class="breadcrumb-item active">
                    <i class="bi bi-columns-gap"></i>
                    DASHBOARD
                </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <p class="small text-end text-secondary">SETAKAT - <?= date('d.m.Y H:i:s') ?></p>

   <div class="p-3 border rounded bg-white shadow-sm">
    <h3 class="text-primary">RUMUSAN KELAB MALAYSIAKU BERSTATUS AKTIF</h3>
    <div class="row g-3">
        <div class="col-12 col-lg-4 col-md-4 col-sm-6">
            <div class="border p-3 rounded d-flex flex-column align-self-stretch">
                <div class="d-flex justify-content-center align-items-center">
                    <h1 class="display-1 mb-0"><?= number_format($am->bilanganKelab, 0, ".", ",") ?></h1>
                </div>
                <div class="d-flex justify-content-center align-items-center mt-auto">
                    <p class="text-center text-secondary mb-0">BILANGAN KELAB</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4 col-md-4 col-sm-6">
            <div class="border p-3 rounded d-flex flex-column align-self-stretch">
                <div class="d-flex justify-content-center align-items-center">
                    <h1 class="display-1 mb-0"><?= number_format($am->bilanganSekolah, 0, ".", ",") ?></h1>
                </div>
                <div class="d-flex justify-content-center align-items-center mt-auto">
                    <p class="text-center text-secondary mb-0">BILANGAN SEKOLAH</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4 col-md-4 col-sm-6">
            <div class="border p-3 rounded d-flex flex-column align-self-stretch">
                <div class="d-flex justify-content-center align-items-center">
                    <h1 class="display-1 mb-0"><?= number_format($am->bilanganAhli, 0, ".", ",") ?></h1>
                </div>
                <div class="d-flex justify-content-center align-items-center mt-auto">
                    <p class="text-center text-secondary mb-0">BILANGAN KESELURUHAN AHLI</p>
                </div>
            </div>
        </div>

    </div>

    <hr>

    <div id="rumusanNegeri" class="mb-3">
        <h3 class="text-primary">RUMUSAN MENGIKUT <?= strtoupper($rujukan) ?> YANG BERSTATUS AKTIF</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">
                <thead>
                    <tr class="bg-warning text-dark">
                        <th><?= strtoupper($rujukan) ?></th>
                        <th class="text-center">JUMLAH KELAB</th>
                        <th class="text-center">JUMLAH SEKOLAH</th>
                        <th class="text-center">JUMLAH AHLI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $jumlahKeseluruhanKelab = 0;
                    $jumlahKeseluruhanSekolah = 0;
                    $jumlahKeseluruhanAhli = 0;
                    foreach($senaraiRumusan as $rumusan): 
                        $jumlahKeseluruhanKelab = $jumlahKeseluruhanKelab + $rumusan->jumlahKelab;
                        $jumlahKeseluruhanSekolah = $jumlahKeseluruhanSekolah + $rumusan->jumlahSekolah;
                        $jumlahKeseluruhanAhli = $jumlahKeseluruhanAhli + $rumusan->jumlahAhli;
                    ?>
                    <tr>
                        <td width="40%"><?= $rumusan->kategoriNama ?></td>
                        <td class="text-end"><?= number_format($rumusan->jumlahKelab, 0, ".", ",") ?></td>
                        <td class="text-end"><?= number_format($rumusan->jumlahSekolah, 0, ".", ",") ?></td>
                        <td class="text-end"><?= number_format($rumusan->jumlahAhli, 0, ".", ",") ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>JUMLAH</th>
                        <th class="text-end"><?= number_format($jumlahKeseluruhanKelab, 0, ".", ",") ?></th>
                        <th class="text-end"><?= number_format($jumlahKeseluruhanSekolah, 0, ".", ",") ?></th>
                        <th class="text-end"><?= number_format($jumlahKeseluruhanAhli, 0, ".", ",") ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <?php if(!empty($senaraiRumusanParlimen)): ?>
    <div id="rumusanParlimen" class="mb-3">
        <h3 class="text-primary">RUMUSAN MENGIKUT PARLIMEN YANG BERSTATUS AKTIF</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">
                <thead>
                    <tr class="bg-warning text-dark">
                        <th>PARLIMEN</th>
                        <th class="text-center">JUMLAH KELAB</th>
                        <th class="text-center">JUMLAH SEKOLAH</th>
                        <th class="text-center">JUMLAH AHLI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $jumlahKeseluruhanKelab = 0;
                    $jumlahKeseluruhanSekolah = 0;
                    $jumlahKeseluruhanAhli = 0;
                    foreach($senaraiRumusanParlimen as $rumusan): 
                        $jumlahKeseluruhanKelab = $jumlahKeseluruhanKelab + $rumusan->jumlahKelab;
                        $jumlahKeseluruhanSekolah = $jumlahKeseluruhanSekolah + $rumusan->jumlahSekolah;
                        $jumlahKeseluruhanAhli = $jumlahKeseluruhanAhli + $rumusan->jumlahAhli;
                    ?>
                    <tr>
                        <td width="40%"><?= $rumusan->kategoriNama ?></td>
                        <td class="text-end"><?= number_format($rumusan->jumlahKelab, 0, ".", ",") ?></td>
                        <td class="text-end"><?= number_format($rumusan->jumlahSekolah, 0, ".", ",") ?></td>
                        <td class="text-end"><?= number_format($rumusan->jumlahAhli, 0, ".", ",") ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>JUMLAH</th>
                        <th class="text-end"><?= number_format($jumlahKeseluruhanKelab, 0, ".", ",") ?></th>
                        <th class="text-end"><?= number_format($jumlahKeseluruhanSekolah, 0, ".", ",") ?></th>
                        <th class="text-end"><?= number_format($jumlahKeseluruhanAhli, 0, ".", ",") ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <?php endif; ?>

    <?php if(!empty($senaraiRumusanDun)): ?>
    <div id="rumusanParlimen" class="mb-3">
        <h3 class="text-primary">RUMUSAN MENGIKUT DUN YANG BERSTATUS AKTIF</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">
                <thead>
                    <tr class="bg-warning text-dark">
                        <th>DUN</th>
                        <th class="text-center">JUMLAH KELAB</th>
                        <th class="text-center">JUMLAH SEKOLAH</th>
                        <th class="text-center">JUMLAH AHLI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $jumlahKeseluruhanKelab = 0;
                    $jumlahKeseluruhanSekolah = 0;
                    $jumlahKeseluruhanAhli = 0;
                    foreach($senaraiRumusanDun as $rumusan): 
                        $jumlahKeseluruhanKelab = $jumlahKeseluruhanKelab + $rumusan->jumlahKelab;
                        $jumlahKeseluruhanSekolah = $jumlahKeseluruhanSekolah + $rumusan->jumlahSekolah;
                        $jumlahKeseluruhanAhli = $jumlahKeseluruhanAhli + $rumusan->jumlahAhli;
                    ?>
                    <tr>
                        <td width="40%"><?= $rumusan->kategoriNama ?></td>
                        <td class="text-end"><?= number_format($rumusan->jumlahKelab, 0, ".", ",") ?></td>
                        <td class="text-end"><?= number_format($rumusan->jumlahSekolah, 0, ".", ",") ?></td>
                        <td class="text-end"><?= number_format($rumusan->jumlahAhli, 0, ".", ",") ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>JUMLAH</th>
                        <th class="text-end"><?= number_format($jumlahKeseluruhanKelab, 0, ".", ",") ?></th>
                        <th class="text-end"><?= number_format($jumlahKeseluruhanSekolah, 0, ".", ",") ?></th>
                        <th class="text-end"><?= number_format($jumlahKeseluruhanAhli, 0, ".", ",") ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <?php endif; ?>

    <hr>

    <h3 class="mb-0 text-primary">RUMUSAN AHLI KELAB MALAYSIAKU</h3>
    <p class="small text-muted mt-0"><em>Berdasarkan <strong>Pendaftaran Ahli Kelab Malaysiaku</strong>.</em></p>
    <div class="row g-3">
        <div class="col-12 col-lg-4 col-md-4 col-sm-6">
            <p class="text-center text-secondary">BILANGAN AHLI KELAB MENGIKUT UMUR (KELAB AKTIF)</p>
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-hover">
                    <thead>
                        <tr class="bg-secondary text-white">
                            <th class="text-center">UMUR</th>
                            <th class="text-center">BILANGAN AHLI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $jumlah = 0;
                        foreach($rumusanUmurAhli as $ru): 
                        $jumlah = $jumlah + $ru->kiraanUmur; 
                        ?>
                        <tr>
                            <td class="text-center"><?= $ru->umur ?></td>
                            <td class="text-center"><?= number_format($ru->kiraanUmur, 0, '.', ',') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center">JUMLAH</th>
                            <th class="text-center"><?= number_format($jumlah, 0, '.', ',') ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-md-4 col-sm-6">
            <p class="text-center text-secondary">BILANGAN AHLI KELAB MENGIKUT JANTINA (KELAB AKTIF)</p>
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-hover">
                    <thead>
                        <tr class="bg-info text-dark">
                            <th class="text-center">JANTINA</th>
                            <th class="text-center">BILANGAN AHLI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $jumlah = 0;
                        foreach($rumusanJantinaAhli as $rj): 
                        $jumlah = $jumlah + $rj->kiraanJantina; 
                        ?>
                        <tr>
                            <td class="text-center"><?= $rj->jantina ?></td>
                            <td class="text-center"><?= number_format($rj->kiraanJantina, 0, '.', ',') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center">JUMLAH</th>
                            <th class="text-center"><?= number_format($jumlah, 0, '.', ',') ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="col-12 col-lg-4 col-md-4 col-sm-6">
            <p class="text-center text-secondary">BILANGAN AHLI KELAB MENGIKUT KAUM (KELAB AKTIF)</p>
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-hover">
                    <thead>
                        <tr class="bg-success text-white">
                            <th class="text-center">KAUM</th>
                            <th class="text-center">BILANGAN AHLI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $jumlah = 0;
                        foreach($rumusanKaumAhli as $rk): 
                        $jumlah = $jumlah + $rk->kiraanKaum; 
                        ?>
                        <tr>
                            <td class="text-center"><?= $rk->kaum ?></td>
                            <td class="text-center"><?= number_format($rk->kiraanKaum, 0, '.', ',') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center">JUMLAH</th>
                            <th class="text-center"><?= number_format($jumlah, 0, '.', ',') ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

   </div>



    </section>


</main>


<?php $this->load->view($footer); ?>