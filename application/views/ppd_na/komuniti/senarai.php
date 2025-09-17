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
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('komuniti/senarai') ?>">Senarai Komuniti</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">
                <div class="d-flex justify-content-between align-items-center">
                <div class="">
                <i class="bi bi-view-list"></i>
                Senarai Komuniti
                </div>
            </h1>
            <?php if(!empty($senaraiKomuniti)): ?>
            <div class="table-responsive">
                <table class="table table-hovered table-bordered datatable">
                    <thead>
                        <tr>
                            <th>NOMBOR SIRI</th>
                            <th>NAMA</th>
                            <th>TARIKH PENUBUHAN</th>
                            <th>NEGERI</th>
                            <th>DAERAH</th>
                            <th>PARLIMEN</th>
                            <th>DUN</th>
                            <th>PELAPOR</th>
                            <th>TARIKH DATA ENTRI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($senaraiKomuniti as $komuniti): ?>
                        <tr>
                            <td><?= $komuniti->komuniti_bil ?></td>
                            <td><a href="<?= site_url('komuniti/bil/'.$komuniti->komuniti_bil) ?>"><?= strtoupper($komuniti->komuniti_nama) ?></a></td>
                            <td><?= $komuniti->komuniti_tarikh_penubuhan ?></td>
                            <td><?= strtoupper($komuniti->nt_nama) ?></td>
                            <td><?= strtoupper($komuniti->nama) ?></td>
                            <td><?= strtoupper($komuniti->pt_nama) ?></td>
                            <td><?= strtoupper($komuniti->dun_nama) ?></td>
                            <td><?= strtoupper($komuniti->nama_penuh) ?></td>
                            <td><?= $komuniti->komuniti_pengguna_waktu ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
            <?php if(empty($senaraiKomuniti)): ?>
                <div class="alert alert-warning">
                    <h1 class="alert-heading">Nota:</h1>
                    <span>Tiada Komuniti didaftarkan. <a href="<?= site_url('komuniti/daftar') ?>">Pendaftaran di sini</a>.</span>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="modal fade" id="carian" tabindex="-1">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">
                        <i class="bi bi-search"></i>
                        Carian Komuniti
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4>Carian:</h4>
                    <?= form_open('komuniti/carian') ?>
                <div class="row g-3">
                    <div class="col-12 col-lg-4 col-md-6 col-sm-12">
                        <div class="form-floating">
                            <input type="text" name="inputNama" id="inputNama" class="form-control" placeholder="1. Nama Komuniti">
                            <label for="inputNama" class="form-label">1. Nama Komuniti</label>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-md-6 col-sm-12">
                        <div class="form-floating">
                            <input type="date" name="inputTarikhPenubuhan" id="inputTarikhPenubuhan" placeholder="2. Tarikh Penubuhan" class="form-control">
                            <label for="inputTarikhPenubuhan" class="form-label">2. Tarikh Penubuhan</label>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-md-6 col-sm-12">
                        <div class="form-floating">
                            <select name="inputNegeri" id="inputNegeri" class="form-control">
                                <?php foreach($senaraiNegeri as $negeri): ?>
                                <option value="<?= $negeri->nt_bil ?>"><?= $negeri->nt_nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="inputNegeri" class="form-label">3. Senarai Negeri</label>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-md-6 col-sm-12">
                        <div class="form-floating">
                            <select name="inputDaerah" id="inputDaerah" class="form-control">
                                <option value="">Sila Pilih</option>
                                <?php foreach($senaraiDaerah as $daerah): ?>
                                    <option value="<?= $daerah->bil ?>"><?= $daerah->nt_nama ?> - <?= $daerah->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="inputDaerah" class="form-label">4. Senarai Daerah</label>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-md-6 col-sm-12">
                        <div class="form-floating">
                            <select name="inputParlimen" id="inputParlimen" class="form-control">
                                <option value="">Sila Pilih</option>
                                <?php foreach($senaraiParlimen as $parlimen): ?>
                                    <option value="<?= $parlimen->pt_bil ?>"><?= $parlimen->nt_nama ?> - <?= $parlimen->pt_nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="inputParlimen" class="form-label">5. Senarai Parlimen</label>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-md-6 col-sm-12">
                        <div class="form-floating">
                            <select name="inputDun" id="inputDun" class="form-control">
                                <option value="">Sila Pilih</option>
                                <?php foreach($senaraiDun as $dun): ?>
                                    <option value="<?= $dun->dun_bil ?>"><?= $dun->nt_nama ?> - <?= $dun->dun_nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="inputDun" class="form-label">6. Senarai DUN</label>
                        </div>
                    </div>
                </div>
                
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary shadow-sm" data-bs-dismiss="modal">
                      <i class="bi bi-x-octagon"></i>  
                      Batal</button>
                      <button type="submit" class="btn btn-outline-primary shadow-sm"><i class="bi bi-search"></i>
                            Cari</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div><!-- End Extra Large Modal-->


    </section>


</main>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>