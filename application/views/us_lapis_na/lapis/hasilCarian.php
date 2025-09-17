<?php
$this->load->view('us_lapis_na/susunletak/atas');
$this->load->view('us_lapis_na/susunletak/navbar');
$this->load->view('us_lapis_na/susunletak/sidebar');
?>


<main id="main" class="main">


    <div class="pagetitle">
        <h1>RIMS@LAPIS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">RIMS@LAPIS</li>
                <li class="breadcrumb-item active">Carian</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


        <section class="section">
            
        <div class="row g-3">
            <div class="col-12 col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title">Carian</h1>
                        <?= form_open('lapis/carian') ?>
                        <div class="row g-3">
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-floating">
                                    <select name="inputKluster" id="inputKluster" class="form-control" required>
                                        <option value="">Sila pilih Kluster</option>
                                        <?php foreach($senarai_kluster as $kluster1): ?>
                                        <option value="<?= $kluster1->kit_bil ?>" <?php if($kluster1->kit_bil == $kluster->kit_bil){ echo "selected"; } ?>><?= $kluster1->kit_nama ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="inputDaerah">Kluster</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-floating">
                                                    <select name="inputNegeriBil" id="inputNegeriBil" class="form-control">
                                                        <option value="">Sila pilih..</option>
                                                        <?php foreach($senarai_negeri as $negeri): ?>
                                                        <option value="<?= $negeri->nt_bil ?>" <?php if($rumusanCarian['negeri'] == $negeri->nt_nama){ echo "selected"; } ?>><?= $negeri->nt_nama ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <label for="inputNegeriBil">Negeri</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 col-md-6 col-sm-12">
                                <div class="form-floating">
                                    <select name="inputDaerah" id="inputDaerah" class="form-control">
                                        <option value="">Sila Pilih..</option>
                                        <?php foreach($senaraiDaerah as $daerah): ?>
                                            <option value="<?= $daerah->bil ?>" <?php if($rumusanCarian['daerah'] == $daerah->bil){ echo "selected"; } ?>><?= $daerah->nt_nama ?> - <?= $daerah->nama ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="inputDaerah" class="form-label">Daerah</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 col-md-6 col-sm-12">
                                <div class="form-floating">
                                    <select name="inputParlimen" id="inputParlimen" class="form-control">
                                        <option value="">Sila pilih..</option>
                                        <?php foreach($senaraiParlimen as $parlimen): ?>
                                            <option value="<?= $parlimen->pt_bil ?>" <?php if($rumusanCarian['parlimen'] == $parlimen->pt_bil){ echo "selected"; } ?>><?= $parlimen->nt_nama ?> - <?= $parlimen->pt_nama ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="inputParlimen" class="form-label">Parlimen</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 col-md-6 col-sm-12">
                                <div class="form-floating">
                                    <select name="inputDun" id="inputDun" class="form-control">
                                        <option value="">Sila Pilih..</option>
                                        <?php foreach($senaraiDun as $dun): ?>
                                            <option value="<?= $dun->dun_bil ?>" <?php if($rumusanCarian['dun'] == $dun->dun_bil){ echo "selected"; } ?>><?= $dun->nt_nama ?> - <?= $dun->dun_nama ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="inputDun" class="form-label">DUN</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-floating">
                                    <input type="date" name="inputTarikhMula" id="inputTarikhMula" required class="form-control" value="<?= $rumusanCarian['tarikhMula'] ?>">
                                    <label for="inputTarikhMula" class="form-label">Tarikh Mula</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-floating">
                                    <input type="date" name="inputTarikhTamat" id="inputTarikhTamat" class="form-control" required value="<?= $rumusanCarian['tarikhTamat'] ?>">
                                    <label for="inputTarikhTamat" class="form-label">Tarikh Tamat</label>
                                </div>
                            </div>
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-outline-success shadow-sm">Cari</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>



            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title">Rumusan Carian</h1>
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <th>Kluster</th>
                                    <td><?= $rumusanCarian['namaKluster'] ?></td>
                                </tr>
                                <tr>
                                    <th>Negeri</th>
                                    <td><?= $rumusanCarian['negeri'] ?></td>
                                </tr>
                                <tr>
                                    <th>Tarikh Mula</th>
                                    <td><?= $rumusanCarian['tarikhMula'] ?></td>
                                </tr>
                                <tr>
                                    <th>Tarikh Tamat</th>
                                    <td><?= $rumusanCarian['tarikhTamat'] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            </div>

            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Hasil Carian</h1>
                    <p>Bilangan Laporan: <?= count($senaraiLaporan) ?></p>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover datatable">
                            <thead>
                                <tr>
                                    <th>Timestamp</th>
                                    <th>Nama Pelapor</th>
                                    <th>Negeri</th>
                                    <th>Daerah</th>
                                    <th>Parlimen</th>
                                    <th>DUN</th>
                                    <th>Jenis Kawasan</th>
                                    <th>Isu</th>
                                    <?php if($kluster->kit_shortform == 'ekonomi'): ?>
                                        <th>Isu Kenaikan Harga Barangan</th>
                                        <th>Isu Kekurangan Bekalan Barangan</th>
                                    <?php endif; ?>
                                    <th>Ringkasan Isu</th>
                                    <th>Lokasi Isu</th>
                                    <?php if($kluster->kit_shortform == 'telekomunikasi'): ?>
                                        <th>Mobile Operator</th>
                                        <th>Download Rate (Mbps)</th>
                                        <th>Upload Rate (Mbps)</th>
                                        <th>Ping (ms)</th>
                                        <th>Screenshot</th>
                                    <?php endif; ?>
                                    <?php if($kluster->kit_shortform == 'infrastruktur'): ?>
                                        <th>Persekutuan / PBT</th>
                                    <?php endif; ?>
                                    <th>Cadangan Intervensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(!empty($senaraiLaporan)){
                                foreach($senaraiLaporan as $laporan){
                                    $tarikh_temp[] = $laporan->pengguna_waktu;
                                }
                                array_multisort($tarikh_temp, SORT_DESC, $senaraiLaporan);
                                }
                                foreach($senaraiLaporan as $laporan): 
                                    $namaNegeri = "";
                                    $namaDaerah = "";
                                    $namaPelapor = "";
                                    $daerahNama = $dataDaerah->negeriDaerahNama($laporan->daerah);
                                    if(!empty($daerahNama)){
                                        $namaDaerah = $daerahNama->nama;
                                        $namaNegeri = $daerahNama->nt_nama;
                                    }
                                    $daerahBil = $dataDaerah->daerah($laporan->daerah);
                                    if(!empty($daerahBil)){
                                        $namaDaerah = $daerahBil->nama;
                                        $namaNegeri = $daerahBil->nt_nama;
                                    }
                                    $pl = $dataPengguna->pengguna($laporan->pelapor);
                                    if(!empty($pl)){
                                        $namaPelapor = $pl->nama_penuh;
                                    }
                                    $laporanBil = $laporan->laporanBil;
                                    ?>
                                <tr>
                                    <td><?= $laporan->pengguna_waktu ?></td>
                                    <td><?= $namaPelapor ?></td>
                                    <td><?= $namaNegeri ?></td>
                                    <td><?= $namaDaerah ?></td>
                                    <td><?= $laporan->pt_nama ?></td>
                                    <td><?= $laporan->dun_nama ?></td>
                                    <td><?= $laporan->jenis_kawasan ?></td>
                    <?php if($kluster->kit_shortform == 'politik'): 
                        $laporanBil = $laporan->laporanBil; ?>
                    <td><?= $laporan->isu_politik ?></td>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'alamsekitar'): 
                        $laporanBil = $laporan->laporanBil; ?>
                    <td><?= $laporan->isu_alamsekitar ?></td>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'kesihatan'): 
                        $laporanBil = $laporan->laporanBil; ?>
                    <td><?= $laporan->isu_kesihatan ?></td>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'keselamatan'): 
                        $laporanBil = $laporan->laporanBil; ?>
                    <td><?= $laporan->isu_keselamatan ?></td>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'sosial'): 
                        $laporanBil = $laporan->laporanBil; ?>
                    <td><?= $laporan->isu_sosial ?></td>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'infrastruktur'): 
                        $laporanBil = $laporan->laporanBil; ?>
                    <td><?= $laporan->isu_infrastruktur ?></td>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'telekomunikasi'): 
                        $laporanBil = $laporan->laporanBil; ?>
                    <td><?= $laporan->isu_telekomunikasi ?></td>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'ekonomi'): ?>
                        <td><?= $laporan->isu_ekonomi ?></td>
                        <td>
                            <ol>
                            <?php 
                            $tahun_laporan = date_format(date_create($laporan->tarikh_laporan), 'Y');
                            $senarai_kenaikan_harga = $data_isu->senarai_kenaikan_harga($tahun_laporan, $laporan->pelapor, $laporan->laporanBil);
                            foreach($senarai_kenaikan_harga as $kh): 
                            ?>
                            <li><?= $kh->jenis_barangan ?></li>
                            <?php endforeach; ?>
                            </ol>   
                        </td>
                        <td>
                            <ol>
                                <?php
                                $tahun_laporan = date_format(date_create($laporan->tarikh_laporan), "Y");
                                $senarai_kekurangan_bekalan = $data_isu->senarai_kekurangan_bekalan($tahun_laporan, $laporan->pelapor, $laporanBil);
                                foreach($senarai_kekurangan_bekalan as $kb): ?>
                                <li><?= $kb->jenis_barangan ?></li>
                                <?php endforeach; ?>
                            </ol>
                        </td>
                    <?php endif; ?>
                    <td><?= $laporan->ringkasan_isu ?></td>
                    <td><?= $laporan->lokasi_isu ?></td>
                    <?php if($kluster->kit_shortform == 'telekomunikasi'): 
                        $tahun = date_format(date_create($laporan->tarikh_laporan), 'Y');
                        $isuRangkaian = $data_isu->isuRangkaian($laporanBil, $laporan->pelapor, $tahun);
                        if(!empty($isuRangkaian)) :?>
                        <th><?= $isuRangkaian->mobile_operator ?></th>
                        <th><?= $isuRangkaian->download ?></th>
                        <th><?= $isuRangkaian->upload ?></th>
                        <th><?= $isuRangkaian->ping ?></th>
                        <th>
                            <!-- Full Screen Modal -->
              <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#fullscreenModal<?= $laporanBil ?>">
                Lihat
              </button>

              <div class="modal fade" id="fullscreenModal<?= $laporanBil ?>" tabindex="-1">
                <div class="modal-dialog modal-fullscreen">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Screenshot Speedtest.net By Ookla</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img class="img-fluid" src="<?= base_url() ?>/assets/img/<?= $isuRangkaian->dokumen ?>" alt="Screenshot untuk Isu Telekomunikasi <?= $laporanBil ?>">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-success shadow-sm" data-bs-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Full Screen Modal-->
                        </th>
                    <?php endif; ?>
                    
                    <?php if(empty($isuRangkaian)): ?>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    <?php endif; ?>

                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'infrastruktur'): ?>
                        <td>
                            <?php if(!empty($laporan->kategori)): ?>
                                <?= $laporan->kategori ?></td>
                            <?php endif; ?>
                    <?php endif; ?>
                    <td><?= $laporan->cadangan_intervensi ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            


        </section>
    

</main>


<?php $this->load->view('us_lapis_na/susunletak/bawah'); ?>