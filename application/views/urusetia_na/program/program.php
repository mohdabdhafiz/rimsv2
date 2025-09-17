<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PROGRAM</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('program') ?>">Laman</a></li>
                <li class="breadcrumb-item active">Maklumat Program</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">


<?php
$bolehEdit = TRUE;
$bolehPadam = TRUE; 
foreach($senaraiProgram as $program): ?>

  <?php 
    $st = strtoupper($program->program_status);
    if(strpos($st, 'DRAF') !== FALSE): ?>
  <div class="card">
    <div class="card-body">
      <div class="card-title">
        <i class="bi bi-receipt"></i>
        Penghantaran Laporan</div>
      <p>Saya sudah membuat semakan bersama penyelia saya untuk menghantar laporan ini kepada Bahagian Perkhidmatan Komunikasi (BPKPM), Jabatan Penerangan Malaysia (JaPen) tanpa ragu-ragu dan prejudis terhadap data yang telah disediakan.</p>
      <button type="button" class="btn btn-outline-primary shadow-sm"  data-bs-toggle="modal" data-bs-target="#hantarLaporan">
      <i class="bi bi-reply"></i>
        Hantar</button>
    </div>
  </div>

  <div class="modal fade" id="hantarLaporan" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">
                        <i class="bi bi-receipt"></i>
                        Penghantaran Laporan</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>Anda pasti untuk menghantar laporan ini?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-octagon"></i>
                        Tutup</button>
                      <?= form_open('program/hantarLaporan') ?>
                        <input type="hidden" name="inputProgramBil" value="<?= $program->program_bil ?>">
                        <button type="submit" class="btn btn-outline-primary shadow-sm">
                        <i class="bi bi-reply"></i>
                          Hantar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div><!-- End Large Modal-->

  <?php endif; ?>

  <?php if(strpos($st, 'DRAF') !== FALSE): ?>
  <div class="card">
    <div class="card-body">
      <div class="card-title text-danger">
        <i class="bi bi-x-circle"></i>
        Pembatalan Laporan</div>
        <h4>Tindakan untuk pembatalan laporan:</h4>
        <ol>
          <li>Hubungi pelapor dan buat pemberitahuan rasmi.</li>
          <li>Hubungi urus setia negeri dan buat pemberitahuan rasmi.</li>
          <li>Hubungi urus setia BPKPM dan buat pemberitahuan rasmi.</li>
          <li>Sila ikuti kesemua tindakan-tindakan yang telah dinyatakan.</li>
          <li>Sekiranya tindakan-tindakan ini telah dipenuhi, barulah boleh untuk teruskan pembatalan laporan ini.</li>
        </ol>
      <button type="button" class="btn btn-outline-danger shadow-sm"  data-bs-toggle="modal" data-bs-target="#batalLaporan">
      <i class="bi bi-x-circle"></i>
        Batal</button>
    </div>
  </div>

  <div class="modal fade" id="batalLaporan" tabindex="-1">
                <div class="modal-dialog modal-large">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">
                        <i class="bi bi-x-circle"></i>
                        Pembatalan Laporan</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <?= form_open('program/batalLaporan') ?>
                        <div class="form-floating mb-3">
                          <textarea name="inputJustifikasi" id="inputJustifikasi" cols="30" rows="10" class="form-control" style="height:100px;" required></textarea>
                          <label for="inputJustifikasi" class="form-label">Justifikasi Pembatalan Laporan</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-octagon"></i>
                        Tutup</button>
                        <input type="hidden" name="inputProgramBil" value="<?= $program->program_bil ?>">
                        <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
                        <button type="submit" class="btn btn-outline-danger shadow-sm">
                        <i class="bi bi-x-circle"></i>
                          Batal</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div><!-- End Large Modal-->

  <div class="card" id='a'>
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <h5 class="card-title">
          <i class="bi bi-card-heading"></i>
          Bahagian A - Maklumat Am Program</h5>
        <div class="btn-group shadow-sm">
        <!-- Large Modal -->
        <?php if($bolehEdit): ?>
        <span data-bs-toggle="modal" data-bs-target="#kemaskiniA">
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Kemaskini Program">
          <i class="bi bi-gear"></i>
        </button>
        </span>  
        <?php endif; ?>
        <?php if($bolehPadam): ?>
        <span data-bs-toggle="modal" data-bs-target="#padamProgram">
        <button type="button" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Padam Maklumat Program">
          <i class="bi bi-trash"></i>
        </button>      
        </span> 
        <?php endif; ?>
        </div> 
      </div>
      <div class="row g-3">
      <p class="col-12">
        <span class="small"><strong>Status Laporan:</strong></span> <span class="text-danger"><strong><?= $program->program_status ?></strong></span>
      </p>
      <p class="col-12 col-lg-6">
        <span class="small"><strong>Nama Pelapor:</strong></span>
        <br><?= $program->nama_penuh ?>, <?= $program->program_no_telefon ?>
      </p>
      <p class="col-12 col-lg-6">
                <span class="small"><strong>Nama Program:</strong></span><br>
                <?php echo $program->jt_nama; ?>
            </p>
            <p class="col-12 col-lg-6"><span class="small"><strong>Tarikh Program:</strong></span><br>
            <?php echo date_format(date_create($program->program_tarikh_masa), "d.m.Y"); ?></p>
            <p class="col-12 col-lg-6"><span class="small"><strong>Masa Program:</strong></span><br> 
            <?php echo date_format(date_create($program->program_tarikh_masa), "h:i a"); ?></p>
            <p class="col-12 col-lg-3"><span class="small"><strong>Negeri:</strong></span>
              <br><?= $program->nt_nama ?>
            </p>
            <p class="col-12 col-lg-3"><span class="small"><strong>Daerah:</strong></span>
              <br><?= $program->nama ?>
            </p>
            <p class="col-12 col-lg-3"><span class="small"><strong>Parlimen:</strong></span>
              <br><?= $program->pt_nama ?>
            </p>
            <p class="col-12 col-lg-3">
              <span class="small"><strong>DUN:</strong></span>
              <br><?= $program->dun_nama ?>
            </p>
            <p class="col-12 col-lg-4">
              <span class="small"><strong>Perasmi:</strong></span>
              <br><?= $program->program_perasmi ?>
            </p>
            <p class="col-12 col-lg-4"><span class="small"><strong>Bilangan Khalayak:</strong></span>
      <br><?= number_format($program->program_khalayak, 0, '', ',') ?> orang
    </p>
            <p class="col-12 col-lg-4">
              <span class="small"><strong>Tarikh Laporan Dikemaskini:</strong></span>
              <br><?= $program->program_pengguna_waktu ?>
            </p>
            </div>
  </div>
</div>

<?php 
    $st = strtoupper($program->program_status);
    if($bolehEdit): ?>
<div class="modal fade" id="kemaskiniA" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">
                        <i class="bi bi-gear"></i>
                        Kemaskini Maklumat Am Program</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <?= form_open('program/prosesKemaskiniA') ?>
                      <?php $bilanganSoalan = 1; ?>

<div class="form-floating mb-3">
  <select name="inputPelapor" id="inputPelapor" class="form-control" required>
    <option value="" <?php if($program->program_pelapor == ""){ echo "selected"; } ?>>Sila pilih..</option>
    <?php foreach($senaraiPelapor as $pelapor): ?>
    <option value="<?= $pelapor->bil ?>" <?php if($program->program_pelapor == $pelapor->bil){ echo "selected"; } ?>><?= $pelapor->nama_penuh ?></option>
    <?php endforeach; ?>
  </select>
  <label for="inputPelapor" class="form-label">Nama Pegawai Pelapor: <span style="color:red;">*</span></label>
</div>



<div class="form-control mb-3">
  <p class="form-label">Program: <span style="color:red;">*</span></p>
  <?php foreach($senaraiJenis as $jenisProgram): ?>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="inputJenisProgram" id="inputJenisProgram<?= $jenisProgram->jt_bil ?>" value="<?= $jenisProgram->jt_bil ?>" <?php if($program->jt_bil == $jenisProgram->jt_bil){ echo "checked"; } ?> required>
    <label class="form-check-label" for="inputJenisProgram<?= $jenisProgram->jt_bil ?>">
      <?= $jenisProgram->jt_nama ?>
    </label>
  </div>
  <?php endforeach; ?>
</div>

<?php if(!empty($senaraiNegeri)): ?>
    <div class="form-floating mb-3">
        <select name="inputNegeri" id="inputNegeri" class="form-control" required>
          <option value="" <?php if($program->program_negeri == ""){ echo 'selected'; } ?>>Sila pilih..</option>
            <?php foreach($senaraiNegeri as $negeri): ?>
                <option value="<?= $negeri->nt_bil ?>" <?php if($negeri->nt_bil == $program->program_negeri){ echo 'selected'; } ?>><?= $negeri->nt_nama ?></option>
            <?php endforeach; ?>
        </select>
        <label for="inputNegeri" class="form-label">Pilih Negeri: <span style="color:red;">*</span></label>
    </div>
    <?php endif; ?>

    <?php if(!empty($senaraiDaerah)): ?>
    <div class="form-floating mb-3">
        <select name="inputDaerah" id="inputDaerah" class="form-control" required>
          <option value="" <?php if($program->program_daerah == ""){ echo 'selected'; } ?>>Sila pilih..</option>
            <?php foreach($senaraiDaerah as $daerah): 
                $negeriBil = $daerah->negeri_bil; ?>
                <option value="<?= $daerah->bil ?>" <?php if($daerah->bil == $program->program_daerah){ echo 'selected'; } ?>><?= $daerah->nt_nama ?> - <?= $daerah->nama ?></option>
            <?php endforeach; ?>
        </select>
        <label for="inputDaerah" class="form-label">Pilih Daerah: <span style="color:red;">*</span></label>
    </div>
    <?php endif; ?>

    <?php if(!empty($senaraiParlimen)): ?>
    <div class="form-floating mb-3">
        <select name="inputParlimen" id="inputParlimen" class="form-control">
            <option value="" <?php if($program->program_parlimen == ""){ echo 'selected'; } ?>>Sila pilih..</option>
            <?php foreach($senaraiParlimen as $parlimen): ?>
                <option value="<?= $parlimen->pt_bil ?>" <?php if($parlimen->pt_bil == $program->program_parlimen){ echo 'selected'; } ?> ><?= $parlimen->pt_negeri ?> - <?= $parlimen->pt_nama ?></option>
            <?php endforeach; ?>
        </select>
        <label for="inputParlimen" class="form-label">Pilih Parlimen:</label>
    </div>
    <?php endif; ?>

    <?php if(!empty($senaraiDun)): ?>
        <div class="form-floating mb-3">
            <select name="inputDun" id="inputDun" class="form-control">
                <option value="" <?php if($program->program_dun == ''){ echo 'selected'; } ?>>Sila pilih..</option>
                <?php foreach($senaraiDun as $dun): ?>
                    <option value="<?= $dun->dun_bil ?>" <?php if($dun->dun_bil == $program->program_dun){ echo 'selected'; } ?>><?= $dun->dun_negeri ?> - <?= $dun->dun_nama ?></option>
                <?php endforeach; ?>
            </select>
            <label for="inputDun" class="form-label">Pilih DUN:</label>
        </div>
    <?php endif; ?>
  
  <div class="form-floating mb-3">
    <input type="datetime-local" class="form-control" id="inputMasa" name = "inputMasa" value = "<?= $program->program_tarikh_masa ?>">
    <label for="inputMasa" class="form-label">Tarikh dan Masa Program: <span style="color:red;">*</span></label>
  </div>

  <div class="form-floating mb-3">
    <input type="text" name="inputPerasmi" id="inputPerasmi" value="<?= $program->program_perasmi ?>" placeholder="Perasmi:" class="form-control">
    <label for="inputPerasmi" class="form-label">Perasmi:</label>
  </div>

  <div class="form-floating mb-3">
    <input type="text" name="inputKhalayak" id="inputKhalayak" class="form-control" value="<?= $program->program_khalayak ?>">
    <label for="inputKhalayak" class="form-label">Jumlah Khalayak:</label>
  </div>

  <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
  <input type="hidden" name="inputPerananBil" value="<?= $pengguna->pengguna_peranan_bil ?>">
  <input type="hidden" name="inputProgramBil" value="<?= $program->program_bil ?>">
  <input type="hidden" name="inputStatus" value="<?= $program->program_status ?>">
<div class="text-center">
</div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary shadow-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x-octagon"></i>
                        Batal</button>
                      <button type="submit" class="btn btn-outline-primary shadow-sm">
                      <i class="bi bi-save"></i>
                        Simpan</button>
                    </div>
                  </div>
                </div>
</form>
              </div><!-- End Large Modal-->
              <?php endif; ?>

              <?php if($bolehPadam): ?>

              <div class="modal fade" id="padamProgram" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Padam Maklumat Program</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <?= form_open('program/prosesPadamProgram') ?>
                      <p>Adakah anda pasti untuk memadam maklumat ini?</p>
                      <p>Kesan memadam maklumat ini adalah seperti berikut:</p>
                      <ol>
                        <li>Maklumat program dipadam secara seluruh.</li>
                        <li>Lokasi program dipadam.</li>
                        <li>OBP yang disenaraikan akan dikeluarkan daripada senarai. Tiada perubahan berlaku pada maklumat OBP yang sedia ada.</li>
                        <li>Gambar juga akan dipadam daripada pangkalan data. Sila pastikan untuk menyimpan gambar-gambar dalam bentuk secara lokal.</li>
                        <li>Pautan media sosial juga akan dipadam.</li>
                        <li>Status log laporan juga akan dipadam.</li>
                        <li>Pemadaman maklumat-maklumat lain hanya mengikut program ini sahaja.</li>
                        <li>Sila hubungi urus setia untuk bantuan dalam perkara ini.</li>
                      </ol>
                      <div class="mb-3">
                        <input type="checkbox" name="inputSetuju" id="inputSetuju" value="Setuju">
                        <label for="inputSetuju" class="form-label">Saya sedar dan yakin bahawa maklumat ini perlu dipadam.</label>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <input type="hidden" name="inputProgramBil" value="<?= $program->program_bil ?>">
                      <button type="button" class="btn btn-secondary shadow-sm" data-bs-dismiss="modal">Tidak</button>
                      <button type="submit" class="btn btn-danger shadow-sm">Ya</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div><!-- End Small Modal-->
<?php endif; ?>

<div class="card" id="b">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
    <h1 class="card-title">
      <i class="bi bi-card-heading"></i>
      Bahagian B - Tajuk Hebahan / Ceramah Program
    </h1>
    <?php if($bolehEdit): ?>
    <span data-bs-toggle="modal" data-bs-target="#tambahKandungan">
    <button type="button" class="btn btn-outline-primary shadow-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Kemaskini Tajuk Hebahan / Ceramah Program">
      <i class="bi bi-gear"></i>
    </button>
    </span>
    <?php endif; ?>
    </div>
    <?php if(!empty($senaraiTajuk)): ?>
    <ol>
      <?php foreach($senaraiTajuk as $tajuk): ?>
      <li><?= $tajuk->kandungan_program_kandungan ?></li>
      <?php endforeach; ?>
    </ol>
    <?php endif; ?>
    <?php if(count($senaraiTajuk) <= 0): ?>
      <div class="alert alert-warning">
        TIADA TAJUK HEBAHAN / CERAMAH PROGRAM.
      </div>
    <?php endif; ?>
  </div>
</div>

<?php if($bolehEdit): ?>
<div class="modal fade" id="tambahKandungan" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">
                        <i class="bi bi-gear"></i>
                        Kemaskini Tajuk Hebahan / Ceramah Program
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      
                      <table class="table table-bordered table-sm">
                              <tr>
                                <th>Tajuk Hebahan / Ceramah Program</th>
                                <th>Tindakan</th>
                              </tr>
                          <?php foreach($senaraiKandungan as $kandungan): ?>
                              <tr>
                                <td><?= $kandungan->senarai_kandungan_kandungan ?></td>
                                <td>
                                  <?= form_open('program/tambahKandunganProgram') ?>
                                  <input type="hidden" name="inputKandungan" value="<?= $kandungan->senarai_kandungan_kandungan ?>">
                                  <input type="hidden" name="inputStatus" value="<?= $program->program_status ?>">
                                  <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
                                  <input type="hidden" name="inputProgram" value="<?= $program->program_bil ?>">
                                  <button type="submit" class="btn btn-sm btn-outline-primary shadow-sm">
                                    <i class="bi bi-plus"></i>
                                  </button>
                                </form>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                              <tr>
                                <?= form_open('program/tambahKandunganProgram') ?>
                                <input type="hidden" name="inputProgram" value="<?= $program->program_bil ?>">
                                  <input type="hidden" name="inputStatus" value="<?= $program->program_status ?>">
                                  <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
                                  <td>
                                    <div class="form-floating">
                                      <input type="text" name="inputKandungan" id="inputKandungan" class="form-control" placeholder="Lain-Lain Tajuk:" required>
                                      <label for="inputKandungan" class="form-label">Lain-Lain Tajuk:</label>
                                    </div>
                                  </td>
                                  <td>
                                    <button type="submit" class="btn btn-sm btn-outline-primary shadow-sm">
                                      <i class="bi bi-plus"></i>
                                    </button>
                                  </td>
                                </form>
                              </tr>
                            </table>
                      <?php if(!empty($senaraiTajuk)): ?>
                      <hr>
                      <h5>Senarai Tajuk Hebahan / Ceramah Program</h5>
                      <ol>
                        <?php foreach($senaraiTajuk as $tajuk): ?>
                        <li>
                          <?= form_open('program/padamKandunganProgram') ?>
                              <input type="hidden" name="inputKandunganBil" value="<?= $tajuk->kandungan_program_bil ?>">
                              <input type="hidden" name="inputTajuk" value="<?= $tajuk->kandungan_program_kandungan ?>">
                              <input type="hidden" name="inputProgramBil" value="<?= $program->program_bil ?>">
                              <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
                              <input type="hidden" name="inputStatus" value="<?= $program->program_status ?>">
                              <div class="d-flex justify-content-between align-items-center">
                                <span><?= $tajuk->kandungan_program_kandungan ?></span>
                                <button type="submit" class="btn btn-outline-danger shadow-sm btn-sm">
                                  <i class="bi bi-trash"></i>
                                </button>
                              </div>
                          </form>
                            
                        </li>
                        <?php endforeach; ?>
                      </ol>
                      <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary shadow-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x-octagon"></i>
                        Batal
                      </button>
                    </div>
                  </div>
                </div>
              </div><!-- End Large Modal-->
              <?php endif; ?>

              <div class="card" id="c">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
    <h1 class="card-title">
      <i class="bi bi-card-heading"></i>
      Bahagian C - Pengisian Program
    </h1>
    <?php if($bolehEdit): ?>
    <span data-bs-toggle="modal" data-bs-target="#tambahpengisian">
    <button type="button" class="btn btn-outline-primary shadow-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Kemaskini Pengisian Program">
      <i class="bi bi-gear"></i>
    </button>
    </span>
    <?php endif; ?>
    </div>
    <?php if(!empty($senaraiPengisian)): ?>
    <ol>
      <?php foreach($senaraiPengisian as $tajuk): ?>
      <li><?= $tajuk->pengisian_program_pengisian ?></li>
      <?php endforeach; ?>
    </ol>
    <?php endif; ?>
    <?php if(count($senaraiPengisian) <= 0): ?>
      <div class="alert alert-warning">
        TIADA PENGISIAN PROGRAM.
      </div>
    <?php endif; ?>
  </div>
</div>

<?php if($bolehEdit): ?>
<div class="modal fade" id="tambahpengisian" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">
                        <i class="bi bi-gear"></i>
                        Kemaskini Pengisian Program
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      
                      <table class="table table-bordered table-sm mt-2">
                              <tr>
                                <th>Pengisian Program</th>
                                <th>Tindakan</th>
                              </tr>
                          <?php foreach($senaraiPengisianProgram as $pengisian): ?>
                              <tr>
                                <td><?= $pengisian->senarai_pengisian_pengisian ?></td>
                                <td>
                                  <?= form_open('program/tambahpengisianProgram') ?>
                                  <input type="hidden" name="inputpengisian" value="<?= $pengisian->senarai_pengisian_pengisian ?>">
                                  <input type="hidden" name="inputStatus" value="<?= $program->program_status ?>">
                                  <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
                                  <input type="hidden" name="inputProgram" value="<?= $program->program_bil ?>">
                                  <button type="submit" class="btn btn-sm btn-outline-primary shadow-sm">
                                    <i class="bi bi-plus"></i>
                                  </button>
                                </form>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                              <?= form_open('program/tambahpengisianProgram') ?>
                              <tr>
                                <td>
                                  <input type="hidden" name="inputProgram" value="<?= $program->program_bil ?>">
                                  <input type="hidden" name="inputStatus" value="<?= $program->program_status ?>">
                                  <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
                                  <div class="form-floating">
                                    <input type="text" name="inputpengisian" id="inputpengisian" class="form-control" placeholder="Lain-Lain Pengisian Program:" required>
                                    <label for="inputpengisian" class="form-label">Lain-Lain Pengisian Program:</label>
                                  </div>
                                </td>
                                <td>
                                  <button type="submit" class="btn btn-sm btn-outline-primary shadow-sm">
                                    <i class="bi bi-plus"></i>
                                  </button>
                                </td>
                              </tr>
                            </table>
                      </form>
                      <?php if(!empty($senaraiPengisian)): ?>
                      <hr>
                      <h5>Senarai Pengisian Program</h5>
                      <ol>
                        <?php foreach($senaraiPengisian as $tajuk): ?>
                        <li>
                          <?= form_open('program/padampengisianProgram') ?>
                              <input type="hidden" name="inputpengisianBil" value="<?= $tajuk->pengisian_program_bil ?>">
                              <input type="hidden" name="inputTajuk" value="<?= $tajuk->pengisian_program_pengisian ?>">
                              <input type="hidden" name="inputProgramBil" value="<?= $program->program_bil ?>">
                              <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
                              <input type="hidden" name="inputStatus" value="<?= $program->program_status ?>">
                              <div class="d-flex justify-content-between align-items-center">
                                <span><?= $tajuk->pengisian_program_pengisian ?></span>
                                <button type="submit" class="btn btn-outline-danger shadow-sm btn-sm">
                                  <i class="bi bi-trash"></i>
                                </button>
                              </div>
                          </form>
                        </li>
                        <?php endforeach; ?>
                      </ol>
                      <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary shadow-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x-octagon"></i>
                        Batal
                      </button>
                    </div>
                  </div>
                </div>
              </div><!-- End Large Modal-->
<?php endif; ?>

<div class="card" id='d'>
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
      <h5 class="card-title">
        <i class="bi bi-card-heading"></i>
        Bahagian D - Lokasi Program</h5>
        <?php if($bolehEdit): ?>
      <span data-bs-toggle="modal" data-bs-target="#kemaskiniB">
      <button class="btn btn-outline-primary shadow-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Kemaskini Lokasi Program">
        <i class="bi bi-gear"></i>
      </button>
      </span>
      <?php endif; ?>
    </div>
    <?php if(count($senaraiLokasi) > 0): ?>
      <ol>
        <?php foreach($senaraiLokasi as $lokasi): ?>
          <li><?= $lokasi->lokasi_program_lokasi ?></li>
        <?php endforeach; ?>
      </ol>
      <?php endif; ?>
      <?php if(count($senaraiLokasi) <= 0): ?>
      <div class="alert alert-warning">
        TIADA LOKASI PROGRAM DIDAFTARKAN.
      </div>
      <?php endif; ?>
    
      </div>

</div>

<?php if($bolehEdit): ?>
<div class="modal fade" id="kemaskiniB" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">
                        <i class="bi bi-gear"></i>
                        Kemaskini Lokasi Program</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <?= form_open('program/tambahLokasiProgram') ?>
                      <div class="form-floating mb-3">
                        <input class="form-control" id="inputLokasi" name = "inputLokasi" placeholder="Masukkan Lokasi Program" required>
                        <label for="inputLokasi" class="form-label">Lokasi Program: <span style="color:red;">*</span></label>
                      </div>
                      
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputLatitude" name = "inputLatitude" placeholder="Masukkan Latitude Lokasi">
                        <label for="inputLatitude" class="form-label">Latitude Lokasi:</label>
                      </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputLongitude" name = "inputLongitude" placeholder="Masukkan Longitude Lokasi">
                        <label for="inputLongitude" class="form-label">Longitude Lokasi:</label>
                      </div>
                      <div class="mb-3">
                        <input type="hidden" name="inputProgramBil" value="<?= $program->program_bil ?>">
                        <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
                        <button type="submit" class="btn btn-outline-primary shadow-sm">
                        <i class="bi bi-plus-circle"></i>  
                        Tambah Lokasi</button>
                      </div>
                    </form>
                    <?php
                    if(count($senaraiLokasi) > 0):
                    ?>
                    <hr>
                    <h5>Senarai Lokasi</h5>
                    <div class="table-responsive">
                      <table class="table table-sm table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>NAMA LOKASI</th>
                            <th>LATITUDE</th>
                            <th>LONGITUDE</th>
                            <th>OPERASI</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($senaraiLokasi as $lokasi): ?>
                          <tr>
                            <td><?= $lokasi->lokasi_program_lokasi ?></td>
                            <td><?= $lokasi->lokasi_program_latitude ?></td>
                            <td><?= $lokasi->lokasi_program_longitude ?></td>
                            <td>
                              <?= form_open('program/padamLokasi') ?>
                              <input type="hidden" name="inputLokasiBil" value="<?= $lokasi->lokasi_program_bil ?>">
                              <input type="hidden" name="inputProgramBil" value="<?= $program->program_bil ?>">
                              <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
                              <button type="submit" class="btn btn-outline-danger shadow-sm btn-sm"><i class="bi bi-trash"></i></button>
                              </form>
                            </td>
                          </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                    <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary shadow-sm" data-bs-dismiss="modal">
                      <i class="bi bi-x-octagon"></i>  
                      Tutup</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Large Modal-->
<?php endif; ?>

<!-- E - KOMUNITI -->

<div class="card" id="e">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
      <h1 class="card-title">
        <i class="bi bi-card-heading"></i>
        Bahagian E - Penglibatan Komuniti
      </h1>
      <?php if($bolehEdit): ?>
      <span data-bs-toggle="modal" data-bs-target="#penglibatanKomuniti">
      <button type="button" class="btn btn-outline-primary shadow-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Kemaskini Penglibatan Komuniti">
      <i class="bi bi-plus-circle"></i>  
      </span>
      <?php endif; ?>
    </div>
    <?php if(!empty($senaraiKomuniti)): ?>
      <table class="table table-sm table-bordered">
        <thead>
          <tr>
            <th>BIL</th>
            <th>KOMUNITI</th>
            <th>BILANGAN ORANG</th>
          </tr>
        </thead>
        <tbody>
          <?php $count = 1;
          foreach($senaraiKomuniti as $komuniti): ?>
          <tr>
            <td><?= $count++ ?></td>
            <td><a href="<?= site_url('komuniti/bil/'.$komuniti->komuniti_bil) ?>"><?= $komuniti->komuniti_nama ?></a></td>
            <td><?= $komuniti->komuniti_program_bilangan_kehadiran ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
    <?php if(count($senaraiKomuniti) <= 0): ?>
      <div class="alert alert-warning">
        TIADA PENGLIBATAN KOMUNITI.
      </div>
    <?php endif; ?>
  </div>
</div>

<?php if($bolehEdit): ?>
<div class="modal fade" id="penglibatanKomuniti" tabindex="-1">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">
                        <i class="bi bi-plus-circle"></i>
                        Tambah Penglibatan Komuniti
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <?= form_open('program/prosesKomuniti') ?>
                      <p>Tiada dalam senarai? Klik di <a href="<?= site_url('komuniti/daftar') ?>">SINI</a></p>
                      <div class="table-responsive">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th>PILIH</th>
                              <th>BIL</th>
                              <th>NAMA KOMUNITI</th>
                              <th>BILANGAN KEHADIRAN</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            $bk = array();
                            foreach($senaraiPilihanKomuniti as $komuniti){
                              $bk[$komuniti->komuniti_bil] = 0;
                            }
                            foreach($senaraiPilihanKomuniti as $komuniti): ?>
                            <tr>
                              <td>
                              <?php 
                              $ada = FALSE;
                              foreach($senaraiKomuniti as $ak){
                                if($ak->komuniti_program_komuniti == $komuniti->komuniti_bil){
                                  $ada = TRUE;
                                  $bk[$ak->komuniti_program_komuniti] = $ak->komuniti_program_bilangan_kehadiran;
                                }
                              }
                              ?>
                              <input type="checkbox" name="inputKomuniti[]" id="inputKomuniti[]" value="<?= $komuniti->komuniti_bil ?>" <?php if($ada){ echo "checked"; } ?>></td>
                              <td><?= $komuniti->komuniti_bil ?></td>
                              <td><?= $komuniti->komuniti_nama ?></td>
                              <td>
                                <input type="number" name="inputKehadiran[]" id="inputKehadiran[]" class="form-control" value="<?= $bk[$komuniti->komuniti_bil] ?>">  
                              </td>
                            </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary shadow-sm" data-bs-dismiss="modal">
                      <i class="bi bi-x-octagon"></i>  
                      Batal</button>
                      <input type="hidden" name="inputProgram" value="<?= $program->program_bil ?>">
                      <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
                      <button type="submit" class="btn btn-outline-primary shadow-sm">
                        <i class="bi bi-plus-circle"></i>
                        Tambah</button>
                    </div>
                            </form>
                  </div>
                </div>
              </div><!-- End Extra Large Modal-->
<?php endif; ?>

<!-- F - OBP -->
<div class="card" id="f">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <h1 class="card-title">
          <i class="bi bi-card-heading"></i>
          Bahagian F - Senarai OBP</h1>
          <?php if($bolehEdit): ?>
          <span data-bs-toggle="modal" data-bs-target="#kemaskiniC">
        <button class="btn btn-outline-primary shadow-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Kemaskini Senarai OBP">
          <i class="bi bi-gear"></i>
        </button>
        </span>
        <?php endif; ?>
      </div>
    <?php if(!empty($senaraiObp)): ?>
      <ol>
        <?php foreach($senaraiObp as $o): ?>
        <li>
          <?= $o->obp_program_nama ?>
          <br> <?= $o->obp_program_jawatan ?>
        </li>
        <?php endforeach; ?>
      </ol>
    <?php endif; ?>
    <?php if(empty($senaraiObp)): ?>
      <div class="alert alert-warning">
        TIADA PENGLIBATAN OBP.
      </div>
    <?php endif; ?>

    </div>
  </div>

<?php if($bolehEdit): ?>
  <div class="modal fade" id="kemaskiniC" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Kemaskini Senarai OBP</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <?= form_open('program/kemaskiniObp') ?>
                    <div class="modal-body">
                      <div class="d-flex justify-content-between align-items-center">
                        <h3>Senarai OBP</h3>
                        <a href="<?= site_url('obp/tambah') ?>" class="btn btn-sm btn-outline-secondary shadow-sm">Tambah OBP</a>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>PILIH</th>
                              <th>NAMA</th>
                              <th>JAWATAN</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $count = 0; foreach($senaraiPeranan as $peranan):
                               $listObp = $dataObp->obpProgram($peranan->peranan_bil, $program->program_negeri, $program->program_daerah, $program->program_parlimen, $program->program_dun);
                               if(!empty($listObp)):
                                foreach($listObp as $o):
                                  $ada = FALSE;
                                  foreach($senaraiObp as $obpJoin){
                                    if($obpJoin->obp_program_obp == $o->obp_id){
                                      $ada = TRUE;
                                    }
                                  }

                               ?>
                            <tr>
                              <td><input type="checkbox" name="inputObp[]" id="inputObpBil_<?= $count++ ?>" value="<?= $o->obp_id ?>" <?php if($ada){ echo "checked"; } ?>></td>
                              <td><?= $o->obp_nama ?></td>
                              <td><?= $o->obp_jawatan ?></td>
                            </tr>
                            <?php 
                                endforeach;
                              endif;
                            endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary shadow-sm" data-bs-dismiss="modal">Tutup</button>
                      <input type="hidden" name="inputProgramBil" value="<?= $program->program_bil ?>">
                      <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
                      <button type="submit" class="btn btn-outline-primary shadow-sm">Simpan</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div><!-- End Large Modal-->
              <?php endif; ?>

              <!-- G - KELAB MALAYSIAKU -->

<div class="card" id="g">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
      <h1 class="card-title">
        <i class="bi bi-card-heading"></i>
        Bahagian G - Penglibatan Kelab Malaysiaku
      </h1>
      <?php if($bolehEdit): ?>
      <span data-bs-toggle="modal" data-bs-target="#penglibatanKelab">
      <button type="button" class="btn btn-outline-primary shadow-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Kemaskini Penglibatan Kelab Malaysiaku">
      <i class="bi bi-plus-circle"></i>  
      </span>
      <?php endif; ?>
    </div>
    <?php if(!empty($senaraiMaklumatTambahanKelabMalaysiaku)): ?>
    <h5>Maklumat Am Tambahan Bagi Program Melibatkan Kelab Malaysiaku</h5>
    <div class="row g-3 mb-3">
      <div class="col-12 col-lg-3 col-md-6 col-sm-12">
        <p>
          <strong>Peringkat Pelaksanaan</strong>
          <br><?= $senaraiMaklumatTambahanKelabMalaysiaku->mtpk_peringkat ?>
        </p>
        <p>
          <strong>Mod Pelaksanaan</strong>
          <br><?= $senaraiMaklumatTambahanKelabMalaysiaku->mtpk_mod_pelaksanaan ?>
        </p>
      </div>
      <div class="col-12 col-lg-3 col-md-6 col-sm-12">
        <p>
          <strong>Bilangan Murid Lelaki</strong>
          <br><?= $senaraiMaklumatTambahanKelabMalaysiaku->mtpk_murid_lelaki ?>
        </p>
        <p>
          <strong>Bilangan Murid Perempuan</strong>
          <br><?= $senaraiMaklumatTambahanKelabMalaysiaku->mtpk_murid_perempuan ?>
        </p>
      </div>
      <?php if(!empty($senaraiKaumKelabMalaysiaku)): ?>
      <div class="col-12 col-lg-3 col-md-6 col-sm-12">
        <?php foreach($senaraiKaumKelabMalaysiaku as $skkm): ?>
        <p>
          <strong>Bilangan Kaum <?= $skkm->mkpk_kaum ?></strong>
          <br><?= $skkm->mkpk_bilangan_murid ?>
        </p>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
      <div class="col-12 col-lg-3 col-md-6 col-sm-12">
        <p>
          <strong>Jumlah Keseluruhan Penyertaan Murid</strong>
          <br><?= $senaraiMaklumatTambahanKelabMalaysiaku->mtpk_jumlah_murid ?>
        </p>
        <p>
          <strong>Jumlah Keseluruhan Penyertaan Guru</strong>
          <br><?= $senaraiMaklumatTambahanKelabMalaysiaku->mtpk_jumlah_guru ?>
        </p>
      </div>
    </div>
    <?php endif; ?>
    <?php if(!empty($senaraiKelab)): ?>
      <hr>
    <h5>Senarai Penglibatan Kelab Malaysiaku</h5>
      <ol>
        <?php  foreach($senaraiKelab as $kelab): ?>
          <li><a href="<?= site_url('kelabmalaysiaku/bil/'.$kelab->kelabmalaysiaku_bil) ?>"><?= $kelab->kelabmalaysiaku_nama ?></a></li>
        <?php endforeach; ?>
      </ol>
    <?php endif; ?>
    <?php if(empty($senaraiKelab)): ?>
      <div class="alert alert-warning">
        TIADA PENGLIBATAN KELAB MALAYSIAKU.
      </div>
    <?php endif; ?>
  </div>
</div>

<?php if($bolehEdit): ?>
<div class="modal fade" id="penglibatanKelab" tabindex="-1">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">
                        <i class="bi bi-gear"></i>
                        Kemaskini Penglibatan Kelab
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <?php
                      $tempMtpk = array(
                        'peringkat' => '',
                        'modPelaksanaan' => '',
                        'jumlahMuridLelaki' => '',
                        'jumlahMuridPerempuan' => '',
                        'jumlahMurid' => '',
                        'jumlahGuru' => ''
                      );
                      if(!empty($senaraiMaklumatTambahanKelabMalaysiaku)){
                        $tempMtpk = array(
                          'peringkat' => $senaraiMaklumatTambahanKelabMalaysiaku->mtpk_peringkat,
                          'modPelaksanaan' => $senaraiMaklumatTambahanKelabMalaysiaku->mtpk_mod_pelaksanaan,
                          'jumlahMuridLelaki' => $senaraiMaklumatTambahanKelabMalaysiaku->mtpk_murid_lelaki,
                          'jumlahMuridPerempuan' => $senaraiMaklumatTambahanKelabMalaysiaku->mtpk_murid_perempuan,
                          'jumlahMurid' => $senaraiMaklumatTambahanKelabMalaysiaku->mtpk_jumlah_murid,
                          'jumlahGuru' => $senaraiMaklumatTambahanKelabMalaysiaku->mtpk_jumlah_guru
                        );
                      }
                      ?>
                      <?= form_open('program/prosesKelab') ?>
                      <p>Tiada dalam senarai? Klik di <a href="<?= site_url('kelabmalaysiaku/daftar') ?>">SINI</a></p>
                      <div class="row g-3 mb-3">
                        <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                      <div class="form-floating">
                        <select name="inputPeringkat" id="inputPeringkat" class="form-control" required>
                          <option value="" <?php if($tempMtpk['peringkat'] == ''){ echo "selected"; } ?>>Sila Pilih..</option>
                          <option value="Kebangsaan" <?php if($tempMtpk['peringkat'] == 'Kebangsaan'){ echo "selected"; } ?>>Kebangsaan</option>
                          <option value="Negeri" <?php if($tempMtpk['peringkat'] == 'Negeri'){ echo "selected"; } ?>>Negeri</option>
                          <option value="Daerah" <?php if($tempMtpk['peringkat'] == 'Daerah'){ echo "selected"; } ?>>Daerah</option>
                          <option value="Sekolah" <?php if($tempMtpk['peringkat'] == 'Sekolah'){ echo "selected"; } ?>>Sekolah</option>
                        </select>
                        <label for="inputPeringkat" class="form-label">Peringkat Pelaksanaan</label>
                      </div>
                        </div>
                        <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                          <div class="form-floating">
                            <select name="inputMod" id="inputMod" class="form-control" required>
                              <option value="" <?php if($tempMtpk['modPelaksanaan'] == ''){ echo "selected"; } ?>>Sila Pilih..</option>
                              <option value="Bersemuka" <?php if($tempMtpk['modPelaksanaan'] == 'Bersemuka'){ echo "selected"; } ?>>Bersemuka</option>
                              <option value="Dalam Talian (Online)" <?php if($tempMtpk['modPelaksanaan'] == 'Dalam Talian (Online)'){ echo "selected"; } ?>>Dalam Talian (Online)</option>
                            </select>
                            <label for="inputMod" class="form-label">Mod Pelaksanaan</label>
                          </div>
                        </div>
                        <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                          <div class="form-floating">
                            <input value="<?= $tempMtpk['jumlahMuridLelaki'] ?>" type="text" name="inputMuridLelaki" id="inputMuridLelaki" placeholder="Bilangan Peserta Murid Lelaki (Orang)" class="form-control" required>
                            <label for="inputMuridLelaki" class="form-label">Bilangan Peserta Murid Lelaki (Orang)</label>
                          </div>
                        </div>
                        <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                          <div class="form-floating">
                            <input value="<?= $tempMtpk['jumlahMuridPerempuan'] ?>" type="text" name="inputMuridPerempuan" id="inputMuridPerempuan" placeholder="Bilangan Peserta Murid Perempuan (Orang)" class="form-control" required>
                            <label for="inputMuridPerempuan" class="form-label">Bilangan Peserta Murid Perempuan (Orang)</label>
                          </div>
                        </div>
                        <?php foreach($senaraiKaumBorang as $kaumBorang): ?>
                        <div class="col-12 col-lg-6">
                          <div class="form-floating">
                            <input type="hidden" name="inputKaum[]" value="<?= $kaumBorang ?>">
                            <?php 
                            $ada = FALSE;
                            foreach($senaraiKaumKelabMalaysiaku as $skkm): 
                              if($skkm->mkpk_kaum == $kaumBorang){ ?>
                            <input value="<?= $skkm->mkpk_bilangan_murid ?>" type="text" name="inputMurid[]" id="inputMurid[]" placeholder="Bilangan Murid Kaum <?= $kaumBorang ?> (Orang)" class="form-control">
                            <?php $ada = TRUE;
                            }
                            ?>
                            <?php endforeach; ?>
                            <?php if(!$ada): ?>
                            <input type="text" name="inputMurid[]" id="inputMurid[]" placeholder="Bilangan Murid Kaum <?= $kaumBorang ?> (Orang)" class="form-control">
                            <?php endif; ?>
                            <label for="inputMurid[]" class="form-label">Bilangan Murid Kaum <?= $kaumBorang ?> (Orang)</label>
                          </div>
                        </div>
                        <?php endforeach; ?>
                        <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                          <div class="form-floating">
                            <input value="<?= $tempMtpk['jumlahMurid'] ?>" type="text" name="inputJumlahMurid" id="inputJumlahMurid" placeholder="Jumlah Keseluruhan Penyertaan Murid (Orang)" class="form-control">
                            <label for="inputJumlahMurid" class="form-label">Jumlah Keseluruhan Penyertaan Murid (Orang)</label>
                          </div>
                        </div>
                        <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                          <div class="form-floating">
                            <input value="<?= $tempMtpk['jumlahGuru'] ?>" type="text" name="inputJumlahGuru" id="inputJumlahGuru" placeholder="Jumlah Keseluruhan Penyertaan Guru (Orang)" class="form-control">
                            <label for="inputJumlahGuru" class="form-label">Jumlah Keseluruhan Penyertaan Guru (Orang)</label>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th>PILIH</th>
                              <th>BIL</th>
                              <th>NAMA KELAB MALAYSIAKU</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach($senaraiPilihanKelab as $kelab): ?>
                            <tr>
                              <td>
                              <?php 
                              $ada = FALSE;
                              foreach($senaraiKelab as $ak){
                                if($ak->kelabmalaysiaku_program_kelabmalaysiaku == $kelab->kelabmalaysiaku_bil){
                                  $ada = TRUE;
                                }
                              }
                              ?>
                              <input type="checkbox" name="inputKelab[]" id="inputKelab[]" value="<?= $kelab->kelabmalaysiaku_bil ?>" <?php if($ada){ echo "checked"; } ?>></td>
                              <td><?= $kelab->kelabmalaysiaku_bil ?></td>
                              <td><?= $kelab->kelabmalaysiaku_nama ?></td>
                            </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary shadow-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x-octagon"></i>
                        Batal
                      </button>
                      <input type="hidden" name="inputProgram" value="<?= $program->program_bil ?>">
                      <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
                      <input type="hidden" name="inputStatus" value="<?= $program->program_status ?>">
                      <button type="submit" class="btn btn-outline-primary shadow-sm">
                        <i class="bi bi-gear"></i>
                        Kemaskini</button>
                    </div>
                            </form>
                  </div>
                </div>
              </div><!-- End Extra Large Modal-->
<?php endif; ?>

<!-- H - AGENSI -->
<div class="card" id="h">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
    <h1 class="card-title">
      <i class="bi bi-card-heading"></i>
      Bahagian H - Kerjasama Agensi Lain
    </h1>
    <?php if($bolehEdit): ?>
    <span data-bs-toggle="modal" data-bs-target="#tambahagensi">
    <button type="button" class="btn btn-outline-primary shadow-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Kemaskini Agensi">
      <i class="bi bi-gear"></i>
    </button>
    </span>
    <?php endif; ?>
    </div>
    <?php if(!empty($senaraiAgensi)): ?>
    <ol>
      <?php foreach($senaraiAgensi as $tajuk): ?>
      <li><?= $tajuk->agensi_program_agensi ?></li>
      <?php endforeach; ?>
    </ol>
    <?php endif; ?>
    <?php if(count($senaraiAgensi) <= 0): ?>
      <div class="alert alert-warning">
        TIADA PENGLIBATAN AGENSI LAIN.
      </div>
    <?php endif; ?>
  </div>
</div>

<?php if($bolehEdit): ?>
<div class="modal fade" id="tambahagensi" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">
                        <i class="bi bi-gear"></i>
                        Kemaskini Agensi
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <h4>Tambah Agensi</h4>
                      
                      <table class="table table-bordered table-sm mt-2">
                              <tr>
                                <th>Agensi (Pilihan Urus Setia)</th>
                                <th>Tindakan</th>
                              </tr>
                          <?php foreach($senaraiAgensiProgram as $agensi): ?>
                              <tr>
                                <td><?= $agensi->senarai_agensi_agensi ?></td>
                                <td>
                                  <?= form_open('program/tambahagensiProgram') ?>
                                  <input type="hidden" name="inputagensi" value="<?= $agensi->senarai_agensi_agensi ?>">
                                  <input type="hidden" name="inputStatus" value="<?= $program->program_status ?>">
                                  <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
                                  <input type="hidden" name="inputProgram" value="<?= $program->program_bil ?>">
                                  <button type="submit" class="btn btn-sm btn-outline-primary shadow-sm">
                                    <i class="bi bi-plus"></i>
                                  </button>
                                </form>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                            </table>
                            <?= form_open('program/tambahagensiProgram') ?>
                        <input type="hidden" name="inputProgram" value="<?= $program->program_bil ?>">
                                  <input type="hidden" name="inputStatus" value="<?= $program->program_status ?>">
                                  <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
                        <div class="row g-3">
                          <div class="col-12 col-lg-11">
                            <div class="form-floating">
                              <input type="text" name="inputagensi" id="inputagensi" class="form-control" placeholder="Tajuk:"- required>
                              <label for="inputagensi" class="form-label">Tajuk:</label>
                            </div>
                          </div>
                          <div class="col-12 col-lg-1">
                            <button type="submit" class="btn btn-outline-primary shadow-sm w-100">
                              <i class="bi bi-plus"></i>
                            </button>
                          </div>
                        </div>
                      </form>
                      <?php if(!empty($senaraiAgensi)): ?>
                      <hr>
                      <h4>Senarai Agensi</h4>
                      <ol>
                        <?php foreach($senaraiAgensi as $tajuk): ?>
                        <li>
                          <?= form_open('program/padamagensiProgram') ?>
                              <input type="hidden" name="inputagensiBil" value="<?= $tajuk->agensi_program_bil ?>">
                              <input type="hidden" name="inputTajuk" value="<?= $tajuk->agensi_program_agensi ?>">
                              <input type="hidden" name="inputProgramBil" value="<?= $program->program_bil ?>">
                              <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
                              <input type="hidden" name="inputStatus" value="<?= $program->program_status ?>">
                              <div class="d-flex justify-content-between align-items-center">
                                <span><?= $tajuk->agensi_program_agensi ?></span>
                                <button type="submit" class="btn btn-outline-danger shadow-sm btn-sm">
                                  <i class="bi bi-trash"></i>
                                </button>
                              </div>
                          </form>
                            
                        </li>
                        <?php endforeach; ?>
                      </ol>
                      <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary shadow-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x-octagon"></i>
                        Batal
                      </button>
                    </div>
                  </div>
                </div>
              </div><!-- End Large Modal-->
              <?php endif; ?>

<!-- I - PENERBITAN -->
<div class="card" id="i">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
    <h1 class="card-title">
      <i class="bi bi-card-heading"></i>
      Bahagian I - Edaran Penerbitan
    </h1>
    <?php if($bolehEdit): ?>
    <span data-bs-toggle="modal" data-bs-target="#tambahpenerbitan">
    <button type="button" class="btn btn-outline-primary shadow-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Kemaskini Penerbitan">
      <i class="bi bi-gear"></i>
    </button>
    </span>
    <?php endif; ?>
    </div>
    <?php if(!empty($senaraiPenerbitan)): ?>
    <div class="table-responsive">
      <table class="table table-sm table-bordered">
        <thead>
          <tr>
            <th>Bahan Penerbitan</th>
            <th>Bilangan</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $jumlahEdaran = 0;
          foreach($senaraiPenerbitan as $tajuk): ?>
          <tr>
            <td><?= $tajuk->penerbitan_program_penerbitan ?></td>
            <td><?= $tajuk->penerbitan_program_bilangan ?></td>
          </tr>
          <?php 
          if(empty($tajuk->penerbitan_program_bilangan)){
            $edaranPenerbitan = 0;
          }else{
            $edaranPenerbitan = $tajuk->penerbitan_program_bilangan;
          }
          $jumlahEdaran = $jumlahEdaran + $edaranPenerbitan;
          endforeach; ?>
        </tbody>
        <tfoot>
          <tr>
            <th>Jumlah</th>
            <th><?= $jumlahEdaran ?></th>
          </tr>
        </tfoot>
      </table>
    </div>
    <?php endif; ?>
    <?php if(count($senaraiPenerbitan) <= 0): ?>
      <div class="alert alert-warning">
        TIADA MAKLUMAT EDARAN PENERBITAN.
      </div>
    <?php endif; ?>
  </div>
</div>

<?php if($bolehEdit): ?>
<div class="modal fade" id="tambahpenerbitan" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">
                        <i class="bi bi-gear"></i>
                        Kemaskini Maklumat Edaran Penerbitan
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <h5>
                      <i class="bi bi-plus-circle"></i>  
                      Tambah Maklumat Edaran Penerbitan
                    </h5>
                      <table class="table table-bordered table-sm mt-2">
                              <tr>
                                <th>Penerbitan (Pilihan Urus Setia)</th>
                                <th>Bilangan Penerbitan</th>
                                <th>Tindakan</th>
                              </tr>
                          <?php foreach($senaraiPenerbitanProgram as $penerbitan): ?>
                              <tr>
                                <td><?= $penerbitan->senarai_penerbitan_penerbitan ?></td>
                                <?= form_open('program/tambahPenerbitanProgram') ?>
                                <td>
                                    <input type="text" name="inputBilanganPenerbitan" id="inputBilanganPenerbitan" class="form-control form-control-sm" placeholder="Bilangan" required>
                                </td>
                                <td>
                                  <input type="hidden" name="inputpenerbitan" value="<?= $penerbitan->senarai_penerbitan_penerbitan ?>">
                                  <input type="hidden" name="inputStatus" value="<?= $program->program_status ?>">
                                  <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
                                  <input type="hidden" name="inputProgram" value="<?= $program->program_bil ?>">
                                  <button type="submit" class="btn btn-sm btn-outline-primary shadow-sm">
                                    <i class="bi bi-plus"></i>
                                  </button>
                                </form>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                              <tr>
                                <th>Lain-Lain</th>
                                <th>Bilangan Penerbitan</th>
                                <th>Tindakan</th>
                              </tr>
                            <?= form_open('program/tambahPenerbitanProgram') ?>
                            <tr>
                              <td>
                              <input type="text" name="inputpenerbitan" id="inputpenerbitan" class="form-control form-control-sm" placeholder="Nama Bahan Penerbitan:" required>

                              </td>
                              <td>
                              <input type="text" name="inputBilanganPenerbitan" id="inputBilanganPenerbitan" class="form-control form-control-sm" placeholder="Bilangan" required>

                              </td>
                              <td>
                        <input type="hidden" name="inputProgram" value="<?= $program->program_bil ?>">
                        <input type="hidden" name="inputStatus" value="<?= $program->program_status ?>">
                        <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
                        <button type="submit" class="btn btn-sm btn-outline-primary shadow-sm">
                              <i class="bi bi-plus"></i>
                            </button>
                              </td>
                            </tr>
                            </form>
                            </table>
                      <?php if(!empty($senaraiPenerbitan)): ?>
                      <hr>
                      <h5>
                      <i class="bi bi-list"></i>  
                      Senarai Penerbitan</h5>
                        <table class="table table-sm table-bordered">
                          <thead>
                            <tr>
                              <th>Bahan Penerbitan</th>
                              <th>Bilangan Edaran</th>
                              <th>Tindakan</th>
                            </tr>
                          </thead>
                          <tbody>
                        <?php foreach($senaraiPenerbitan as $tajuk): ?>
                          <?= form_open('program/padamPenerbitanProgram') ?>
                            <tr>
                              <td><?= $tajuk->penerbitan_program_penerbitan ?></td>
                              <td><?= $tajuk->penerbitan_program_bilangan ?></td>
                              <td>
                              <input type="hidden" name="inputpenerbitanBil" value="<?= $tajuk->penerbitan_program_bil ?>">
                              <input type="hidden" name="inputTajuk" value="<?= $tajuk->penerbitan_program_penerbitan ?>">
                              <input type="hidden" name="inputProgramBil" value="<?= $program->program_bil ?>">
                              <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
                              <input type="hidden" name="inputStatus" value="<?= $program->program_status ?>">
                              <button type="submit" class="btn btn-outline-danger shadow-sm btn-sm">
                                  <i class="bi bi-trash"></i>
                                </button>
                              </td>
                            </tr>
                          </form>
                        <?php endforeach; ?>
                          </tbody>
                        </table>
                      <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary shadow-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x-octagon"></i>
                        Batal
                      </button>
                    </div>
                  </div>
                </div>
              </div><!-- End Large Modal-->
              <?php endif; ?>

<!-- J - LAPORAN BERGAMBAR -->
<div class="card" id='j'>
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
      <h5 class="card-title">Bahagian J - Laporan Gambar</h5>
      
      <?php 
    if($bolehEdit): ?>
      <div class="">
        <span data-bs-toggle="modal" data-bs-target="#kemaskiniGambarProgram">
        <button class="btn btn-outline-primary shadow-sm" data-bs-toggle="tooltip" data-bs-original-title="Kemaskini Gambar Program" data-bs-placement="bottom"><i class="bi bi-gear"></i></button>
        </span>
        <span data-bs-toggle="modal" data-bs-target="#tambahGambarProgram">
        <button class="btn btn-outline-primary shadow-sm" data-bs-toggle="tooltip" data-bs-original-title="Tambah Gambar Program" data-bs-placement="bottom"><i class="bi bi-plus-circle"></i></button>
        </span>
      </div>
      <?php endif; ?>
    </div>
    Nota:
    <ol>
        <li>Diingatkan bahawa tuan/puan perlu memuatnaik <strong>lima (5) keping gambar</strong> dan <strong>satu (1)</strong> paparan video.</li>
      </ol>

    <?php if(count($senaraiGambar) <= 0): ?>
      <div class="alert alert-warning">
        TIADA GAMBAR.
      </div>
    <?php endif; ?>

    <?php
    function isImage($url) {
    $headers = get_headers($url, 1);
    if (isset($headers['Content-Type'])) {
        $contentType = $headers['Content-Type'];
        if (strpos($contentType, 'image/') === 0) {
            return true; // It's an audio file
        }
    }
    return false; // Not an audio file
}
?>
    
    <div class="row g-3">
      <?php foreach($senaraiGambar as $gambar): 
        //1. DECLARE FILE PATH
        $filePointers = './assets/img/gambarProgram/'.$gambar->gambar_program_nama_fail;
        //2. LOAD CONDITION
          //2.1 IF EXISTS
          if(file_exists($filePointers)){
            $url = base_url('assets/img/gambarProgram/').$gambar->gambar_program_nama_fail;
            $headers = get_headers($url, 1);
        ?>
      <div class="col-12 col-lg-4">
        <div class="text-center">
        <?php if(strpos($headers['Content-Type'], 'image/') !== FALSE): ?>
          <img src="<?= $url ?>" style="object-fit: cover; width: auto; height: 200px; border-radius: 5%;" class="img-fluid"/>
        <?php endif; ?>
        <?php if(strpos($headers['Content-Type'], 'video/') !== FALSE): ?>
        <video width="320" height="240" controls style="object-fit: cover; width: auto; height: 200px; border-radius: 5%;" class="img-fluid">
            <source src="<?= $url ?>" type="video/mp4">
            Browser tidak menyokong fungsi video ini.
        </video>
        <?php endif; ?>
        <p class="mt-1"><?= $gambar->gambar_program_deskripsi ?></p>
        </div>
      </div>
      <?php 
          }
          //2.2 IF NOT EXISTS
          else{ 
      ?>
      <div class="col-12 col-lg-4">
        <div class="text-center">
        <img src="<?php echo base_url('assets/img/gambarProgram/noFile.png'); ?>" style="object-fit: cover; width: auto; height: 200px; border-radius: 5%;" class="img-fluid"/>
        <p class="mt-1"><?= $gambar->gambar_program_deskripsi ?></p>
        </div>
      </div>
      <?php 
          }
      endforeach; ?>
    </div>

  </div>
</div>

<?php if($bolehEdit): ?>
<div class="modal fade" id="tambahGambarProgram" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Tambah Gambar Program</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    <?php echo form_open_multipart('foto/prosesTambahGambarProgram');?>
                      <input type="file" name="input_userfile" class="form-control mb-3" accept="image/png, image/jpeg" required/>
                      <div class="form-floating mb-3">
                        <textarea required name="inputDeskripsi" class="form-control" placeholder="Nyatakan Deskripsi Gambar" id="inputDeskripsi" style="height: 100px;"></textarea>
                        <label for="inputDeskripsi">Deskripsi Gambar:</label>
                      </div>
                      <input type="hidden" name="inputProgramBil" value="<?= $program->program_bil ?>">
                      <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
                      <input type="hidden" name="inputNamaFail" value="uploadFailed.jpg">

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                      <input type="submit" value="Tambah Gambar" class="btn btn-outline-primary shadow-sm"/>
                    </div>
                    </form>
                  </div>
                </div>
              </div><!-- End Large Modal-->

              <?php if(count($senaraiGambar) > 0): ?>
              <div class="modal fade" id="kemaskiniGambarProgram" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Kemaskini Gambar Laporan</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row g-3">
                        <?php foreach($senaraiGambar as $g): ?>
                        <div class="col-12 col-lg-6 col-md-4 col-sm-12">
                          <div class="text-center">
                            <?php 
                            $filePointers = './assets/img/gambarProgram/'.$g->gambar_program_nama_fail;
                            if(file_exists($filePointers)): 
                            $url2 = base_url('assets/img/gambarProgram/').$g->gambar_program_nama_fail; 
                            $h2 = get_headers($url2, 1); ?>
                            <?php if(strpos($h2['Content-Type'], 'image/') !== FALSE): ?>
                            <img src="<?= base_url('assets/img/gambarProgram/').$g->gambar_program_nama_fail ?>" alt="<?= $g->gambar_program_nama_fail ?>" class="img-fluid" style="object-fit: cover; width: auto; height: 100px; border-radius: 5%;">
                            <?php endif; ?>
                            <?php if(strpos($h2['Content-Type'], 'video/') !== FALSE): ?>
                            <video width="320" height="240" controls style="object-fit: cover; width: auto; height: 100px; border-radius: 5%;" class="img-fluid">
                                <source src="<?= $url2 ?>" type="video/mp4">
                                Browser tidak menyokong fungsi video ini.
                            </video>
                            <?php endif; ?>
                            <?php 
                            endif; 
                            if(!file_exists($filePointers)): ?>
                            <img src="<?= base_url('assets/img/gambarProgram/noFile.png') ?>" alt="<?= $g->gambar_program_nama_fail ?>" class="img-fluid" style="height:100px;">
                            <?php endif; ?>
                            <?php if(!empty($g->gambar_program_deskripsi)): ?>
                            <p class="small text-muted"><?= $g->gambar_program_deskripsi ?></p>
                            <?php endif; ?>
                            <?= form_open('foto/padamGambarProgram') ?>
                            <input type="hidden" name="inputGambarBil" value="<?= $g->gambar_program_bil ?>">
                            <input type="hidden" name="inputProgramBil" value="<?= $program->program_bil ?>">
                            <button type="submit" class="btn btn-outline-danger btn-sm shadow-sm mt-3">Padam Gambar</button>
                            </form>
                          </div>
                        </div>
                        <?php endforeach; ?>
                      </div>  

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Large Modal-->
              <?php endif; ?>
<?php endif; ?>


<!-- K - SOCMED -->
<div class="card" id='k'>
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
      <h5 class="card-title">Bahagian K - Pautan Media Sosial / Liputan Media</h5>
      <?php 
    if($bolehEdit): ?>
    <span data-bs-toggle="modal" data-bs-target="#kemaskiniPautan">
      <button class="btn btn-outline-primary shadow-sm" data-bs-toggle="tooltip" data-bs-original-title="Kemaskini Pautan Media Sosial"><i class="bi bi-gear"></i></button>
    </span>
    <?php endif; ?>
    </div>
    <p>
      <span class="small"><strong>Bilangan Pautan:</strong></span>
      <span class="small text-muted"><?= count($senaraiPautan) ?></span>
    </p>
    <?php if(count($senaraiPautan) > 0): ?>
                      <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>LIHAT</th>
                              <th>PAUTAN</th>
                              <th>KEMASKINI</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach($senaraiPautan as $p): ?>
                            <tr>
                              <td>
                              <a href="<?= $p->pautan_program_pautan ?>" target="_blank" class="btn btn-sm btn-outline-secondary shadow-sm">Lihat</a>  
                              </td>
                              <td>
                                  <?= $p->pautan_program_pautan ?>
                                  
                              </td>
                              <td><?= $p->pautan_program_pengguna_waktu ?></td>
                            </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                      <?php endif; ?>
  </div>
</div>

<?php if($bolehEdit): ?>
<div class="modal fade" id="kemaskiniPautan" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Kemaskini Maklumat Pautan Media Sosial</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <h4>Tambah Maklumat Pautan</h4>
                      <?= form_open('program/prosesTambahPautan') ?>
                      <input type="hidden" name="inputProgramBil" value="<?= $program->program_bil ?>">
                      <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
                      <div class="form-floating mb-3">
                        <input type="text" name="inputUrl" id="inputUrl" class="form-control" placeholder="Masukkan pautan." required>
                        <label for="inputUrl" class="form-label">Pautan Media Sosial</label>
                      </div>
                      <button type="submit" class="btn btn-outline-primary shadow-sm">Tambah Pautan</button>
                      </form>
                      <?php if(count($senaraiPautan) > 0): ?>
                      <hr>
                      <h4>Senarai Pautan</h4>
                      <div class="table-responsive">
                        <table class="table table-bordered table-hovered">
                          <thead>
                            <tr>
                              <th>BIL</th>
                              <th>PAUTAN</th>
                              <th>KEMASKINI</th>
                              <th>OPERASI</th>
                              <th>PADAM</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach($senaraiPautan as $p): ?>
                            <tr>
                              <?= form_open('program/kemaskiniPautanProgram') ?>
                              <td><?= $p->pautan_program_bil ?></td>
                              <td>
                                <input type="text" name="inputPautan" id="inputPautan" class="form-control" value="<?= $p->pautan_program_pautan ?>">
                              </td>
                              <td><?= $p->pautan_program_pengguna_waktu ?></td>
                              <td>
                                <input type="hidden" name="inputProgramBil" value="<?= $program->program_bil ?>">
                                <input type="hidden" name="inputPautanBil" value="<?= $p->pautan_program_bil ?>">
                                <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
                                  <button type="submit" class="btn btn-sm btn-outline-primary shadow-sm">Simpan</button>
                                </form>
                                
                              </td>
                              <td>
                              <?= form_open('program/padamPautanProgram') ?>
                                  <input type="hidden" name="inputPautanBil" value="<?= $p->pautan_program_bil ?>">
                                  <input type="hidden" name="inputProgramBil" value="<?= $program->program_bil ?>">
                                  <button type="submit" class="btn btn-outline-danger btn-sm shadow-sm">Padam</button>
                                </form>
                              </td>
                            </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                      <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Large Modal-->
<?php endif; ?>

<!-- L - LAPORAN KERATAN AKHBAR -->
<div class="card" id='l'>
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
      <h5 class="card-title">Bahagian L - Laporan Keratan Akhbar</h5>
      
      <?php 
    if($bolehEdit): ?>
      <div class="">
        <span data-bs-toggle="modal" data-bs-target="#kemaskiniKeratanAkhbarProgram">
        <button class="btn btn-outline-primary shadow-sm" data-bs-toggle="tooltip" data-bs-original-title="Kemaskini Keratan Akhbar Program" data-bs-placement="bottom"><i class="bi bi-gear"></i></button>
        </span>
        <span data-bs-toggle="modal" data-bs-target="#tambahKeratanAkhbarProgram">
        <button class="btn btn-outline-primary shadow-sm" data-bs-toggle="tooltip" data-bs-original-title="Tambah Keratan Akhbar Program" data-bs-placement="bottom"><i class="bi bi-plus-circle"></i></button>
        </span>
      </div>
      <?php endif; ?>
    </div>

    <?php if(empty($senaraiKeratanAkhbar)): ?>
      <div class="alert alert-warning">
        TIADA KERATAN AKHBAR.
      </div>
    <?php endif; ?>

    
    <?php if(!empty($senaraiKeratanAkhbar)): ?>
    <div class="row g-3">
      <?php foreach($senaraiKeratanAkhbar as $keratanAkhbar): 
        //1. DECLARE FILE PATH
        $filePointers = './assets/img/keratanAkhbarProgram/'.$keratanAkhbar->keratan_akhbar_program_nama_fail;
        //2. LOAD CONDITION
          //2.1 IF EXISTS
          if(file_exists($filePointers)){
            $url = base_url('assets/img/keratanAkhbarProgram/').$keratanAkhbar->keratan_akhbar_program_nama_fail;
            $headers = get_headers($url, 1);
        ?>
      <div class="col-12 col-lg-4">
        <div class="text-center">
        <?php if(strpos($headers['Content-Type'], 'image/') !== FALSE): ?>
          <img src="<?= $url ?>" style="object-fit: cover; width: auto; height: 200px; border-radius: 5%;" class="img-fluid"/>
        <?php endif; ?>
        <?php if(strpos($headers['Content-Type'], 'video/') !== FALSE): ?>
        <video width="320" height="240" controls style="object-fit: cover; width: auto; height: 200px; border-radius: 5%;" class="img-fluid">
            <source src="<?= $url ?>" type="video/mp4">
            Browser tidak menyokong fungsi video ini.
        </video>
        <?php endif; ?>
        <p class="mt-1"><?= $keratanAkhbar->keratan_akhbar_program_deskripsi ?></p>
        </div>
      </div>
      <?php 
          }
          //2.2 IF NOT EXISTS
          else{ 
      ?>
      <div class="col-12 col-lg-4">
        <div class="text-center">
        <img src="<?php echo base_url('assets/img/keratanAkhbarProgram/noFile.png'); ?>" style="object-fit: cover; width: auto; height: 200px; border-radius: 5%;" class="img-fluid"/>
        <p class="mt-1"><?= $keratanAkhbar->keratan_akhbar_program_deskripsi ?></p>
        </div>
      </div>
      <?php 
          }
      endforeach; ?>
    </div>
    <?php endif; ?>

  </div>
</div>

<?php if($bolehEdit): ?>
<div class="modal fade" id="tambahKeratanAkhbarProgram" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Tambah Keratan Akhbar Program</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    <?php echo form_open_multipart('foto/prosesTambahKeratanAkhbarProgram');?>
                      <input type="file" name="input_userfile" class="form-control mb-3" accept="image/png, image/jpeg, video/mp4" required/>
                      <div class="form-floating mb-3">
                        <textarea required name="inputDeskripsi" class="form-control" placeholder="Nyatakan Deskripsi Keratan Akhbar" id="inputDeskripsi" style="height: 100px;"></textarea>
                        <label for="inputDeskripsi">Deskripsi Keratan Akhbar:</label>
                      </div>
                      <input type="hidden" name="inputProgramBil" value="<?= $program->program_bil ?>">
                      <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
                      <input type="hidden" name="inputNamaFail" value="uploadFailed.jpg">

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                      <input type="submit" value="Tambah Keratan Akhbar" class="btn btn-outline-primary shadow-sm"/>
                    </div>
                    </form>
                  </div>
                </div>
              </div><!-- End Large Modal-->

              <?php if(!empty($senaraiKeratanAkhbar)): ?>
              <div class="modal fade" id="kemaskiniKeratanAkhbarProgram" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Kemaskini Keratan Akhbar Laporan</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row g-3">
                        <?php foreach($senaraiKeratanAkhbar as $g): ?>
                        <div class="col-12 col-lg-6 col-md-4 col-sm-12">
                          <div class="text-center">
                            <?php 
                            $filePointers = './assets/img/keratanAkhbarProgram/'.$g->keratan_akhbar_program_nama_fail;
                            if(file_exists($filePointers)): 
                            $url2 = base_url('assets/img/keratanAkhbarProgram/').$g->keratan_akhbar_program_nama_fail; 
                            $h2 = get_headers($url2, 1); ?>
                            <?php if(strpos($h2['Content-Type'], 'image/') !== FALSE): ?>
                            <img src="<?= base_url('assets/img/keratanAkhbarProgram/').$g->keratan_akhbar_program_nama_fail ?>" alt="<?= $g->keratan_akhbar_program_nama_fail ?>" class="img-fluid" style="object-fit: cover; width: auto; height: 100px; border-radius: 5%;">
                            <?php endif; ?>
                            <?php if(strpos($h2['Content-Type'], 'video/') !== FALSE): ?>
                            <video width="320" height="240" controls style="object-fit: cover; width: auto; height: 100px; border-radius: 5%;" class="img-fluid">
                                <source src="<?= $url2 ?>" type="video/mp4">
                                Browser tidak menyokong fungsi video ini.
                            </video>
                            <?php endif; ?>
                            <?php 
                            endif; 
                            if(!file_exists($filePointers)): ?>
                            <img src="<?= base_url('assets/img/keratanAkhbarProgram/noFile.png') ?>" alt="<?= $g->keratan_akhbar_program_nama_fail ?>" class="img-fluid" style="height:100px;">
                            <?php endif; ?>
                            <?php if(!empty($g->keratan_akhbar_program_deskripsi)): ?>
                            <p class="small text-muted"><?= $g->keratan_akhbar_program_deskripsi ?></p>
                            <?php endif; ?>
                            <?= form_open('foto/padamKeratanAkhbarProgram') ?>
                            <input type="hidden" name="inputKeratanAkhbarBil" value="<?= $g->keratan_akhbar_program_bil ?>">
                            <input type="hidden" name="inputProgramBil" value="<?= $program->program_bil ?>">
                            <button type="submit" class="btn btn-outline-danger btn-sm shadow-sm mt-3">Padam Keratan Akhbar</button>
                            </form>
                          </div>
                        </div>
                        <?php endforeach; ?>
                      </div>  

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Large Modal-->
              <?php endif; ?>
<?php endif; ?>

<!-- M - STATUS -->
<div class="card" id='m'>
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
      <h5 class="card-title">Bahagian M - Status Laporan</h5>
    </div>
    <?php if(empty($statusLaporan)): ?>
      <div class="alert alert-warning">
        Tiada status dicatatkan.
      </div>
    <?php endif; ?>
    <?php if(!empty($statusLaporan)): ?>
      <div class="alert alert-success">
        <strong>Status Semasa : </strong><?= $statusLaporan->status_program_status ?> - <?= $statusLaporan->status_program_deskripsi ?>
      </div>
    <?php endif; ?>
    <?php if(count($senaraiStatus) > 0): ?>
    <div class="table-responsive">
      <table class="table table-bordered table-hover table-striped">
        <thead>
          <tr>
            <th>BIL</th>
            <th>STATUS</th>
            <th>DESKRIPSI</th>
            <th>PENGGUNA</th>
            <th>WAKTU</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($senaraiStatus as $stats): ?>
          <tr>
            <td><?= $stats->status_program_bil ?></td>
            <td><?= $stats->status_program_status ?></td>
            <td><?= $stats->status_program_deskripsi ?></td>
            <td><?= $stats->nama_penuh ?></td>
            <td><?= $stats->status_program_pengguna_waktu ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php endif; ?>
  </div>
</div>



<?php endforeach; ?>


</section>


</main>


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>