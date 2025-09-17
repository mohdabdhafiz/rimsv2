<?php 
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/sidebar');
$this->load->view('ppd_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@KELABMALAYSIAKU</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url('kelabmalaysiaku/bil/'.$kelabmalaysiaku->kelabmalaysiaku_bil) ?>"><?= $kelabmalaysiaku->kelabmalaysiaku_nama ?></a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="card-title">
                    <i class="bi bi-info-circle"></i>
                    Maklumat Am Kelab Malaysiaku
                </h1>
                <span data-bs-toggle="modal" data-bs-target="#am">
                <button type="button" class="btn btn-outline-primary shadow-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Kemaskini Maklumat">
                    <i class="bi bi-gear"></i>
                </button>
                </span>
            </div>

            <dl class="row">

                <dt class="col-sm-3">Nama</dt>
                <dd class="col-sm-9"><?= $kelabmalaysiaku->kelabmalaysiaku_nama ?></dd>

                <dt class="col-sm-3">Tarikh Penubuhan</dt>
                <dd class="col-sm-9"><?= $kelabmalaysiaku->kelabmalaysiaku_tarikh_penubuhan ?></dd>

                <dt class="col-sm-3">Negeri</dt>
                <dd class="col-sm-9"><?= $kelabmalaysiaku->nt_nama ?></dd>

                <?php if(!empty($kelabmalaysiaku->kelabmalaysiaku_daerah)): ?>
                <dt class="col-sm-3">Daerah</dt>
                <dd class="col-sm-9"><?= $kelabmalaysiaku->nama ?></dd>
                <?php endif; ?>

                <?php if(!empty($kelabmalaysiaku->kelabmalaysiaku_parlimen)): ?>
                <dt class="col-sm-3">Parlimen</dt>
                <dd class="col-sm-9"><?= $kelabmalaysiaku->pt_nama ?></dd>
                <?php endif; ?>

                <?php if(!empty($kelabmalaysiaku->kelabmalaysiaku_dun)): ?>
                <dt class="col-sm-3">DUN</dt>
                <dd class="col-sm-9"><?= $kelabmalaysiaku->dun_nama ?></dd>
                <?php endif; ?>
                
                <?php if(!empty($kelabmalaysiaku->kelabmalaysiaku_sekolah)): ?>
                <dt class="col-sm-3">Nama Sekolah</dt>
                <dd class="col-sm-9"><?= $kelabmalaysiaku->kelabmalaysiaku_sekolah ?></dd>
                <?php endif; ?>

                <?php if(!empty($kelabmalaysiaku->kelabmalaysiaku_jenis_sekolah)): ?>
                <dt class="col-sm-3">Jenis Sekolah</dt>
                <dd class="col-sm-9"><?= $kelabmalaysiaku->kelabmalaysiaku_jenis_sekolah ?></dd>
                <?php endif; ?>

                <?php if(!empty($kelabmalaysiaku->kelabmalaysiaku_guru_penyelaras)): ?>
                <dt class="col-sm-3">Guru Penyelaras</dt>
                <dd class="col-sm-9"><?= $kelabmalaysiaku->kelabmalaysiaku_guru_penyelaras ?></dd>
                <?php endif; ?>

                <?php if(!empty($kelabmalaysiaku->kelabmalaysiaku_jumlah_ahli)): ?>
                <dt class="col-sm-3">Jumlah Ahli Kelab</dt>
                <dd class="col-sm-9"><?= number_format($kelabmalaysiaku->kelabmalaysiaku_jumlah_ahli, 0, '.', ',') ?></dd>
                <?php endif; ?>

                <?php if(!empty($kelabmalaysiaku->kelabmalaysiaku_status_aktif)): ?>
                <dt class="col-sm-3">Status Keaktifan Kelab</dt>
                <dd class="col-sm-9"><?= $kelabmalaysiaku->kelabmalaysiaku_status_aktif ?></dd>
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
                        Kemaskini Maklumat Am Kelab Malaysiaku
                    </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?= form_open('kelabmalaysiaku/prosesAm') ?>
                        <div class="form-floating mb-3">
                            <input type="text" name="inputNama" id="inputNama" class="form-control" value="<?= $kelabmalaysiaku->kelabmalaysiaku_nama ?>" required>
                            <label for="inputNama" class="form-label">1. Nama Kelab Malaysiaku:</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" name="inputTarikhPenubuhan" id="inputTarikhPenubuhan" value="<?= $kelabmalaysiaku->kelabmalaysiaku_tarikh_penubuhan ?>" class="form-control">
                            <label for="inputTarikhPenubuhan" class="form-label">2. Tarikh Penubuhan:</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select name="inputNegeriBil" id="inputNegeriBil" class="form-control">
                                <option value="<?= $kelabmalaysiaku->kelabmalaysiaku_negeri ?>" selected ><?= $kelabmalaysiaku->nt_nama ?></option>
                            </select>
                            <label for="inputNegeriBil" class="form-label">3. Negeri:</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select name="inputDaerahBil" id="inputDaerahBil" class="form-control">
                                <option value="" <?php if(empty($kelabmalaysiaku->kelabmalaysiaku_daerah)){ echo "selected"; } ?>>Sila Pilih..</option>
                                <?php foreach($senaraiDaerah as $daerah): ?>
                                <option value="<?= $daerah->bil ?>" <?php if($daerah->bil == $kelabmalaysiaku->kelabmalaysiaku_daerah){ echo "selected"; } ?>><?= $daerah->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="inputDaerahBil" class="form-label">4. Daerah:</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select name="inputParlimenBil" id="inputParlimenBil" class="form-control">
                                <option value="" <?php if(empty($kelabmalaysiaku->kelabmalaysiaku_parlimen)){ echo "selected"; } ?>>Sila Pilih..</option>
                                <?php foreach($senaraiParlimen as $parlimen): ?>
                                <option value="<?= $parlimen->pt_bil ?>" <?php if($parlimen->pt_bil == $kelabmalaysiaku->kelabmalaysiaku_parlimen){ echo "selected"; } ?>><?= $parlimen->pt_nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="inputParlimenBil" class="form-label">5. Parlimen:</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select name="inputDunBil" id="inputDunBil" class="form-control">
                                <option value="" <?php if(empty($kelabmalaysiaku->kelabmalaysiaku_dun)){ echo "selected"; } ?>>Sila Pilih..</option>
                                <?php foreach($senaraiDun as $dun): ?>
                                <option value="<?= $dun->dun_bil ?>" <?php if($dun->dun_bil == $kelabmalaysiaku->kelabmalaysiaku_dun){ echo "selected"; } ?>><?= $dun->dun_nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="inputDunBil" class="form-label">6. DUN:</label>
                        </div>
                        <div class="form-floating mb-3">
                          <input type="text" name="inputNamaSekolah" id="inputNamaSekolah" placeholder="7. Nama Sekolah" value="<?= $kelabmalaysiaku->kelabmalaysiaku_sekolah ?>" class="form-control">
                          <label for="inputNamaSekolah" class="form-label">7. Nama Sekolah</label>
                        </div>
                        <div class="form-floating mb-3">
                          <input type="text" name="inputJenisSekolah" id="inputJenisSekolah" placeholder="8. Jenis Sekolah" value="<?= $kelabmalaysiaku->kelabmalaysiaku_jenis_sekolah ?>" class="form-control">
                          <label for="inputJenisSekolah" class="form-label">8. Jenis Sekolah</label>
                        </div>
                        <div class="form-floating mb-3">
                          <input type="text" name="inputNamaGuru" id="inputNamaGuru" placeholder="9. Nama Guru Penyelaras" value="<?= $kelabmalaysiaku->kelabmalaysiaku_guru_penyelaras ?>" class="form-control">
                          <label for="inputNamaGuru" class="form-label">9. Nama Guru Penyelaras</label>
                        </div>
                        <div class="form-floating mb-3">
                          <input type="text" name="inputJumlahAhli" id="inputJumlahAhli" placeholder="10. Jumlah Ahli Kelab" value="<?= $kelabmalaysiaku->kelabmalaysiaku_jumlah_ahli ?>" class="form-control">
                          <label for="inputJumlahAhli" class="form-label">10. Jumlah Ahli Kelab</label>
                        </div>
                        <div class="form-floating mb-3">
                          <select name="inputStatusKelab" id="inputStatusKelab" class="form-control" required>
                            <option value="" <?php if($kelabmalaysiaku->kelabmalaysiaku_status_aktif == ""){ echo "selected"; } ?>>Sila Pilih..</option>
                            <option value="Aktif" <?php if($kelabmalaysiaku->kelabmalaysiaku_status_aktif == "Aktif"){ echo "selected"; } ?>>Aktif</option>
                            <option value="Tidak Aktif" <?php if($kelabmalaysiaku->kelabmalaysiaku_status_aktif == "Tidak Aktif"){ echo "selected"; } ?>>Tidak Aktif</option>
                          </select>
                          <label for="inputStatusKelab" class="form-label">11. Status Keaktifan Kelab</label>
                        </div>
                    </div>
                    <input type="hidden" name="inputKelabmalaysiakuBil" value="<?= $kelabmalaysiaku->kelabmalaysiaku_bil ?>">
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
                    Ahli <?= $kelabmalaysiaku->kelabmalaysiaku_nama ?>
                  </h1>
                  <div class="btn-group shadow-sm" role="group">
                    <a href="<?= site_url('kelabmalaysiaku/senaraiAhli/'.$kelabmalaysiaku->kelabmalaysiaku_bil) ?>" class="btn btn-outline-primary">
                    <i class="bi bi-archive"></i>
                    Senarai Ahli
                  </a>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#daftarAhli">
                    <i class="bx bx-user-plus"></i>
                      Pendaftaran Ahli</button>
                      </div>
                    </div>
                    <div class="row g-3 mt-3">
                      <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                <div class="table-responsive">
                  <h4 class="text-center"><i class="bi bi-person"></i>
                  Bilangan Ahli Mengikut Umur</h4>
                  <table class="table table-sm">
                    <thead>
                      <tr>
                        <th class="text-center">Umur</th>
                        <th class="text-center"><i class="bi bi-person"></i></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($senaraiUmur as $u): ?>
                      <tr>
                        <td class="text-center"><?= $u->umur ?></td>
                        <td class="text-center"><?= $u->bilanganAhli ?></td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
                </div>

                <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                  <div class="table-responsive">
                    <h4 class="text-center"><i class="bi bi-person"></i>
                    Bilangan Ahli Mengikut Jantina</h4>
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th class="text-center">Jantina</th>
                          <th class="text-center"><i class="bi bi-person"></i></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($senaraiJantina as $j): ?>
                        <tr>
                          <td class="text-center"><?= $j->jantina ?></td>
                          <td class="text-center"><?= $j->bilanganAhli ?></td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                  <div class="table-responsive">
                    <h4 class="text-center"><i class="bi bi-person"></i>
                    Bilangan Ahli Mengikut Kaum</h4>
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th class="text-center">Kaum</th>
                          <th class="text-center"><i class="bi bi-person"></i></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($senaraiKaum as $k): ?>
                        <tr>
                          <td class="text-center"><?= $k->kaum ?></td>
                          <td class="text-center"><?= $k->bilanganAhli ?></td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                  <div class="table-responsive">
                    <h4 class="text-center"><i class="bi bi-person"></i>
                    Bilangan Ahli Mengikut Tingkatan</h4>
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th class="text-center">Tingkatan</th>
                          <th class="text-center"><i class="bi bi-person"></i></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($senaraiTingkatan as $t): ?>
                        <tr>
                          <td class="text-center"><?= $t->tingkatan ?></td>
                          <td class="text-center"><?= $t->bilanganAhli ?></td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="col-12">
                  <div class="d-flex justify-content-center align-item-center">
                    <div class="p-3 text-center">
                      <h2 class="display-2"><?= count($senaraiAhli) ?></h2>
                      <p><i class="bi bi-person"></i>
                      Bilangan Ahli Yang Berdaftar (Orang)</p>
                    </div>
                  </div>
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
                        Pendaftaran Ahli <?= $kelabmalaysiaku->kelabmalaysiaku_nama ?>
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <?= form_open('kelabmalaysiaku/daftarAhli') ?>
                      <div class="form-floating mb-3">
                        <input type="text" name="inputNama" id="inputNama" required placeholder="1. Nama Ahli" class="form-control">
                        <label for="inputNama" class="form-label">1. Nama Ahli</label>
                      </div>
                      <div class="form-floating mb-3">
                        <input type="text" name="inputJawatan" id="inputJawatan" placeholder="2. Jawatan Dalam Kelab" class="form-control">
                        <label for="inputJawatan" class="form-label">2. Jawatan Dalam Kelab</label>
                      </div>
                      <div class="form-floating mb-3">
                        <textarea name="inputAlamat" id="inputAlamat" cols="30" rows="10" class="form-control" placeholder="3. Alamat" style="height:100px;"></textarea>
                        <label for="inputAlamat" class="form-label">3. Alamat Surat-Menyurat</label>
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
                        <input type="text" name="inputTingkatan" id="inputTingkatan" placeholder="7. Tingkatan" class="form-control">
                        <label for="inputTingkatan" class="form-label">7. Tingkatan</label>
                      </div>
                      <div class="form-floating mb-3">
                        <select name="inputJantina" id="inputJantina" class="form-control" required>
                          <option value="">Sila Pilih..</option>
                          <option value="Lelaki">Lelaki</option>
                          <option value="Perempuan">Perempuan</option>
                        </select>
                        <label for="inputJantina" class="form-label">8. Jantina</label>
                      </div>
                      <div class="form-floating mb-3">
                        <select name="inputKaum" id="inputKaum" class="form-control" required>
                          <option value="">Sila Pilih..</option>
                          <option value="Melayu">Melayu</option>
                          <option value="Cina">Cina</option>
                          <option value="India">India</option>
                          <option value="Lain-Lain Kaum">Lain-Lain Kaum</option>
                        </select>
                        <label for="inputKaum" class="form-label">9. Kaum</label>
                      </div>
                      <input type="hidden" name="inputKelabmalaysiaku" value="<?= $kelabmalaysiaku->kelabmalaysiaku_bil ?>">
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

<?php if(!empty($senaraiProgram)): ?>
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
<?php endif; ?>

              <div class="alert alert-warning shadow">
                <h4 class="alert-heading">
                <i class="bi bi-trash"></i>
                PADAM MAKLUMAT <?= strtoupper($kelabmalaysiaku->kelabmalaysiaku_nama) ?></h4>
                <p>Saya ingin memadam maklumat bagi <?= $kelabmalaysiaku->kelabmalaysiaku_nama ?>.</p>
                <div class="text-end">
                <button type="button" class="btn btn-outline-danger shadow-sm" data-bs-toggle="modal" data-bs-target="#padamKelabmalaysiaku">
                    <i class="bi bi-trash"></i>
                    Padam</button>
                </div>
              </div>

              <div class="modal fade" id="padamKelabmalaysiaku" tabindex="-1">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">
                        <i class="bi bi-trash"></i>
                        Padam <?= $kelabmalaysiaku->kelabmalaysiaku_nama ?>
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <?= form_open('kelabmalaysiaku/padamKelabmalaysiaku') ?>
                      <p>Anda pasti untuk memadam maklumat ini?</p>
                      <dl class="row">

                <dt class="col-sm-3">Nama</dt>
                <dd class="col-sm-9"><?= $kelabmalaysiaku->kelabmalaysiaku_nama ?></dd>

                <dt class="col-sm-3">Tarikh Penubuhan</dt>
                <dd class="col-sm-9"><?= $kelabmalaysiaku->kelabmalaysiaku_tarikh_penubuhan ?></dd>

                <dt class="col-sm-3">Negeri</dt>
                <dd class="col-sm-9"><?= $kelabmalaysiaku->nt_nama ?></dd>

                <?php if(!empty($kelabmalaysiaku->kelabmalaysiaku_daerah)): ?>
                <dt class="col-sm-3">Daerah</dt>
                <dd class="col-sm-9"><?= $kelabmalaysiaku->nama ?></dd>
                <?php endif; ?>

                <?php if(!empty($kelabmalaysiaku->kelabmalaysiaku_parlimen)): ?>
                <dt class="col-sm-3">Parlimen</dt>
                <dd class="col-sm-9"><?= $kelabmalaysiaku->pt_nama ?></dd>
                <?php endif; ?>

                <?php if(!empty($kelabmalaysiaku->kelabmalaysiaku_dun)): ?>
                <dt class="col-sm-3">DUN</dt>
                <dd class="col-sm-9"><?= $kelabmalaysiaku->dun_nama ?></dd>
                <?php endif; ?>

            </dl>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary shadow-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x-octagon"></i>
                        Batal
                        </button>
                        <input type="hidden" name="inputKelabmalaysiakuBil" value="<?= $kelabmalaysiaku->kelabmalaysiaku_bil ?>">
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


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>