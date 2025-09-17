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
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item">Konfigurasi RIMS</li>
                <li class="breadcrumb-item active">Senarai Tugas Parlimen</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">
        <?php $this->load->view('urusetia_na/peranan/nav'); ?>

        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="card-title">Parlimen</h1>
                    <a href="<?= site_url('peranan/tambahPenugasanManual') ?>" class="btn btn-outline-primary shadow-sm">Menetapkan Tugas Parlimen</a>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-sm datatable">
                        <thead>
                            <tr>
                                <th>Nama Peranan</th>
                                <th>Parlimen</th>
                                <th>Operasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($senaraiTugasParlimen as $stn): ?>
                            <tr>
                                <td><?= $stn->peranan_nama ?></td>
                                <td><?= $stn->pt_nama ?></td>
                                <td>

                                    <!-- Modal -->
              <button type="button" class="btn btn-danger shadow-sm" data-bs-toggle="modal" data-bs-target="#padamPeranan<?= $stn->tpt_bil ?>">
                Padam
              </button>

              <div class="modal fade" id="padamPeranan<?= $stn->tpt_bil ?>" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Padam Maklumat Tugasan Peranan Mengikut Parlimen</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <?= form_open('peranan/padamTugasParlimen') ?>
                    <div class="modal-body">
                        <div class="d-flex justify-content-center">
                            <div class="p-3">
                                <p>Anda pasti untuk <span class="text-danger"><strong>MEMADAM MAKLUMAT</strong></span> ini?</p>
                                <p>
                                    <strong>Nama Peranan:</strong><br>
                                    <?= $stn->peranan_nama ?>
                                </p>
                                <p>
                                    <strong>Tugasan Parlimen:</strong><br>
                                    <?= $stn->pt_nama ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary shadow-sm" data-bs-dismiss="modal">Batal</button>
                      <input type="hidden" name="inputTugasanBil" value="<?= $stn->tpt_bil ?>">
                      <button type="submit" class="btn btn-danger shadow-sm">Padam</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div><!-- End Modal-->

              

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


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>