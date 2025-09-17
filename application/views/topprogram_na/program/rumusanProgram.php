<?php 
$this->load->view('us_program_na/susunletak/atas');
$this->load->view('us_program_na/susunletak/sidebar');
$this->load->view('us_program_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PROGRAM</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">Rumusan Program</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Senarai Rumusan Laporan Mengikut Penganjur</h1>
            <span class="text-secondary"><em>Senarai Rumusan Laporan Berstatus <?= $statusLaporan ?></em></span>
            <div class="table-responsive">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>BIL</th>
                            <th>NAMA ORGANISASI / PENGANJUR / URUS SETIA</th>
                            <th>BILANGAN LAPORAN</th>
                            <th>TINDAKAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1; foreach($senaraiProgram as $program): 
                            $senaraiProgram2 = $dataProgram->senaraiProgramPerananStatus($program->pengguna_peranan_bil, $statusLaporan);
                        ?>
                        <tr>
                            <td><?= $count++ ?></td>
                            <td><?= strtoupper($program->namaOrganisasi) ?></td>
                            <td><?= $program->bilanganLaporan ?></td>
                            <td>
                                
                            <span data-bs-toggle="modal" data-bs-target="#senarai<?= $program->pengguna_peranan_bil ?>">
                                    <button type="button" class="btn  btn-outline-primary shadow-sm" data-bs-toggle="tooltip" data-bs-original-title="Senarai Laporan <?= $program->namaOrganisasi ?>" data-bs-placement="bottom"><i class="bi bi-gear"></i></button>
                                </span>

                                <?php if(!empty($senaraiProgram2)): ?>
                                <div class="modal fade" id="senarai<?= $program->pengguna_peranan_bil ?>" tabindex="-1">
                <div class="modal-dialog modal-xl">
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
                                    <th>DAERAH</th>
                                    <th>PARLIMEN</th>
                                    <th>DUN</th>
                                    <th>TINDAKAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $count = 1;
                                foreach($senaraiProgram2 as $p): ?>
                                <tr>
                                    <td><?= $count++ ?></td>
                                    <td><?= $p->laporanBil ?></td>
                                    <td><?= $p->tarikhProgram ?></td>
                                    <td><?= strtoupper($p->namaProgram) ?></td>
                                    <td><?= strtoupper($p->namaDaerah) ?></td>
                                    <td><?= strtoupper($p->namaParlimen) ?></td>
                                    <td><?= strtoupper($p->namaDun) ?></td>
                                    <td>
                                        <a href="<?= site_url("program/bil/".$p->laporanBil) ?>" class="btn  btn-outline-primary shadow-sm">
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


<?php $this->load->view('us_program_na/susunletak/bawah'); ?>