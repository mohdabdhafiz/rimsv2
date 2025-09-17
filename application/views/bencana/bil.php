<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@BENCANA</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">RIMS@BENCANA</a></li>
                <li class="breadcrumb-item active">LAPORAN BENCANA <?= strtoupper($bencana->bencana_jenis) ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">

    <?= form_open('bencana/kemaskini') ?>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
            <h1 class="card-title">LAPORAN BENCANA <?= strtoupper($bencana->bencana_jenis) ?></h1>
            <a href="<?= site_url('bencana/laporan/'.$bencana->bencana_bil) ?>" class="btn btn-outline-primary shadow-sm">
            <i class="bi bi-file"></i>
            Previu
            </a>
            </div>
            <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>Nombor Siri</th>
                    <td>
                        <?= $bencana->bencana_bil ?>
                    </td>
                    <?php if(strtoupper($bencana->bencana_status) == 'DRAF'): ?>
                    <th class="bg-danger text-white">Status Laporan</th>
                    <td valign="middle" class="bg-danger text-white h1 text-center"><?= strtoupper($bencana->bencana_status) ?></td>
                    <?php endif; ?>
                    <?php if(strtoupper($bencana->bencana_status) == 'TERIMA'): ?>
                    <th class="bg-success text-white">Status Laporan</th>
                    <td valign="middle" class="bg-success text-white h1 text-center"><?= strtoupper($bencana->bencana_status) ?></td>
                    <?php endif; ?>
                </tr>
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
                                <option value="<?= $negeri->nt_bil ?>" <?php if($negeri->nt_bil == $bencana->bencana_negeri){ echo "selected"; } ?>><?= strtoupper($negeri->nt_nama) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <th>Daerah</th>
                    <td>
                        <select name="inputDaerah" id="inputDaerah" class="form-control">
                            <?php foreach($senaraiDaerah as $daerah): ?>
                                <option value="<?= $daerah->bil ?>" <?php if($daerah->bil == $bencana->bencana_daerah){ echo "selected"; } ?>><?= strtoupper($daerah->nt_nama) ?> - <?= strtoupper($daerah->nama) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>                    
                </tr>
                <tr>
                    <td colspan=4>
                        <strong>Situasi Semasa</strong><br />
                        <textarea name="inputSituasi" id="inputSituasi" cols="30" rows="10" class="form-control" style="height:400px;"><?= strtoupper($bencana->bencana_situasi) ?></textarea>
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
                            <option value="Positif" <?php if($bencana->bencana_reaksi == 'Positif'){ echo "selected"; } ?>>POSITIF</option>
                            <option value="Neutral" <?php if($bencana->bencana_reaksi == 'Neutral'){ echo "selected"; } ?>>NEUTRAL</option>
                            <option value="Negatif" <?php if($bencana->bencana_reaksi == 'Negatif'){ echo "selected"; } ?>>NEGATIF</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                    <strong>Ulasan Bagi Reaksi Neutral / Negatif</strong><br>
                        <textarea name="inputUlasan" id="inputUlasan" cols="30" rows="10" class="form-control" style="height:400px;"><?= strtoupper($bencana->bencana_ulasan_reaksi) ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan=4>
                        <strong>Masalah / Isu Berbangkit Semasa Banjir (PPS / Agensi Terlibat)</strong><br>
                        <textarea name="inputMasalah" id="inputMasalah" cols="30" rows="10" class="form-control" style="height:400px;"><?= strtoupper($bencana->bencana_masalah) ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan=4>
                        <strong>Lokasi</strong><br>
                        <input type="text" class="form-control" name="inputLokasi" id="inputLokasi" value="<?= strtoupper($bencana->bencana_lokasi) ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan=4>
                        <strong>Cadangan Intervensi</strong><br>
                        <textarea name="inputIntervensi" id="inputIntervensi" cols="30" rows="10" class="form-control" style="height:400px;"><?= strtoupper($bencana->bencana_intervensi) ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <strong>Rumusan</strong><br>
                        <textarea name="inputRumusan" id="inputRumusan" cols="30" rows="10" class="form-control" style="height:400px;"><?= strtoupper($bencana->bencana_rumusan) ?></textarea>
                    </td>
                </tr>
                <tr id="bahagianGambar">
                    <td colspan="4">
                        <div class="mb-2">
                        <strong>Gambar:</strong>
                        <button type="button" class="btn btn-outline-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahGambar">
                        Muat Naik Gambar</button>
                        </div>
                        <div class="row g-0">
                            <?php foreach($gambarBencana as $bg): ?>
                            <div class="col-12 col-lg-3 col-md-4 col-sm-6">
                                <div class="text-center">
                                    <img src="<?= base_url() ?>assets/img/gambarBencana/<?= $bg->gambarNama ?>" alt="Gambar 1" style="object-fit:cover; height:400px; width:100%;">
                                    <div class="text-center my-1">
                                        <?= form_open('bencana/padamGambar') ?>
                                        <input type="hidden" name="inputBencanaGambarBil" value="<?= $bg->gambarBil ?>">
                                        <input type="hidden" name="inputBencanaBil" value="<?= $bencana->bencana_bil ?>">
                                        <button type="submit" class="btn btn-danger btn-sm shadow-sm">Padam</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>

                            
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


              <div class="modal fade" id="tambahGambar" tabindex="-1">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Tambah Gambar</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <?php echo form_open_multipart('bencana/tambahGambar'); ?> 
                        <input type="file" name="inputGambarBencana[]" size="20" multiple class="form-control"/>
                        <input type="hidden" name="inputBencanaBil" value="<?= $bencana->bencana_bil ?>">
                        <input type="submit" value="Muat Naik Gambar" class="btn btn-outline-primary shadow-sm my-1"/>
                    </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-secondary shadow-sm" data-bs-dismiss="modal">
                      <i class="bi bi-x-octagon"></i>  
                      Batal</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Extra Large Modal-->

    </section>

</main>


<?php $this->load->view($footer); ?>