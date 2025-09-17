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
                <li class="breadcrumb-item"><a href="<?= site_url('program') ?>">Laman</a></li>
                <li class="breadcrumb-item active">Maklumat Program</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">


<?php foreach($senaraiProgram as $program): ?>
  <div class="card" id='a'>
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <h5 class="card-title">Bahagian A - Maklumat Am Program</h5>
        <?= anchor('program/padam/'.$program->bil, 'Padam', "class='btn btn-danger shadow-sm'"); ?>
      </div>
      <p>
        <span class="small"><strong>Nama Pelapor:</strong></span>
        <br><?= $program->namaPelapor ?>, <?= $program->no_telefon ?>
      </p>
      <p>
                <span class="small"><strong>Nama Program:</strong></span><br>
                <?php echo $program->jt_nama; ?>
            </p>
            <p><span class="small"><strong>Tarikh Mula:</strong></span><br>
            <?php echo date_format(date_create($program->tarikh_masa_program), "d.m.Y"); ?></p>
            <p><span class="small"><strong>Masa Mula:</strong></span><br> 
            <?php echo date_format(date_create($program->tarikh_masa_program), "H.i.s a"); ?></p>
            <p><span class="small"><strong>Daerah:</strong></span>
              <br><?= $program->namaDaerah ?>
            </p>
            <p><span class="small"><strong>Parlimen:</strong></span>
              <br><?= $program->namaParlimen ?>
            </p>
            <p>
              <span class="small"><strong>DUN:</strong></span>
              <br><?= $program->namaDun ?>
            </p>
            <p>
              <span class="small"><strong>Tarikh Laporan Dimasukkan:</strong></span>
              <br><?= $program->tarikhKemaskini ?>
            </p>
      
  </div>
</div>

<?php 
$tahun = date_format(date_create($program->tarikh_masa_program), "Y");
$senaraiLokasi = $dataProgram->senaraiLokasiProgram($program->bilProgram, $pengguna->pengguna_peranan_bil, $tahun);
$senaraiObp = $dataProgram->senaraiObpHadir($program->bilProgram, $pengguna->pengguna_peranan_bil, $tahun);
?>
<div class="card" id='b'>
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
      <h5 class="card-title">Bahagian B - Lokasi dan Khalayak</h5>
      <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalB<?= $program->bilProgram ?>">Kemaskini</button>
    </div>
    <p>
      <span class="small"><strong>Lokasi Program:</strong></span>
      <br><span class="small text-muted"><?= count($senaraiLokasi) ?> lokasi</span>
    </p>
    <ol>
      <?php foreach($senaraiLokasi as $lokasi): ?>
      <li><?= $lokasi->lokasi ?></li>
      <?php endforeach; ?>
    </ol>
    <p><span class="small"><strong>Bilangan Khalayak:</strong></span>
      <br><?= number_format($program->khalayak, 0, '', ',') ?> orang
    </p>
    <p>
      <span class="small"><strong>Senarai Kehadiran OBP:</strong></span>
      <br><span class="small text-muted"><?= count($senaraiObp) ?> orang</span>
    </p>
    <?php if(!empty($senaraiObp)): ?>
      <ol>
        <?php foreach($senaraiObp as $obp): ?>
        <li>
          <?= $obp->nama ?>
          <br> <?= $obp->jawatan ?>
        </li>
        <?php endforeach; ?>
      </ol>
    <?php endif; ?>
  </div>
  
  <!-- Basic Modal -->
              <div class="modal fade" id="modalB<?= $program->bilProgram ?>" tabindex="-1" data-bs-backdrop="false">
                <div class="modal-dialog modal-dialog-scrollable modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Kemaskini Maklumat Lokasi dan Khalayak</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="p-3 border rounded mb-3">
                      <?= form_open('program/proses_tambah_lokasi') ?>
                      <div class="form-floating mb-3">
                        <input type="text" name="inputLokasi" id="inputLokasi" class="form-control" placeholder="Tambah Lokasi:" required>
                        <label for="inputLokasi" class="form-label">Tambah Lokasi:</label>
                      </div>
                      <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
                      <input type="hidden" name="inputPerananBil" value="<?= $pengguna->pengguna_peranan_bil ?>">
                      <input type="hidden" name="inputProgramBil" value="<?= $program->bilProgram ?>">
                      <input type="hidden" name="inputTahunProgram" value="<?= date_format(date_create($program->tarikh_masa_program), "Y") ?>">
                      <button type="submit" class="btn btn-outline-primary shadow-sm w-100">Tambah</button>
                      </form>
                      </div>
                      <?php if(!empty($senaraiLokasi)): ?>
                      <div class="p-3 border rounded mb-3">
                        <p><strong>Senarai Lokasi Program</strong></p>
                        <div class="table-responsive">
                          <table class="table table-sm table-hover">
                            <thead>
                              <tr>
                                <th>Lokasi</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach($senaraiLokasi as $lokasi): ?>
                              <tr>
                                <td><?= $lokasi->lokasi ?></td>
                                <td style="width:20%;">
                                  <?= form_open('program/padam_lokasi') ?>
                                  <input type="hidden" name="inputLokasiBil" value="<?= $lokasi->bil ?>">
                                  <input type="hidden" name="inputPerananBil" value="<?= $pengguna->pengguna_peranan_bil ?>">
                                  <input type="hidden" name="inputProgramBil" value="<?= $program->bilProgram ?>">
                                  <input type="hidden" name="inputTahunProgram" value="<?= date_format(date_create($program->tarikh_masa_program), "Y") ?>">
                                  <button type="submit" class="btn btn-outline-danger shadow-sm w-100">Padam</button>
                                  </form>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <?php endif; ?>
                      <div class="p-3 border rounded mb-3">
                        <?= form_open('program/proses_khalayak') ?>
                        <div class="form-floating mb-3">
                          <input type="text" name="inputKhalayak" id="inputKhalayak" class="form-control" placeholder="Bilangan Khalayak:" value="<?= number_format($program->khalayak, 0, '', ',') ?>">
                          <label for="inputKhalayak" class="form-label">Bilangan Khalayak:</label>
                        </div>
                      <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
                      <input type="hidden" name="inputPerananBil" value="<?= $pengguna->pengguna_peranan_bil ?>">
                      <input type="hidden" name="inputProgramBil" value="<?= $program->bilProgram ?>">
                      <input type="hidden" name="inputTahunProgram" value="<?= date_format(date_create($program->tarikh_masa_program), "Y") ?>">
                        <button type="submit" class="btn btn-outline-primary shadow-sm w-100">Kemaskini</button>
                        </form>
                      </div>
                      <div class="p-3 border rounded mb-3">
                        <?= form_open('program/proses_tambah_obp') ?>
                        <div class="form-floating mb-3">
                        <input list="inputNamaObps" type="text" name="inputNamaObp" id="inputNamaObp" class="form-control" placeholder="OBP:" required>
                        <label for="inputNamaObp" class="form-label">OBP:</label>
                        <datalist id="inputNamaObps">
                          <?php foreach($listObp as $o): ?>
                          <option value="<?= $o->obp_nama ?>">
                          <?php endforeach; ?>
                        </datalist>
                      </div>
                      <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
                      <input type="hidden" name="inputPerananBil" value="<?= $pengguna->pengguna_peranan_bil ?>">
                      <input type="hidden" name="inputProgramBil" value="<?= $program->bilProgram ?>">
                      <input type="hidden" name="inputTahunProgram" value="<?= date_format(date_create($program->tarikh_masa_program), "Y") ?>">
                      <button type="submit" class="btn btn-outline-primary shadow-sm w-100">Tambah</button>
                          </form>
                      </div>

                      <?php if(!empty($senaraiObp)): ?>
                      <div class="p-3 border rounded mb-3">
                        <p><strong>Senarai Kehadiran OBP</strong></p>
                        <div class="table-responsive">
                          <table class="table table-sm table-hover">
                            <thead>
                              <tr>
                                <th>Nama</th>
                                <th>Jawatan</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach($senaraiObp as $obp): ?>
                              <tr>
                                <td><?= $obp->nama ?></td>
                                <td><?= $obp->jawatan ?></td>
                                <td style="width:20%;">
                                  <?= form_open('program/padam_obp') ?>
                                  <input type="hidden" name="inputBil" value="<?= $obp->hadirBil ?>">
                                  <input type="hidden" name="inputPerananBil" value="<?= $pengguna->pengguna_peranan_bil ?>">
                                  <input type="hidden" name="inputProgramBil" value="<?= $program->bilProgram ?>">
                                  <input type="hidden" name="inputTahunProgram" value="<?= date_format(date_create($program->tarikh_masa_program), "Y") ?>">
                                  <button type="submit" class="btn btn-outline-danger shadow-sm w-100">Padam</button>
                                  </form>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Basic Modal-->

</div>


<?php
$senaraiHebahan = $dataProgram->senaraiHebahan($program->bilProgram, $pengguna->pengguna_peranan_bil, $tahun);
$senaraiPengisian = $dataProgram->senaraiPengisian();
$senaraiPengisianProgram = $dataProgram->senaraiPengisianProgram($program->bilProgram, $pengguna->pengguna_peranan_bil, $tahun);
?>
<div class="card" id='c'>
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
      <h5 class="card-title">Bahagian C - Pengisian Program / Hebahan</h5>
      <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalC<?= $program->bilProgram ?>">Kemaskini</button>
    </div>

    <p>
      <span class="small"><strong>Tajuk Hebahan / Ceramah:</strong></span>
    </p>
    <ol>
      <?php foreach($senaraiHebahan as $hebahan): ?>
      <li><?= $hebahan->hebahan ?></li>
      <?php endforeach; ?>
    </ol>

    <?php foreach($senaraiJenisTopik as $jenisTopik): 
      $senaraiTopik = $dataProgram->senaraiTopikProgram($jenisTopik->topik, $program->bilProgram, $pengguna->pengguna_peranan_bil, $tahun);
      if(!empty($senaraiTopik)):
      ?>
    <p>
      <span class="small"><strong>Topik <?= $jenisTopik->topik ?>:</strong></span>
    </p>
    <ol>
      <?php foreach($senaraiTopik as $sub): ?>
      <li><?= $sub->topik ?></li>
      <?php endforeach; ?>
    </ol>
    <?php 
      endif;
    endforeach; ?>

    <?php if(!empty($senaraiPengisianProgram)): ?>
    <p>
      <span class="small"><strong>Pengisian Program:</strong></span>
    </p>
    <ol>
      <?php foreach($senaraiPengisianProgram as $acara): ?>
      <li><?= $acara->senarai_pengisian_program ?></li>
      <?php endforeach; ?>
    </ol>
    <?php endif; ?>

    

  </div>
</div>


<!-- Basic Modal -->
<div class="modal fade" id="modalC<?= $program->bilProgram ?>" tabindex="-1" data-bs-backdrop="false">
                <div class="modal-dialog modal-dialog-scrollable modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Kemaskini Pengisian Program / Hebahan</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    <div class="p-3 border rounded mb-3">
                        <?= form_open('program/proses_tambah_hebahan') ?>
                        <div class="mb-3">
                        <label for="inputHebahan" class="form-label">Tajuk Hebahan:</label>
                        <input list="listHebahan" type="text" name="inputHebahan" id="inputHebahan" class="form-control" placeholder="Tajuk Hebahan:" required>
                        <datalist id="listHebahan">

                          <option value="KESIHATAN">
                          <option value="KESELAMATAN">
                          <option value="KOS SARA HIDUP">
                          <option value="UMUM">
                          <option value="BELANJAWAN 2023: MEMBANGUN MALAYSIA MADANI">

                        </datalist>
                      </div>
                      <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
                      <input type="hidden" name="inputPerananBil" value="<?= $pengguna->pengguna_peranan_bil ?>">
                      <input type="hidden" name="inputProgramBil" value="<?= $program->bilProgram ?>">
                      <input type="hidden" name="inputTahunProgram" value="<?= date_format(date_create($program->tarikh_masa_program), "Y") ?>">
                      <button type="submit" class="btn btn-outline-primary shadow-sm w-100">Tambah</button>
                          </form>
                      </div>
                    
                      <div class="p-3 border rounded mb-3">
                        <p><strong>Senarai Tajuk Hebahan</strong></p>
                        <div class="table-responsive">
                          <table class="table table-sm table-hover">
                            <thead>
                              <tr>
                                <th>Nama</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach($senaraiHebahan as $hebahan): ?>
                              <tr>
                                <td><?= $hebahan->hebahan ?></td>
                                <td style="width:20%;">
                                  <?= form_open('program/padam_hebahan') ?>
                                  <input type="hidden" name="inputBil" value="<?= $hebahan->bil ?>">
                                  <input type="hidden" name="inputPerananBil" value="<?= $pengguna->pengguna_peranan_bil ?>">
                                  <input type="hidden" name="inputProgramBil" value="<?= $program->bilProgram ?>">
                                  <input type="hidden" name="inputTahunProgram" value="<?= date_format(date_create($program->tarikh_masa_program), "Y") ?>">
                                  <button type="submit" class="btn btn-outline-danger shadow-sm w-100">Padam</button>
                                  </form>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                      </div>

                      <div class="p-3 border rounded mb-3">
                        <?= form_open('program/proses_tambah_topik_program') ?>
                        <div class="mb-3">
                        <label for="inputJenisTopik" class="form-label">Kategori Topik:</label>
                        <input list="listJenisTopik" type="text" name="inputJenisTopik" id="inputJenisTopik" class="form-control" placeholder="Cth: Kesihatan" required>
                        <datalist id="listJenisTopik">

                        <?php foreach($senaraiJenisTopik as $jenisTopik): ?>
                          <option value="<?= $jenisTopik->topik ?>">
                        <?php endforeach; ?>

                        </datalist>
                      </div>
                      <div class="mb-3">
                        <label for="inputTopik" class="form-label">Topik:</label>
                        <input type="text" name="inputTopik" id="inputTopik" list="listTopik" class="form-control">
                        <datalist id="listTopik">
                          <option value="Denggi">
                          <option value="COVID-19">
                          <option value="Kesihatan Mental">
                          <option value="Anti Pemerdagangan Orang Dan Anti Penyeludupan Migran (MAPO)">
                          <option value="Berita Palsu 3R (Race, Religion, Royalty)">
                          <option value="Bencana (Banjir, Tanah Runtuh dll)">
                          <option value="Musim Perayaan (Meninggalkan Rumah Dan Di Jalan Raya)">
                          <option value="Jenayah Scam & Talian NSRC 997">
                          <option value="Kenaikan Harga Barang">
                          <option value="Cekap Tenaga">
                          <option value="Skim Bantuan Kerajaan dan Subsidi">
                          <option value="Menu Rahmah">
                          <option value="Pakej Jalur Lebar Perpaduan">
                          <option value="Malaysia Madani">
                          <option value="Perpaduan & Integrasi Nasional">
                          <option value="Patriotisme">
                        </datalist>
                      </div>
                      <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
                      <input type="hidden" name="inputPerananBil" value="<?= $pengguna->pengguna_peranan_bil ?>">
                      <input type="hidden" name="inputProgramBil" value="<?= $program->bilProgram ?>">
                      <input type="hidden" name="inputTahunProgram" value="<?= date_format(date_create($program->tarikh_masa_program), "Y") ?>">
                      <button type="submit" class="btn btn-outline-primary shadow-sm w-100">Tambah</button>
                          </form>
                      </div>
                    
                      <div class="p-3 border rounded mb-3">
                        <p><strong>Senarai Topik</strong></p>
                        <div class="table-responsive">
                          <table class="table table-sm table-hover">
                            <thead>
                              <tr>
                                <th>Kategori Topik</th>
                                <th>Topik</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                              $senaraiTopikProgram = $dataProgram->senaraiSemuaTopikProgram($program->bilProgram, $pengguna->pengguna_peranan_bil, $tahun);
                              foreach($senaraiTopikProgram as $topikProgram): ?>
                              <tr>
                                <td><?= $topikProgram->jenis_topik ?></td>
                                <td><?= $topikProgram->topik ?></td>
                                <td style="width:20%;">
                                  <?= form_open('program/padam_topik_program') ?>
                                  <input type="hidden" name="inputBil" value="<?= $topikProgram->bil ?>">
                                  <input type="hidden" name="inputPerananBil" value="<?= $pengguna->pengguna_peranan_bil ?>">
                                  <input type="hidden" name="inputProgramBil" value="<?= $program->bilProgram ?>">
                                  <input type="hidden" name="inputTahunProgram" value="<?= date_format(date_create($program->tarikh_masa_program), "Y") ?>">
                                  <button type="submit" class="btn btn-outline-danger shadow-sm w-100">Padam</button>
                                  </form>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                      </div>

                      <div class="p-3 border rounded mb-3">
                        <?= form_open('program/proses_tambah_pengisian_program') ?>
                        <div class="mb-3">
                        <label for="inputPengisian" class="form-label">Pengisian Program:</label>
                        <input list="listPengisian" type="text" name="inputPengisian" id="inputPengisian" class="form-control" placeholder="Cth: Ceramah" required>
                        <datalist id="listPengisian">

                        <?php foreach($senaraiPengisian as $pengisian): ?>
                          <option value="<?= $pengisian->nama ?>">
                        <?php endforeach; ?>

                        </datalist>
                      </div>
                      <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
                      <input type="hidden" name="inputPerananBil" value="<?= $pengguna->pengguna_peranan_bil ?>">
                      <input type="hidden" name="inputProgramBil" value="<?= $program->bilProgram ?>">
                      <input type="hidden" name="inputTahunProgram" value="<?= date_format(date_create($program->tarikh_masa_program), "Y") ?>">
                      <button type="submit" class="btn btn-outline-primary shadow-sm w-100">Tambah</button>
                          </form>
                      </div>
                    
                      <div class="p-3 border rounded mb-3">
                        <p><strong>Senarai Pengisian Program</strong></p>
                        <div class="table-responsive">
                          <table class="table table-sm table-hover">
                            <thead>
                              <tr>
                                <th>Pengisian Program</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                              foreach($senaraiPengisianProgram as $acara): ?>
                              <tr>
                                <td><?= $acara->senarai_pengisian_program ?></td>
                                <td style="width:20%;">
                                  <?= form_open('program/padam_topik_program') ?>
                                  <input type="hidden" name="inputBil" value="<?= $topikProgram->bil ?>">
                                  <input type="hidden" name="inputPerananBil" value="<?= $pengguna->pengguna_peranan_bil ?>">
                                  <input type="hidden" name="inputProgramBil" value="<?= $program->bilProgram ?>">
                                  <input type="hidden" name="inputTahunProgram" value="<?= date_format(date_create($program->tarikh_masa_program), "Y") ?>">
                                  <button type="submit" class="btn btn-outline-danger shadow-sm w-100">Padam</button>
                                  </form>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                      </div>

                      

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Basic Modal-->

<?php $senaraiEdaranPenerbitan = $dataProgram->senaraiEdaranPenerbitan($program->bilProgram, $pengguna->pengguna_peranan_bil, $tahun);
$senaraiPenerbitan = $dataProgram->senaraiPenerbitan();
?>
<div class="card" id='d'>
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
      <h5 class="card-title">Bahagian D - Edaran Penerbitan</h5>
      <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalD<?= $program->bilProgram ?>">Kemaskini</button>
    </div>
    <p>
      <span class="small"><strong>Edaran Bahan Penerbitan</strong></span>
    </p>
    <ol>
      <?php foreach($senaraiEdaranPenerbitan as $edar): ?>
      <li><?= $edar->jenis_penerbitan ?></li>
      <?php endforeach; ?>
    </ol>
    <p>
      <span class="small"><strong>Jumlah Edaran Bahan Penerbitan:</strong></span>
      <br><?= number_format($program->jumlah_bahan_penerbitan, 0, '', ',') ?> edaran
    </p>
  </div>
</div>

<!-- Basic Modal -->
<div class="modal fade" id="modalD<?= $program->bilProgram ?>" tabindex="-1" data-bs-backdrop="false">
                <div class="modal-dialog modal-dialog-scrollable modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Kemaskini Edaran Bahan Penerbitan</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="p-3 border rounded mb-3">
                      <?= form_open('program/proses_tambah_penerbitan') ?>
                      <div class="mb-3">
                        <label for="inputEdaran" class="form-label">Edaran Bahan Penerbitan:</label>
                        <input list="listEdaran" type="text" name="inputEdaran" id="inputEdaran" class="form-control" placeholder="Cth: Buku Kecil" required>
                      </div>
                      <datalist id="listEdaran">
                        <?php foreach($senaraiPenerbitan as $terbitan): ?>
                      <option value="<?= $terbitan->deskripsi ?>">
                        <?php endforeach; ?>
                      </datalist>
                      <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
                      <input type="hidden" name="inputPerananBil" value="<?= $pengguna->pengguna_peranan_bil ?>">
                      <input type="hidden" name="inputProgramBil" value="<?= $program->bilProgram ?>">
                      <input type="hidden" name="inputTahunProgram" value="<?= date_format(date_create($program->tarikh_masa_program), "Y") ?>">
                      <button type="submit" class="btn btn-outline-primary shadow-sm w-100">Tambah</button>
                      </form>
                      </div>
                      <?php if(!empty($senaraiEdaranPenerbitan)): ?>
                      <div class="p-3 border rounded mb-3">
                        <p><strong>Edaran Bahan Penerbitan</strong></p>
                        <div class="table-responsive">
                          <table class="table table-sm table-hover">
                            <thead>
                              <tr>
                                <th>Bahan Penerbitan</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach($senaraiEdaranPenerbitan as $edaran): ?>
                              <tr>
                                <td><?= $edaran->jenis_penerbitan ?></td>
                                <td style="width:20%;">
                                  <?= form_open('program/padam_penerbitan') ?>
                                  <input type="hidden" name="inputBil" value="<?= $edaran->bil ?>">
                                  <input type="hidden" name="inputPerananBil" value="<?= $pengguna->pengguna_peranan_bil ?>">
                                  <input type="hidden" name="inputProgramBil" value="<?= $program->bilProgram ?>">
                                  <input type="hidden" name="inputTahunProgram" value="<?= date_format(date_create($program->tarikh_masa_program), "Y") ?>">
                                  <button type="submit" class="btn btn-outline-danger shadow-sm w-100">Padam</button>
                                  </form>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <?php endif; ?>

                      <div class="p-3 border rounded mb-3">
                        <?= form_open('program/proses_jumlah_penerbitan') ?>
                        <div class="form-floating mb-3">
                          <input type="text" name="inputJumlahPenerbitan" id="inputJumlahPenerbitan" class="form-control" placeholder="Jumlah Edaran Bahan Penerbitan:" value="<?= number_format($program->jumlah_bahan_penerbitan, 0, '', ',') ?>">
                          <label for="inputJumlahPenerbitan" class="form-label">Jumlah Edaran Bahan Penerbitan:</label>
                        </div>
                      <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
                      <input type="hidden" name="inputPerananBil" value="<?= $pengguna->pengguna_peranan_bil ?>">
                      <input type="hidden" name="inputProgramBil" value="<?= $program->bilProgram ?>">
                      <input type="hidden" name="inputTahunProgram" value="<?= date_format(date_create($program->tarikh_masa_program), "Y") ?>">
                        <button type="submit" class="btn btn-outline-primary shadow-sm w-100">Kemaskini</button>
                        </form>
                      </div>
                      
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Basic Modal-->

<?php $senaraiAgensi = $dataProgram->senaraiAgensi();
$senaraiAgensiProgram = $dataProgram->senaraiAgensiProgram($program->bilProgram, $pengguna->pengguna_peranan_bil, $tahun);
?>
<div class="card" id='e'>
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
      <h5 class="card-title">Bahagian E - Kerjasama Antara Agensi</h5>
      <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalE<?= $program->bilProgram ?>">Kemaskini</button>
    </div>
    <p>
      <span class="small"><strong>Senarai Agensi</strong></span>
    </p>
    <ol>
      <?php foreach($senaraiAgensiProgram as $ag): ?>
      <li><?= $ag->agensi ?></li>
      <?php endforeach; ?>
    </ol>
  </div>
</div>
<!-- Basic Modal -->
<div class="modal fade" id="modalE<?= $program->bilProgram ?>" tabindex="-1" data-bs-backdrop="false">
                <div class="modal-dialog modal-dialog-scrollable modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Kemaskini Kerjasama Antara Agensi</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="p-3 border rounded mb-3">
                      <?= form_open('program/proses_tambah_agensi') ?>
                      <div class="mb-3">
                        <label for="inputAgensi" class="form-label">Kerjasama Agensi:</label>
                        <input list="listAgensi" type="text" name="inputAgensi" id="inputAgensi" class="form-control" placeholder="Cth: Kementerian Kesihatan Malaysia (KKM)" required>
                      </div>
                      <datalist id="listAgensi">
                        <?php foreach($senaraiAgensi as $agensi): ?>
                      <option value="<?= $agensi->nama_agensi ?> (<?= $agensi->singkatan_agensi ?>)">
                        <?php endforeach; ?>
                      </datalist>
                      <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
                      <input type="hidden" name="inputPerananBil" value="<?= $pengguna->pengguna_peranan_bil ?>">
                      <input type="hidden" name="inputProgramBil" value="<?= $program->bilProgram ?>">
                      <input type="hidden" name="inputTahunProgram" value="<?= date_format(date_create($program->tarikh_masa_program), "Y") ?>">
                      <button type="submit" class="btn btn-outline-primary shadow-sm w-100">Tambah</button>
                      </form>
                      </div>
                      <?php if(!empty($senaraiAgensiProgram)): ?>
                      <div class="p-3 border rounded mb-3">
                        <p><strong>Kerjasama Antara Agensi</strong></p>
                        <div class="table-responsive">
                          <table class="table table-sm table-hover">
                            <thead>
                              <tr>
                                <th>Agensi</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach($senaraiAgensiProgram as $agensiProgram): ?>
                              <tr>
                                <td><?= $agensiProgram->agensi ?></td>
                                <td style="width:20%;">
                                  <?= form_open('program/padam_kerjasama_agensi') ?>
                                  <input type="hidden" name="inputBil" value="<?= $edaran->bil ?>">
                                  <input type="hidden" name="inputPerananBil" value="<?= $pengguna->pengguna_peranan_bil ?>">
                                  <input type="hidden" name="inputProgramBil" value="<?= $program->bilProgram ?>">
                                  <input type="hidden" name="inputTahunProgram" value="<?= date_format(date_create($program->tarikh_masa_program), "Y") ?>">
                                  <button type="submit" class="btn btn-outline-danger shadow-sm w-100">Padam</button>
                                  </form>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <?php endif; ?>
                      
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Basic Modal-->

<div class="card" id='f'>
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
      <h5 class="card-title">Bahagian F - Laporan Gambar</h5>
      <button>Kemaskini</button>
    </div>
    <p><span class="small"><strong>Lokasi Program:</strong></span></p>
    <ol>
      <li>Lokasi 1</li>
      <li>Lokasi 2</li>
    </ol>
    <p><span class="small"><strong>Bilangan Khalayak:</strong></span>
      <br>10000 orang
    </p>
  </div>
</div>


<div class="card" id='g'>
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
      <h5 class="card-title">Bahagian G - Pautan Media Sosial</h5>
      <button>Kemaskini</button>
    </div>
    <p><span class="small"><strong>Lokasi Program:</strong></span></p>
    <ol>
      <li>Lokasi 1</li>
      <li>Lokasi 2</li>
    </ol>
    <p><span class="small"><strong>Bilangan Khalayak:</strong></span>
      <br>10000 orang
    </p>
  </div>
</div>


<div class="card" id='h'>
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
      <h5 class="card-title">Bahagian H - Status Penghantaran Laporan</h5>
      <button>Kemaskini</button>
    </div>
    <p><span class="small"><strong>Lokasi Program:</strong></span></p>
    <ol>
      <li>Lokasi 1</li>
      <li>Lokasi 2</li>
    </ol>
    <p><span class="small"><strong>Bilangan Khalayak:</strong></span>
      <br>10000 orang
    </p>
  </div>
</div>



<?php endforeach; ?>


</section>


</main>


<?php $this->load->view('us_program_na/susunletak/bawah'); ?>