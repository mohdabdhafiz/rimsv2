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
                <li class="breadcrumb-item"><a href="<?= site_url('konfigurasi') ?>">Konfigurasi</a></li>
                <li class="breadcrumb-item active">Senarai Tajuk Hebahan / Ceramah</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Senarai Tajuk Hebahan / Ceramah</h5>
            <span data-bs-toggle="modal" data-bs-target="#tambahModal">
                <button class="btn btn-outline-secondary shadow-sm mb-3" data-bs-toggle="tooltip" data-bs-placement="right" title="Tambah Maklumat">
                    <i class="bi bi-plus"></i>
                    Tambah Maklumat
                </button>
            </span>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tajuk Hebahan / Ceramah</th>
                            <th>Operasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($senaraiKandungan as $kandungan): ?>
                        <tr>
                            <td><?= $kandungan->senarai_kandungan_kandungan ?></td>
                            <td>
                                <div class="btn-group shadow-sm" role="group" aria-label="Senarai Operasi Kandungan">
                                    <a href="<?= site_url('konfigurasi/kandunganBil/'.$kandungan->senarai_kandungan_bil) ?>" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Maklumat Lanjut">
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                    <a href="<?= site_url('konfigurasi/kemaskiniSenaraiKandungan/'.$kandungan->senarai_kandungan_bil) ?>" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kemaskini Maklumat">
                                        <i class="bi bi-gear"></i>
                                    </a>
                                    <a href="<?= site_url('konfigurasi/confirmPadam/'.$kandungan->senarai_kandungan_bil) ?>" class="btn btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Padam Maklumat">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Tambah Tajuk Hebahan / Ceramah</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?= form_open('konfigurasi/tambahSenaraiKandungan') ?>
                      <div class="form-floating mb-3">
                        <input type="text" name="inputKandungan" id="inputKandungan" class="form-control" placeholder="Tajuk Hebahan / Ceramah">
                        <label for="inputKandungan" class="form-label">Tajuk Hebahan / Ceramah</label>
                      </div>
                    </div>
                    <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary shadow-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x-octagon"></i>
                        Batal
                      </button>
                      <button type="submit" class="btn btn-outline-primary shadow-sm">
                        <i class="bi bi-plus"></i>
                        Tambah
                      </button>
                        </form>
                    </div>
                  </div>
                </div>
              </div><!-- End Large Modal-->


    </section>

</main>


<?php $this->load->view('us_program_na/susunletak/bawah'); ?>