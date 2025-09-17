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
                <li class="breadcrumb-item active">Senarai Tugas Daerah</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">
        <?php $this->load->view('urusetia_na/peranan/nav'); ?>

        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="card-title">Daerah</h1>
                    <a href="<?= site_url('peranan/tambahPenugasanManual') ?>" class="btn btn-outline-primary shadow-sm">Menetapkan Tugas Daerah</a>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-sm datatable">
                        <thead>
                            <tr>
                                <th>Nama Peranan</th>
                                <th>Daerah</th>
                                <th>Operasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($senaraiTugasDaerah as $stn): ?>
                            <tr>
                                <td><?= $stn->peranan_nama ?></td>
                                <td><?= $stn->nama ?></td>
                                <td>

                                    <!-- Modal -->
              <button type="button" class="btn btn-danger shadow-sm" data-bs-toggle="modal" data-bs-target="#padamPeranan<?= $stn->bil ?>">
                Padam
              </button>

              <div class="modal fade" id="padamPeranan<?= $stn->bil ?>" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Padam Maklumat Tugasan Peranan Mengikut Daerah</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <?= form_open('peranan/padamTugasDaerah') ?>
                    <div class="modal-body">
                        <div class="d-flex justify-content-center">
                            <div class="p-3">
                                <p>Anda pasti untuk <span class="text-danger"><strong>MEMADAM MAKLUMAT</strong></span> ini?</p>
                                <p>
                                    <strong>Nama Peranan:</strong><br>
                                    <?= $stn->peranan_nama ?>
                                </p>
                                <p>
                                    <strong>Tugasan Daerah:</strong><br>
                                    <?= $stn->nama ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary shadow-sm" data-bs-dismiss="modal">Batal</button>
                      <input type="hidden" name="inputTugasanBil" value="<?= $stn->bil ?>">
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