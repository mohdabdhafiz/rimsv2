<?php 
$this->load->view('us_program_negeri_na/susunletak/atas');
$this->load->view('us_program_negeri_na/susunletak/sidebar');
$this->load->view('us_program_negeri_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PROGRAM</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">Senarai Pelaporan Program</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Rumusan Laporan - <?= $statusLaporan ?></h1>
            <span class="text-secondary"><em>Senarai Rumusan Laporan Berstatus <strong><?= $statusLaporan ?></strong> Mengikut Organisasi bagi <strong>Tahun <?= date("Y") ?></strong></em></span>
            <div class="table-responsive">
                <table class="table table-sm datatable">
                    <thead>
                        <tr>
                            <th>BIL</th>
                            <th>NAMA ORGANISASI</th>
                            <th>BILANGAN LAPORAN</th>
                            <th>TINDAKAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $count = 1;
                        foreach($senaraiRumusan as $r):
                            $senaraiProgram = $dataProgram->senaraiProgramPerananStatus($r->pengguna_peranan_bil, $statusLaporan);
                        ?>
                        <tr>
                            <td><?= $count++ ?></td>
                            <td><?= $r->jt_pejabat ?></td>
                            <td><?= $r->bilanganLaporan ?></td>
                            <td>
                                <span data-bs-toggle="modal" data-bs-target="#senarai<?= $r->pengguna_peranan_bil ?>">
                                    <button type="button" class="btn btn-sm btn-outline-primary shadow-sm" data-bs-toggle="tooltip" data-bs-original-title="Senarai Laporan <?= $r->jt_pejabat ?>" data-bs-placement="bottom"><i class="bi bi-gear"></i></button>
                                </span>

                                <?php if(!empty($senaraiProgram)): ?>
                                <div class="modal fade" id="senarai<?= $r->pengguna_peranan_bil ?>" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">
                        <i class="bi bi-receipt"></i>
                        Senarai Laporan Program</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="table-responsive">
                        <table class="table table-sm datatable">
                            <thead>
                                <tr>
                                    <th>BIL</th>
                                    <th>NOMBOR SIRI</th>
                                    <th>TARIKH PROGRAM</th>
                                    <th>NAMA PROGRAM</th>
                                    <th>PARLIMEN</th>
                                    <th>DUN</th>
                                    <th>TINDAKAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $count = 1;
                                foreach($senaraiProgram as $p): ?>
                                <tr>
                                    <td><?= $count++ ?></td>
                                    <td><?= $p->laporanBil ?></td>
                                    <td><?= $p->tarikhProgram ?></td>
                                    <td><?= $p->namaProgram ?></td>
                                    <td><?= $p->namaParlimen ?></td>
                                    <td><?= $p->namaDun ?></td>
                                    <td>
                                        <a href="<?= site_url("program/bil/".$p->laporanBil) ?>" class="btn btn-sm btn-outline-primary shadow-sm">
                                        <i class="bi bi-arrow-right-square"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-octagon"></i>
                        Tutup</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Large Modal-->
              <?php endif; ?>

                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>




</section>


</main>


<?php $this->load->view('us_program_negeri_na/susunletak/bawah'); ?>