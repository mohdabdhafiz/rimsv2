<?php 
$this->load->view('negeri_na/susunletak/atas');
$this->load->view('negeri_na/susunletak/sidebar');
$this->load->view('negeri_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PENGGUNA</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('pengguna/pertukaran') ?>">Proses Pertukaran Pegawai</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">


    <div class="card">
        <div class="card-body">
            <h1 class="card-title">
            <i class="bi bi-people"></i>    
            Senarai Pegawai</h1>
            <p>Sila pilih pegawai yang akan ditukarkan keluar.</p>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>BIL</th>
                            <th>NAMA PENGGUNA</th>
                            <th>JAWATAN</th>
                            <th>TEMPAT BERTUGAS</th>
                            <th>NOMBOR TELEFON</th>
                            <th>OPERASI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $count = 1;
                        foreach($senaraiPegawai as $pegawai): ?>
                        <tr>
                            <td><?= $count++ ?></td>
                            <td><?= strtoupper($pegawai->nama_penuh) ?></td>
                            <td><?= strtoupper($pegawai->pekerjaan) ?></td>
                            <td><?= strtoupper($pegawai->pengguna_tempat_tugas) ?></td>
                            <td><?= $pegawai->no_tel ?></td>
                            <td><button type="button" class="btn btn-outline-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#tukar<?= $pegawai->bil ?>">
                            <i class="bi bi-arrow-repeat"></i>    
                            Tukar</button></td>
                        </tr>
                        <div class="modal fade" id="tukar<?= $pegawai->bil ?>" tabindex="-1">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">
                        <i class="bi bi-arrow-repeat"></i>
                        Pertukaran <?= $pegawai->nama_penuh ?>
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Anda pasti untuk membuat perubahan kepada data pegawai <?= $pegawai->nama_penuh ?>?
                    </div>
                    <?= form_open('pengguna/tamat_peranan') ?>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary shadow-sm" data-bs-dismiss="modal">BATAL</button>
                      
                      <input type="hidden" name="inputPenggunaBil" value="<?= $pegawai->bil ?>">
                      <button type="submit" class="btn btn-warning shadow-sm">
                        <i class="bi bi-arrow-repeat"></i>
                        TUKAR
                      </button>
                        
                    </div>
                    </form>
                  </div>
                </div>
              </div><!-- End Extra Large Modal-->
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    </section>


</main>


<?php $this->load->view('negeri_na/susunletak/bawah'); ?>