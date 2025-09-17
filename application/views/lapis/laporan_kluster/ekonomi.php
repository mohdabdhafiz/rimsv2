<?php $this->load->view('lapis/nav'); ?>

<div class="p-3 border rounded mb-3">
    <h2>Laporan Penuh Kluster Isu: <?= $kluster_isu->kit_nama ?></h2>
    <p><?= $kluster_isu->kit_deskripsi ?></p>

    <div class="table-responsive">
        <table class="table table-sm table-hover table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Timestamp</th>
                    <th>Tarikh Laporan</th>
                    <th>Pelapor</th>
                    <th>Daerah</th>
                    <th>Parlimen</th>
                    <th>DUN</th>
                    <th>DM</th>
                    <th>Jenis Kawasan</th>
                    <th>Kenaikan Harga Barangan</th>
                    <th>Kekurangan Bekalan</th>
                    <th>Isu</th>
                    <th>Keterangan Isu</th>
                    <th>Lokasi Isu</th>
                    <th>Cadangan Intervensi</th>
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
                        <?php $tarikh_laporan = date_format(date_create($laporan->tarikh_laporan), 'd.m.Y');
                        echo $tarikh_laporan;
                        ?>
                    </td>
                    <td>
                        <?php if(!empty($laporan->pelapor)){
                            $pelapor = $data_pengguna->pengguna($laporan->pelapor);
                            echo $pelapor->nama_penuh;
                        } ?>
                    </td>
                    <td><?= $laporan->nama ?></td>
                    <td>
                        <?php 
                        if(!empty($laporan->parlimen)){
                        $parlimen = $data_parlimen->parlimen_bil($laporan->parlimen);
                        echo $parlimen->pt_nama; 
                        } ?>
                    </td>
                    <td>
                        <?php if(!empty($laporan->dun)){
                            $dun = $data_dun->dun_bil($laporan->dun);
                            echo $dun->dun_nama;
                        } ?>
                    </td>
                    <td><?= $laporan->ppt_nama ?></td>
                    <td><?= $laporan->jenis_kawasan ?></td>
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
                            $senarai_kekurangan_bekalan = $data_isu->senarai_kekurangan_bekalan($tahun_laporan, $laporan->pelapor, $laporan->laporanBil);
                            foreach($senarai_kekurangan_bekalan as $kb): ?>
                            <li><?= $kb->jenis_barangan ?></li>
                            <?php endforeach; ?>
                        </ol>
                    </td>
                    <td><?= $laporan->isu_ekonomi ?></td>
                    <td><?= $laporan->ringkasan_isu ?></td>
                    <td><?= $laporan->lokasi_isu ?></td>
                    <td><?= $laporan->cadangan_intervensi ?></td>
                    <td>
                        <?php echo form_open('lapis/proses_padam_laporan'); ?>
                        <input type="hidden" name="input_kluster_shortform" value="<?= $kluster_shortform ?>">
                        <input type="hidden" name="input_tahun_laporan" value="<?= date_format(date_create($laporan->tarikh_laporan), 'Y') ?>">
                        <input type="hidden" name="input_pelapor_bil" value="<?= $laporan->pelapor ?>">
                        <input type="hidden" name="input_laporan_bil" value="<?= $laporan->laporanBil ?>">
                        <button type="submit" class="btn btn-sm btn-outline-danger shadow-sm">
                            <i class="bi bi-trash"></i> 
                            Padam
                        </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <ol class="small text-muted">
        <li>Kolum <strong>Isu</strong> bermula pada 22 Januari 2024.</li>
        <li><strong>DM</strong> merujuk kepada <strong>Daerah Mengundi</strong></li>
    </ol>

</div>