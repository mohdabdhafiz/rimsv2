<?php $this->load->view('cpi/nav'); ?>

<div class="p-3 border rounded mb-3">
    <p><strong>Laporan Penuh Kluster <?= $kluster->kit_nama ?></strong></p>
    <?php
    if(empty($senarai_laporan)){
    ?>
        <p>Tiada laporan.</p>
    <?php
    }
    ?>
    <?php
    if(!empty($senarai_laporan)):
    ?>
    <div class="table-responsive">
        <table class="table table-sm table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>Timestamp</th>
                    <th>Pelapor</th>
                    <th>Negeri</th>
                    <th>Daerah</th>
                    <th>Parlimen</th>
                    <th>DUN</th>
                    <th>Jenis Kawasan</th>
                    <?php if($kluster->kit_shortform != 'ekonomi'): ?>
                    <th>Isu</th>
                    <?php endif; ?>
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
                $bilangan = 1;
                foreach($senarai_laporan as $laporan){
                    $tarikh_temp[] = $laporan->pengguna_waktu;
                }
                array_multisort($tarikh_temp, SORT_DESC, $senarai_laporan);
                //array_multisort(array_column($senarai_laporan, 'pelapor'), SORT_DESC, $senarai_laporan);
                foreach($senarai_laporan as $laporan): ?>
                <tr>
                    <td><?= $laporan->pengguna_waktu ?></td>
                    <td><?php $pelapor = $data_pengguna->pengguna($laporan->pelapor);
                    echo $pelapor->nama_penuh ?>
                    </td>
                    <td>
                    <?php
                        $negeri = "BELUM DITETAPKAN";
                        $paparanDaerah = $dataDaerah->daerah($laporan->daerah);
                        if(!empty($paparanDaerah)){
                            $negeri = $paparanDaerah->nt_nama;
                        }
                        echo $negeri;
                        ?>
                    </td>
                    <td>
                        <?php
                        $daerah = $laporan->daerah;
                        $paparanDaerah = $dataDaerah->daerah($laporan->daerah);
                        if(!empty($paparanDaerah)){
                            $daerah = $paparanDaerah->nama;
                        }
                        ?>

                        <?= $daerah ?>
                    </td>
                    <td><?= $laporan->pt_nama ?></td>
                    <td><?= $laporan->dun_nama ?></td>
                    <td><?= $laporan->jenis_kawasan ?></td>
                    <?php if($kluster->kit_shortform == 'politik'): ?>
                    <td><?= $laporan->isu_politik ?></td>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'alamsekitar'): ?>
                    <td><?= $laporan->isu_alamsekitar ?></td>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'kesihatan'): ?>
                    <td><?= $laporan->isu_kesihatan ?></td>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'keselamatan'): ?>
                    <td><?= $laporan->isu_keselamatan ?></td>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'sosial'): ?>
                    <td><?= $laporan->isu_sosial ?></td>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'infrastruktur'): ?>
                    <td><?= $laporan->isu_infrastruktur ?></td>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'ekonomi'): ?>
                        <td>
                            <ol>
                            <?php 
                            $tahun_laporan = date_format(date_create($laporan->tarikh_laporan), 'Y');
                            $senarai_kenaikan_harga = $data_isu->senarai_kenaikan_harga($tahun_laporan, $laporan->pelapor, $laporan->bil);
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
                                $senarai_kekurangan_bekalan = $data_isu->senarai_kekurangan_bekalan($tahun_laporan, $laporan->pelapor, $laporan->bil);
                                foreach($senarai_kekurangan_bekalan as $kb): ?>
                                <li><?= $kb->jenis_barangan ?></li>
                                <?php endforeach; ?>
                            </ol>
                        </td>
                    <?php endif; ?>
                    <?php if($kluster->kit_shortform == 'telekomunikasi'): ?>
                    <td><?= $laporan->isu_telekomunikasi ?></td>
                    <?php endif; ?>
                    <td><?= $laporan->ringkasan_isu ?></td>
                    <td><?= $laporan->lokasi_isu ?></td>
                    <?php if($kluster->kit_shortform == 'telekomunikasi'): 
                        $tahun = date_format(date_create($laporan->tarikh_laporan), 'Y');
                        $isuRangkaian = $data_isu->isuRangkaian($laporan->telekomunikasiBil, $laporan->pelapor, $tahun);
                        if(!empty($isuRangkaian)) :?>
                        <td><?= $isuRangkaian->mobile_operator ?></td>
                        <td><?= $isuRangkaian->download ?></td>
                        <td><?= $isuRangkaian->upload ?></td>
                        <td><?= $isuRangkaian->ping ?></td>
                        <td>
                            <!-- Full Screen Modal -->
              <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#fullscreenModal<?= $laporan->telekomunikasiBil ?>">
                Lihat
              </button>

              <div class="modal fade" id="fullscreenModal<?= $laporan->telekomunikasiBil ?>" tabindex="-1">
                <div class="modal-dialog modal-fullscreen">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Screenshot Speedtest.net By Ookla</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img class="img-fluid" src="<?= base_url() ?>/assets/img/<?= $isuRangkaian->dokumen ?>" alt="Screenshot untuk Isu Telekomunikasi #<?= $laporan->telekomunikasiBil ?>">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline-success shadow-sm" data-bs-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Full Screen Modal-->
                        </td>
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
                        <td><?= $laporan->kategori ?></td>
                    <?php endif; ?>
                    <td>
                        <?php if(!empty($laporan->cadangan_intervensi)): ?>
                        <?= $laporan->cadangan_intervensi ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
    endif;
    ?>
</div>