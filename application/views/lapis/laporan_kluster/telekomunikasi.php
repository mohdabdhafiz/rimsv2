<?php $this->load->view('lapis/nav'); ?>

<div class="p-3 border rounded mb-3">
    <h2>Laporan Penuh Kluster Isu: <?= $kluster_isu->kit_nama ?></h2>
    <p><?= $kluster_isu->kit_deskripsi ?></p>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>Timestamp</th>
                    <th>Tarikh Laporan</th>
                    <th>Pelapor</th>
                    <th>Daerah</th>
                    <th>Parlimen</th>
                    <th>DUN</th>
                    <th>Jenis Kawasan</th>
                    <th>Isu-isu telekomunikasi</th>
                    <th>Ringkasan Isu</th>
                    <th>Lokasi Isu</th>
                    <th>Screenshot Speedtest.net</th>
                    <th>Status</th>
                    <th>Operasi</th>
                </tr>
            </thead>
            <tbody>
                <?php $bilangan = 1;
                $masa = array();
                foreach($senarai_laporan as $laporan){
                    $masa[] = $laporan->pengguna_waktu;
                }
                array_multisort($masa, SORT_DESC, $senarai_laporan);
                foreach($senarai_laporan as $laporan): 
                ?>
                <tr>
                    <td><?= $bilangan++ ?></td>
                    <td><?= $laporan->pengguna_waktu ?></td>
                    <td>
                        <?php
                        $tarikh_laporan = date_format(date_create($laporan->tarikh_laporan), 'd.m.Y');
                        echo $tarikh_laporan;
                        ?>
                    </td>
                    <td>
                        <?php $pelapor = $data_pengguna->pengguna($laporan->pelapor);
                        echo $pelapor->nama_penuh;
                        ?>
                    </td>
                    <td><?= $laporan->daerahNama ?></td>
                    <td>
                        <?php 
                        if(!empty($laporan->parlimen)){
                            $parlimen = $data_parlimen->parlimen_bil($laporan->parlimen);
                            echo $parlimen->pt_nama; 
                        } ?>
                    </td>
                    <td>
                        <?php 
                        if(!empty($laporan->dun)){
                        $dun = $data_dun->dun_bil($laporan->dun);
                        echo $dun->dun_nama; 
                        } ?>
                    </td>
                    <td><?= $laporan->jenis_kawasan ?></td>
                    <td><?= $laporan->isu_telekomunikasi ?></td>
                    <td><?= $laporan->ringkasan_isu ?></td>
                    <td><?= $laporan->lokasi_isu ?></td>

                        <?php 
                        $tahun = date_format(date_create($laporan->tarikh_laporan), 'Y');
                        if($laporan->isu_telekomunikasi == 'Rangkaian Internet / Data'): 
                            $isuRangkaian = $data_isu->isuRangkaian($laporan->laporanBil, $laporan->pelapor, $tahun); ?>
                            <?php if(!empty($isuRangkaian)): ?>
                            <td>

                                <!-- Button trigger modal -->
<button type="button" class="btn btn-outline-primary shadow-sm" data-toggle="modal" data-target="#exampleModalCenter<?= $laporan->laporanBil ?>">
  Lihat
</button>

<!-- Modal -->
<div class="modal" id="exampleModalCenter<?= $laporan->laporanBil ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle<?= $laporan->laporanBil ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle<?= $laporan->laporanBil ?>"><?= $laporan->isu_telekomunikasi ?></h5>
        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
            <div class="col-12 col-lg-6">
                <img class="img-fluid" src="<?= base_url() ?>/assets/img/<?= $isuRangkaian->dokumen ?>" alt="Screenshot untuk Isu Telekomunikasi <?= $laporan->laporanBil ?>">
            </div>
            <div class="col-12 col-lg-6">
                <p>
                    <strong>Mobile Operator:</strong>
                    <br><?= $isuRangkaian->mobile_operator ?>
                </p>
                <p>
                    <strong>Download Rate (Mbps):</strong>
                    <br><?= $isuRangkaian->download ?>
                </p>
                <p>
                    <strong>Upload Rate (Mbps):</strong>
                    <br><?= $isuRangkaian->upload ?>
                </p>
                <p>
                    <strong>Ping Rate (ms):</strong>
                    <br><?= $isuRangkaian->ping ?>
                </p>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary shadow-sm" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

                            </td>
                            <?php endif; ?>

                            <?php if(empty($isuRangkaian)): ?>
                            <td style="background-color:red; color:white;">Tiada</td>
                            <?php endif; ?>
                        <?php endif; ?>
                        
                        <?php if($laporan->isu_telekomunikasi != 'Rangkaian Internet / Data'){ ?>
                            <td>Tidak Berkaitan</td>
                        <?php } ?>

                    <td>
                        <?php
                            switch($laporan->tapisan){
                                case 'Draf' :
                                    echo 'Draf';
                                    break;
                                case 'Hantar Negeri' :
                                    echo 'Telah dihantar ke JaPen Negeri';
                                    break;
                                case 'Hantar HQ' :
                                    echo 'Telah dihantar ke BGSPI JaPen';
                                    break;
                                case 'Terima' : 
                                    echo 'Laporan diterima oleh BGSPI';
                                    break;
                                default :
                                    echo 'Tidak berkaitan';
                            }
                        ?>
                    </td>
                    <td>
                        <?php if($laporan->tapisan == 'Draf'): ?>
                    <div class="row g-1">
                           
                        <div class="col-auto">
                    <?php echo form_open('lapis/proses_hantar'); ?>
                            <input type="hidden" name="input_kluster_bil" value="<?= $kluster_isu->kit_bil ?>">
                        <input type="hidden" name="input_kluster_shortform" value="<?= $kluster_shortform ?>">
                        <input type="hidden" name="input_tahun_laporan" value="<?= date_format(date_create($laporan->tarikh_laporan), 'Y') ?>">
                        <input type="hidden" name="input_pelapor_bil" value="<?= $laporan->pelapor ?>">
                        <input type="hidden" name="input_laporan_bil" value="<?= $laporan->laporanBil ?>">
                        <button type="submit" class="btn btn-outline-success shadow-sm">Hantar</button>
                        </form>
                        </div>


                        <div class="col-auto">
                        <?php echo form_open('lapis/proses_padam_laporan'); ?>
                        <input type="hidden" name="input_kluster_shortform" value="<?= $kluster_shortform ?>">
                        <input type="hidden" name="input_tahun_laporan" value="<?= date_format(date_create($laporan->tarikh_laporan), 'Y') ?>">
                        <input type="hidden" name="input_pelapor_bil" value="<?= $laporan->pelapor ?>">
                        <input type="hidden" name="input_laporan_bil" value="<?= $laporan->laporanBil ?>">
                        <button type="submit" class="btn btn-outline-danger shadow-sm">Padam</button>
                        </form>
                        </div>

                        </div>
                        <?php endif; ?>

                        <div class="row g-1">
                           
                        


                        <div class="col-auto">
                        <?php echo form_open('lapis/proses_padam_laporan'); ?>
                        <input type="hidden" name="input_kluster_shortform" value="<?= $kluster_shortform ?>">
                        <input type="hidden" name="input_tahun_laporan" value="<?= date_format(date_create($laporan->tarikh_laporan), 'Y') ?>">
                        <input type="hidden" name="input_pelapor_bil" value="<?= $laporan->pelapor ?>">
                        <input type="hidden" name="input_laporan_bil" value="<?= $laporan->laporanBil ?>">
                        <button type="submit" class="btn btn-outline-danger shadow-sm">Padam</button>
                        </form>
                        </div>

                        </div>

                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>