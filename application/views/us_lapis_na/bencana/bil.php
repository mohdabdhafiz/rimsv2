<?php 
$this->load->view('us_lapis_na/susunletak/atas');
$this->load->view('us_lapis_na/susunletak/sidebar');
$this->load->view('us_lapis_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@BENCANA</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item">RIMS@BENCANA</li>
                <li class="breadcrumb-item active">Laporan Bencana No. <?= $bencana->bencana_bil ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">

    <?= form_open('bencana/kemaskini') ?>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
            <h1 class="card-title">Laporan Bencana Siri No. : <?= $bencana->bencana_bil ?></h1>
            <a href="<?= site_url('bencana/laporan/'.$bencana->bencana_bil) ?>" class="btn btn-outline-primary shadow-sm">
            <i class="bi bi-file"></i>
            Previu
            </a>
            </div>
            <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>Tarikh</th>
                    <td>
                        <input type="date" class="form-control" name="inputTarikhLaporan" id="inputTarikhLaporan" value="<?= $bencana->bencana_tarikh_laporan ?>">
                    </td>
                    <th>Pelapor</th>
                    <td><?= $bencana->nama_penuh ?></td>
                </tr>
                <tr>
                    <th>Negeri</th>
                    <td>
                        <select name="inputNegeri" id="inputNegeri" class="form-control">
                            <?php foreach($senaraiNegeri as $negeri): ?>
                                <option value="<?= $negeri->nt_bil ?>" <?php if($negeri->nt_bil == $bencana->bencana_negeri){ echo "selected"; } ?>><?= $negeri->nt_nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <th>Daerah</th>
                    <td>
                        <select name="inputDaerah" id="inputDaerah" class="form-control">
                            <?php foreach($senaraiDaerah as $daerah): ?>
                                <option value="<?= $daerah->bil ?>" <?php if($daerah->bil == $bencana->bencana_daerah){ echo "selected"; } ?>><?= $daerah->nt_nama ?> - <?= $daerah->nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>                    
                </tr>
                <tr>
                    <td colspan=4>
                        <strong>Situasi Semasa</strong><br />
                        <textarea name="inputSituasi" id="inputSituasi" cols="30" rows="10" class="form-control" style="height:400px;"><?= $bencana->bencana_situasi ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th>Bilangan PPS</th>
                    <td>
                        <input type="text" class="form-control" name="inputPps" id="inputPps" value="<?= $bencana->bencana_pps ?>">
                    </td>
                    <th>Jumlah Mangsa</th>
                    <td>
                        <input type="text" name="inputMangsa" id="inputMangsa" value="<?= $bencana->bencana_mangsa ?>" class="form-control">
                    </td>
                </tr>
                <tr>
                    <th>Bilangan Kematian</th>
                    <td>
                        <input type="text" name="inputKematian" id="inputKematian" value="<?= $bencana->bencana_kematian ?>" class="form-control">
                    </td>
                    <th>Bilangan Hilang</th>
                    <td>
                        <input type="text" name="inputHilang" id="inputHilang" value="<?= $bencana->bencana_hilang ?>" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td colspan=2>
                        <strong>Reaksi Orang Ramai Terhadap Pengurusan Banjir</strong><br />
                        
                        
                    </td>
                    <td colspan=2>
                    <select name="inputReaksi" id="inputReaksi" class="form-control">
                            <option value="Positif" <?php if($bencana->bencana_reaksi == 'Positif'){ echo "selected"; } ?>>Positif</option>
                            <option value="Neutral" <?php if($bencana->bencana_reaksi == 'Neutral'){ echo "selected"; } ?>>Neutral</option>
                            <option value="Negatif" <?php if($bencana->bencana_reaksi == 'Negatif'){ echo "selected"; } ?>>Negatif</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                    <strong>Ulasan Bagi Reaksi Neutral / Negatif</strong><br>
                        <textarea name="inputUlasan" id="inputUlasan" cols="30" rows="10" class="form-control" style="height:400px;"><?= $bencana->bencana_ulasan_reaksi ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan=4>
                        <strong>Masalah / Isu Berbangkit Semasa Banjir (PPS / Agensi Terlibat)</strong><br>
                        <textarea name="inputMasalah" id="inputMasalah" cols="30" rows="10" class="form-control" style="height:400px;"><?= $bencana->bencana_masalah ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan=4>
                        <strong>Lokasi</strong><br>
                        <input type="text" class="form-control" name="inputLokasi" id="inputLokasi" value="<?= $bencana->bencana_lokasi ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan=4>
                        <strong>Cadangan Intervensi</strong><br>
                        <textarea name="inputIntervensi" id="inputIntervensi" cols="30" rows="10" class="form-control" style="height:400px;"><?= $bencana->bencana_intervensi ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <strong>Rumusan</strong><br>
                        <textarea name="inputRumusan" id="inputRumusan" cols="30" rows="10" class="form-control" style="height:400px;"><?= $bencana->bencana_rumusan ?></textarea>
                    </td>
                </tr>
            </table>
            </div>
            <div class="text-center">
                <input type="hidden" name="inputPengguna" value="<?= $bencana->bencana_pelapor ?>">
                <input type="hidden" name="inputBil" value="<?= $bencana->bencana_bil ?>">
            <div class="btn-group shadow-sm" role="group" aria-label="operasi">
                <button type="submit" class="btn btn-outline-primary">
                <i class="bi bi-save"></i>    
                Simpan</button>
                </form>
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#hantarModal">
                <i class="bi bi-send"></i>    
                Hantar</button>
                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#padamModal">
                <i class="bi bi-trash"></i>    
                Padam</button>
            </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="hantarModal" tabindex="-1">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Hantar Laporan</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Anda pasti untuk menghantar laporan ini?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary shadow-sm" data-bs-dismiss="modal">
                      <i class="bi bi-x-octagon"></i>  
                      Batal</button>
                        <?= form_open('bencana/hantarLaporan') ?>
                        <input type="hidden" name="inputBil" value="<?= $bencana->bencana_bil ?>">
                      <button type="submit" class="btn btn-outline-success shadow-sm">
                      <i class="bi bi-send"></i>  
                      Hantar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div><!-- End Extra Large Modal-->

              <div class="modal fade" id="padamModal" tabindex="-1">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Padam Laporan</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Anda pasti untuk memadam laporan ini?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary shadow-sm" data-bs-dismiss="modal">
                      <i class="bi bi-x-octagon"></i>  
                      Batal</button>
                        <?= form_open('bencana/padamLaporan') ?>
                        <input type="hidden" name="inputBil" value="<?= $bencana->bencana_bil ?>">
                      <button type="submit" class="btn btn-danger shadow-sm">
                      <i class="bi bi-trash"></i>  
                      PADAM</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div><!-- End Extra Large Modal-->

    </section>

</main>


<?php $this->load->view('us_lapis_na/susunletak/bawah'); ?>