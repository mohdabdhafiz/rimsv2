<?php 
$this->load->view('us_program_negeri_na/susunletak/atas');
$this->load->view('us_program_negeri_na/susunletak/sidebar');
$this->load->view('us_program_negeri_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@KOMUNITI</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('komuniti/bil/'.$komuniti->komuniti_bil) ?>"><?= $komuniti->komuniti_nama ?></a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="card-title">
                    <i class="bi bi-info-circle"></i>
                    Maklumat Am Komuniti
                </h1>
                <button type="button" class="btn btn-outline-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#am">
                    <i class="bi bi-gear"></i>
                    <span>Kemaskini</span>
                </button>
            </div>

            <dl class="row">

                <dt class="col-sm-3">Nombor Siri</dt>
                <dd class="col-sm-9"><?= strtoupper($komuniti->komuniti_bil) ?></dd>

                <dt class="col-sm-3">Nama</dt>
                <dd class="col-sm-9"><?= $komuniti->komuniti_nama ?></dd>

                <dt class="col-sm-3">Tarikh Penubuhan</dt>
                <dd class="col-sm-9"><?= $komuniti->komuniti_tarikh_penubuhan ?></dd>

                <dt class="col-sm-3">Negeri</dt>
                <dd class="col-sm-9"><?= $komuniti->nt_nama ?></dd>

                <?php if(!empty($komuniti->komuniti_daerah)): ?>
                <dt class="col-sm-3">Daerah</dt>
                <dd class="col-sm-9"><?= $komuniti->nama ?></dd>
                <?php endif; ?>

                <?php if(!empty($komuniti->komuniti_parlimen)): ?>
                <dt class="col-sm-3">Parlimen</dt>
                <dd class="col-sm-9"><?= $komuniti->pt_nama ?></dd>
                <?php endif; ?>

                <?php if(!empty($komuniti->komuniti_dun)): ?>
                <dt class="col-sm-3">DUN</dt>
                <dd class="col-sm-9"><?= $komuniti->dun_nama ?></dd>
                <?php endif; ?>

            </dl>

        </div>
    </div>

    <div class="modal fade" id="am" tabindex="-1">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">
                        <i class="bi bi-gear"></i>
                        Kemaskini Maklumat Am Komuniti
                    </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?= form_open('komuniti/prosesAm') ?>
                        <div class="form-floating mb-3">
                            <input type="text" name="inputNama" id="inputNama" class="form-control" value="<?= $komuniti->komuniti_nama ?>" required>
                            <label for="inputNama" class="form-label">1. Nama Komuniti:</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" name="inputTarikhPenubuhan" id="inputTarikhPenubuhan" value="<?= $komuniti->komuniti_tarikh_penubuhan ?>" class="form-control">
                            <label for="inputTarikhPenubuhan" class="form-label">2. Tarikh Penubuhan:</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select name="inputNegeriBil" id="inputNegeriBil" class="form-control">
                                <option value="<?= $komuniti->komuniti_negeri ?>" selected ><?= $komuniti->nt_nama ?></option>
                            </select>
                            <label for="inputNegeriBil" class="form-label">3. Negeri:</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select name="inputDaerahBil" id="inputDaerahBil" class="form-control">
                                <option value="" <?php if(empty($komuniti->komuniti_daerah)){ echo "selected"; } ?>>Sila Pilih..</option>
                                <?php foreach($senaraiDaerah as $daerah): ?>
                                <option value="<?= $daerah->bil ?>" <?php if($daerah->bil == $komuniti->komuniti_daerah){ echo "selected"; } ?>><?= $daerah->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="inputDaerahBil" class="form-label">4. Daerah:</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select name="inputParlimenBil" id="inputParlimenBil" class="form-control">
                                <option value="" <?php if(empty($komuniti->komuniti_parlimen)){ echo "selected"; } ?>>Sila Pilih..</option>
                                <?php foreach($senaraiParlimen as $parlimen): ?>
                                <option value="<?= $parlimen->pt_bil ?>" <?php if($parlimen->pt_bil == $komuniti->komuniti_parlimen){ echo "selected"; } ?>><?= $parlimen->pt_nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="inputParlimenBil" class="form-label">5. Parlimen:</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select name="inputDunBil" id="inputDunBil" class="form-control">
                                <option value="" <?php if(empty($komuniti->komuniti_dun)){ echo "selected"; } ?>>Sila Pilih..</option>
                                <?php foreach($senaraiDun as $dun): ?>
                                <option value="<?= $dun->dun_bil ?>" <?php if($dun->dun_bil == $komuniti->komuniti_dun){ echo "selected"; } ?>><?= $dun->dun_nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="inputDunBil" class="form-label">6. DUN:</label>
                        </div>
                    </div>
                    <input type="hidden" name="inputKomunitiBil" value="<?= $komuniti->komuniti_bil ?>">
                    <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary shadow-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x-octagon"></i>
                        Batal
                        </button>
                      <button type="submit" class="btn btn-outline-primary shadow-sm">
                      <i class="bi bi-save"></i>  
                      Simpan</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div><!-- End Extra Large Modal-->

              <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                  <h1 class="card-title">
                    <i class="bx bx-user-plus"></i>
                    Ahli <?= $komuniti->komuniti_nama ?>
                  </h1>
                  <div class="btn-group shadow-sm" role="group">
                    <a href="<?= site_url('komuniti/senaraiAhli/'.$komuniti->komuniti_bil) ?>" class="btn btn-outline-primary">
                    <i class="bi bi-archive"></i>
                    Senarai Ahli
                  </a>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#daftarAhli">
                    <i class="bx bx-user-plus"></i>
                      Pendaftaran Ahli</button>
                      </div>
                    </div>
                </div>
              </div>

              <div class="modal fade" id="daftarAhli" tabindex="-1">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">
                        <i class="bx bx-user-plus"></i>
                        Pendaftaran Ahli <?= $komuniti->komuniti_nama ?>
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <?= form_open('komuniti/daftarAhli') ?>
                      <div class="form-floating mb-3">
                        <input type="text" name="inputNama" id="inputNama" required placeholder="1. Nama Ahli" class="form-control">
                        <label for="inputNama" class="form-label">1. Nama Ahli</label>
                      </div>
                      <div class="form-floating mb-3">
                        <input type="text" name="inputJawatan" id="inputJawatan" placeholder="2. Jawatan / Pekerjaan" class="form-control">
                        <label for="inputJawatan" class="form-label">2. Jawatan / Pekerjaan</label>
                      </div>
                      <div class="form-floating mb-3">
                        <textarea name="inputAlamat" id="inputAlamat" cols="30" rows="10" class="form-control" placeholder="3. Alamat" style="height:100px;"></textarea>
                        <label for="inputAlamat" class="form-label">3. Alamat</label>
                      </div>
                      <div class="form-floating mb-3">
                        <input type="text" name="inputTelefon" id="inputTelefon" required placeholder="4. No. Telefon" class="form-control">
                        <label for="inputTelefon" class="form-label">4. No. Telefon</label>
                      </div>
                      <div class="form-floating mb-3">
                        <input type="text" name="inputEmel" id="inputEmel" placeholder="5. e-Mel" class="form-control">
                        <label for="inputEmel" class="form-label">5. e-Mel</label>
                      </div>
                      <div class="form-floating mb-3">
                        <input type="text" name="inputUmur" id="inputUmur" placeholder="6. Umur" class="form-control">
                        <label for="inputUmur" class="form-label">6. Umur</label>
                      </div>
                      <div class="form-floating mb-3">
                        <select name="inputJantina" id="inputJantina" class="form-control" required>
                          <option value="">Sila Pilih..</option>
                          <option value="Lelaki">Lelaki</option>
                          <option value="Perempuan">Perempuan</option>
                        </select>
                        <label for="inputJantina" class="form-label">7. Jantina</label>
                      </div>
                      <div class="form-floating mb-3">
                        <select name="inputKaum" id="inputKaum" class="form-control" required>
                          <option value="">Sila Pilih..</option>
                          <option value="Melayu">Melayu</option>
                          <option value="Cina">Cina</option>
                          <option value="India">India</option>
                          <option value="Bumiputera Islam Sabah (Lain-Lain Kaum)">Bumiputera Islam Sabah (Lain-Lain Kaum)</option>
                          <option value="Bumiputera Bukan Islam Sabah (Kadazan, Dusun, Murut)">Bumiputera Bukan Islam Sabah (Kadazan, Dusun, Murut)</option>
                          <option value="Iban">Iban</option>
                          <option value="Bidayuh">Bidayuh</option>
                          <option value="Melanau">Melanau</option>
                          <option value="Orang Ulu">Orang Ulu</option>
                          <option value="Orang Asli">Orang Asli</option>
                          <option value="Punjabi / Sikh">Punjabi / Sikh</option>
                          <option value="Lain-Lain Kaum">Lain-Lain Kaum</option>
                        </select>
                        <label for="inputKaum" class="form-label">8. Kaum</label>
                      </div>
                      <input type="hidden" name="inputKomuniti" value="<?= $komuniti->komuniti_bil ?>">
                      <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
                      
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-octagon"></i>
                        Batal</button>
                      <button type="submit" class="btn btn-outline-primary shadow-sm">
                        <i class="bx bx-user-plus"></i>
                        Daftar Ahli
                      </button>
                      </form>
                    </div>
                  </div>
                </div>
              </div><!-- End Extra Large Modal-->

<div class="card">
  <div class="card-body">
    <h1 class="card-title">
      <i class="bi bi-collection"></i>
      Penglibatan Program
    </h1>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>BIL</th>
            <th>NAMA PROGRAM</th>
            <th>TARIKH PROGRAM</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $count = 1;
          foreach($senaraiProgram as $program): ?>
          <tr>
            <td><?= $count++ ?></td>
            <td><a href="<?= site_url('program/bil/'.$program->program_bil) ?>"><?= $program->jt_nama ?></a></td>
            <td><?= $program->tarikhProgram ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

              <div class="alert alert-warning shadow">
                <h4 class="alert-heading">
                <i class="bi bi-trash"></i>
                PADAM MAKLUMAT <?= strtoupper($komuniti->komuniti_nama) ?></h4>
                <p>Saya ingin memadam maklumat bagi <?= $komuniti->komuniti_nama ?>.</p>
                <div class="text-end">
                <button type="button" class="btn btn-outline-danger shadow-sm" data-bs-toggle="modal" data-bs-target="#padamKomuniti">
                    <i class="bi bi-trash"></i>
                    Padam</button>
                </div>
              </div>

              <div class="modal fade" id="padamKomuniti" tabindex="-1">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">
                        <i class="bi bi-trash"></i>
                        Padam <?= $komuniti->komuniti_nama ?>
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <?= form_open('komuniti/padamKomuniti') ?>
                      <p>Anda pasti untuk memadam maklumat ini?</p>
                      <dl class="row">

                <dt class="col-sm-3">Nama</dt>
                <dd class="col-sm-9"><?= $komuniti->komuniti_nama ?></dd>

                <dt class="col-sm-3">Tarikh Penubuhan</dt>
                <dd class="col-sm-9"><?= $komuniti->komuniti_tarikh_penubuhan ?></dd>

                <dt class="col-sm-3">Negeri</dt>
                <dd class="col-sm-9"><?= $komuniti->nt_nama ?></dd>

                <?php if(!empty($komuniti->komuniti_daerah)): ?>
                <dt class="col-sm-3">Daerah</dt>
                <dd class="col-sm-9"><?= $komuniti->nama ?></dd>
                <?php endif; ?>

                <?php if(!empty($komuniti->komuniti_parlimen)): ?>
                <dt class="col-sm-3">Parlimen</dt>
                <dd class="col-sm-9"><?= $komuniti->pt_nama ?></dd>
                <?php endif; ?>

                <?php if(!empty($komuniti->komuniti_dun)): ?>
                <dt class="col-sm-3">DUN</dt>
                <dd class="col-sm-9"><?= $komuniti->dun_nama ?></dd>
                <?php endif; ?>

            </dl>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary shadow-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x-octagon"></i>
                        Batal
                        </button>
                        <input type="hidden" name="inputKomunitiBil" value="<?= $komuniti->komuniti_bil ?>">
                      <button type="submit" class="btn btn-danger shadow-sm">
                        <i class="bi bi-trash"></i>
                        PADAM
                      </button>
                        </form>
                    </div>
                  </div>
                </div>
              </div><!-- End Extra Large Modal-->

    </section>


</main>


<?php $this->load->view('us_program_negeri_na/susunletak/bawah'); ?>