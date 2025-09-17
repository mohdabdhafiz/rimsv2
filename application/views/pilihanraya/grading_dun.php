<?php
function grading_status($majoriti){
    $grade = 'BELUM DITETAPKAN';
    $warna = 'background:red; color:white';
    if(10.00 <= $majoriti){
        $grade = 'PUTIH';
        $warna = 'background:white; color:black';
    }
    if($majoriti >= 0.00 && $majoriti < 10.00){
        $grade = 'KELABU PUTIH';
        $warna = 'background:#BEBEBE; color:black';
    }
    if($majoriti < 0.00 && $majoriti > -10.00){
        $grade = 'KELABU HITAM';
        $warna = 'background:#696969; color:white';
    }
    if($majoriti <= -10.00){
        $grade = 'HITAM';
        $warna = 'background:#000000; color:white';
    }
    $grading = array(
        'grade' => $grade,
        'warna' => $warna
    );
    return $grading;
}
?>


<div class="container-fluid mb-3">
    
    <div class="p-3 border rounded mb-3">
        <h1>GRADING MENGIKUT PILIHANRAYA</h1>
        <p><?= $pru->pilihanraya_nama ?></p>
        <?php echo anchor(base_url(), 'Laman Utama', "class='btn btn-primary w-100 mt-3'"); ?>
    </div>

    <?php 
    $hari_ini = date('Y-m-d');
    if($pru->pilihanraya_jenis == "DUN"){ 
        foreach($senarai_tugas_dun as $tugas):
            $ada = $data_pilihanraya->semak_dun($pru->pilihanraya_bil, $tugas->tdt_dun_bil);
            if(!empty($ada)){
                $bilangan_pengundi = $data_dm->jumlah_pengundi_dun($tugas->tdt_dun_bil)->jumlah;
                $dun = $data_dun->dun_bil($tugas->tdt_dun_bil);
                $pengundi = $data_pengundi->pengundi($tugas->tdt_dun_bil, $pru->pilihanraya_bil);
                if($pengundi){
                    $bilangan_pengundi = $pengundi->pdt_jumlah_pengundi;
                }
        ?>

    <div class="p-3 border rounded mb-3">
        <h2><?= $dun->dun_nama ?></h2>
        <p>Tarikh: <?= date("d.m.Y") ?></p>
        <?php 
        $harian = $data_harian->semasa_dun($tugas->tdt_dun_bil);
        if(empty($harian)){
            $harian_color = "";
            $harian_grading = "BELUM DITETAPKAN";
            $harian_keluar_mengundi = 70;
            $harian_atas_pagar = "BELUM DITETAPKAN";
            $harian_tarikh = date("Y-m-d");
            $pengguna_bil = $this->session->userdata('pengguna_bil');
            $waktu_pengguna = date("Y-m-d H:i:s");
            $ulasan = "TIADA";
            $data_harian->tambah_harian_dun($harian_grading, $harian_tarikh, $tugas->tdt_dun_bil, $pengguna_bil, $waktu_pengguna, $ulasan);
            $harian = $data_harian->semasa_dun($tugas->tdt_dun_bil);
        }
        $harian_bil = $harian->harian_bil;
        $harian_color = $harian->harian_color;
        $harian_grading = $harian->harian_grading;
        $harian_keluar_mengundi = $harian->harian_keluar_mengundi;
        $harian_atas_pagar = $harian->harian_atas_pagar;
        $harian_tarikh = $harian->harian_tarikh;
        $harian_ulasan = $harian->harian_ulasan;
        ?>
        <div class="table-responsive">
            <table class="table table-border table-hover table-bordered">
                <tr>
                    <th>Grading</th>
                    <td style="<?= $harian_color ?>"><?= $harian_grading ?></td>
                </tr>
                <tr>
                    <th>Jumlah Pengundi (Parlimen)</th>
                    <td><?= number_format($data_dm->jumlah_pengundi_dun($tugas->tdt_dun_bil)->jumlah, 0, "", ","); ?></td>
                </tr>
                <tr>
                    <th>Jangkaan Keluar Mengundi (Parlimen)</th>
                    <td><?= $harian_keluar_mengundi ?> %</td>
                </tr>
                <tr>
                    <th>Atas Pagar / Undi Rosak (Parlimen)</th>
                    <td><?= $harian_atas_pagar ?> %</td>
                </tr>
                <tr>
                    <th>Kemaskini Terakhir Pada</th>
                    <td><?= date_format(date_create($harian_tarikh), "d.m.Y") ?></td>
                </tr>
            </table>
        </div>
        <?php 
        $tmp = $data_calon->senaraiCalon($tugas->tdt_dun_bil, $pru->pilihanraya_bil);
        $senarai_calon = $data_calon->senarai_calon_tanpa_grading($tugas->tdt_dun_bil, $pru->pilihanraya_bil);
        if(count($senarai_calon) == count($tmp)){
            $senarai_calon = $tmp;
        }
        $keseluruhan_jangkaan_keluar_mengundi = 0;
        $keseluruhan_sokong_calon = array();
        $keseluruhan_atas_pagar = 0;
        foreach($senarai_calon as $calon){
            $keseluruhan_sokong_calon[$calon->pencalonan_bil] = 0;
        }
        echo form_open('grading/proses_grading_dun'); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="bg-secondary text-white">
                    <th>DM</th>
                    <th>BILANGAN PENGUNDI (DM)</th>
                    <th colspan=2>JANGKAAN KELUAR MENGUNDI (DM)</th>
                    <?php 
                    foreach($senarai_calon as $calon): 
                        $abr_parti = $data_parti->parti($calon->pencalonan_parti); ?>
                    <th colspan=2 style="<?php echo $abr_parti->parti_warna; ?>"><?php  echo "SOKONG ".$abr_parti->parti_singkatan; ?><br />
                    <?php echo strtoupper($calon->ahli_nama); ?>
                    </th>
                    <?php endforeach; ?>
                    <th colspan=2>ATAS PAGAR / UNDI ROSAK</th>
                    <th>100%</th>
                    <th>MAJORITI</th>
                    <th>PERATUS MAJORITI</th>
                    <th>GRADING</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $senarai_dm = $data_dm->dun($tugas->tdt_dun_bil);
                    $jumlah_pengundi = 0;
                    foreach($senarai_dm as $dm): 
                        $seratus = 0;
                    $harian_dm = array();
                    $harian_dm = $data_harian->dm_semasa($dm->pdt_bil);
                    $highest_bn = 0;
                    if(empty($harian_dm)){
                        $pengundi = $dm->pdt_bilangan_pengundi;
                        $keluar_mengundi = 70;
                        $atas_pagar = 100;
                        $dun_bil = $tugas->tdt_dun_bil;
                        $pdm_bil = $dm->pdt_bil;
                        $sekarang = date('Y-m-d H:i:s');
                        $data_harian->tambah_harian_pdm($pengundi, $keluar_mengundi, $atas_pagar, $dun_bil, $pdm_bil, $sekarang);
                        $harian_dm = $data_harian->dm_harian($hari_ini, $dm->pdt_bil);
                    }
                    ?>
                    <tr>
                        <td>
                            <?= $dm->pdt_nama ?>
                            <input type="hidden" name="input_dm_bil[]" value="<?= $dm->pdt_bil ?>">
                        </td>
                        <td>
                            <?php $jumlah_pengundi = $jumlah_pengundi + $dm->pdt_bilangan_pengundi; 
                            echo number_format($dm->pdt_bilangan_pengundi, 0, "", ","); 
                            ?>
                            <input type="hidden" name="input_hddt_bil[]" value="<?= $harian_dm->hddt_bil ?>">
                            <input type="hidden" name="input_hddt_pengundi[]" value="<?= $dm->pdt_bilangan_pengundi ?>">
                        </td>
                        <td>
                            <input type="text" name="input_hddt_keluar_mengundi[]" id="input_hddt_keluar_mengundi[]" value="<?php echo $harian_dm->hddt_keluar_mengundi; ?>"></td>
                        <td><?php 
                        $jumlah_jangkaan_keluar_mengundi = $harian_dm->hddt_keluar_mengundi/100*$dm->pdt_bilangan_pengundi;
                        echo number_format(floor($jumlah_jangkaan_keluar_mengundi), 0, "", ",");
                        $keseluruhan_jangkaan_keluar_mengundi = $keseluruhan_jangkaan_keluar_mengundi + $jumlah_jangkaan_keluar_mengundi;
                        
                        ?>
                        </td>
                        <?php $temp_highest_putih = 0; 
                        $temp_highest_not_putih = 0;
                        foreach($senarai_calon as $calon): 
                            
                            $grading = "";
                            $grading = $data_grading->hari_ini_pdm_dun($calon->pencalonan_bil, $dm->pdt_bil);
                            $grading_hari_ini = number_format(0,2,".",",");
                            if(empty($grading)){
                                $pencalonan_bil = $calon->pencalonan_bil;
                                $peratus = 0;
                                $dm_bil = $dm->pdt_bil;
						        $this->status_grading_model->tambah_grading_pdm_dun(date("Y-m-d"), $pencalonan_bil, $peratus, $dm_bil);
                                $grading = $data_grading->hari_ini_pdm_dun($calon->pencalonan_bil, $dm->pdt_bil);
                            }
                            $parti = $data_parti->parti($calon->pencalonan_parti);
                            ?>
                            <td style="<?php echo $parti->parti_warna; ?>">
                                <input type="hidden" name="input_grading_bil[<?= $calon->pencalonan_bil ?>][]" value="<?= $grading->sgpdt_bil ?>">
                                <input type="text" name="input_grading[<?= $calon->pencalonan_bil ?>][]" id="input_grading[<?= $calon->pencalonan_bil ?>][]" value="<?php echo $grading->sgpdt_peratus; $seratus = $seratus + $grading->sgpdt_peratus; ?>">
                                
                            </td>
                            <td style="<?php echo $parti->parti_warna; ?>"><?php $pengundi = ($grading->sgpdt_peratus/100)*$jumlah_jangkaan_keluar_mengundi; 
                                echo number_format(floor($pengundi), 0, "", ",");
                                $keseluruhan_sokong_calon[$calon->pencalonan_bil] = $keseluruhan_sokong_calon[$calon->pencalonan_bil] + floor($pengundi);
                            ?>
                            <?php $parti_pilihan = $data_parti->pilihan_parti($calon->pencalonan_parti); 
                                $pengundi = floor($pengundi);
                                if(!empty($parti_pilihan)){
                                    if($pengundi >= $temp_highest_putih){
                                        $temp_highest_putih = $pengundi;
                                    }
                                }else{
                                    if($pengundi >= $temp_highest_not_putih){
                                        $temp_highest_not_putih = $pengundi;
                                    }
                                }
                                ?>
                            </td>
                            <?php endforeach; ?>
                        <td>
                            <input type="text" name="input_hddt_atas_pagar[]" id="input_hddt_atas_pagar[]" value="<?= $harian_dm->hddt_atas_pagar ?>">
                        </td>
                        <td><?php 
                        $seratus = $seratus + $harian_dm->hddt_atas_pagar;
                        $jumlah_atas_pagar = $harian_dm->hddt_atas_pagar/100*$jumlah_jangkaan_keluar_mengundi;
                        echo number_format(floor($jumlah_atas_pagar), 0, "", ",");
                        $keseluruhan_atas_pagar = $keseluruhan_atas_pagar + floor($jumlah_atas_pagar);
                        ?></td>
                        <td style="<?php if($seratus > 100){ echo "background-color:red; color:white;"; } ?>"><?php echo number_format($seratus, 2, ".", ","); ?> %</td>
                        <td><?php $majoriti = $temp_highest_putih - $temp_highest_not_putih;  
                        echo number_format($majoriti, 0, "", ",");
                        ?></td>
                        <td><?php 
                        $peratus_majoriti = 0;
                        if(!empty($jumlah_jangkaan_keluar_mengundi)){
                            $peratus_majoriti = ($majoriti/floor($jumlah_jangkaan_keluar_mengundi))*100;
                        }
                        $peratusan = number_format($peratus_majoriti, 2, ".", ","); echo $peratusan; ?> %</td>
                        <?php $status_grading_dm = grading_status($peratusan); ?>
                        <td style="<?php echo $status_grading_dm['warna']; ?>"><?php echo $status_grading_dm['grade']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="bg-light">
                        <?php $seratus = 0; ?>
                        <td>JUMLAH</td>
                        <td><?= number_format($jumlah_pengundi, 0, "", ",") ?></td>
                        <td><?php 
                        $peratus = 0;
                        if(!empty($jumlah_pengundi)){
                            $peratus = ($keseluruhan_jangkaan_keluar_mengundi / $jumlah_pengundi) * 100; 
                        }
                        echo number_format($peratus, 2, ".", ""); ?> %</td>
                        <td><?= number_format($keseluruhan_jangkaan_keluar_mengundi, 0, "", ",") ?>
                        <input type="hidden" name="input_pengundi_keluar" value="<?= $keseluruhan_jangkaan_keluar_mengundi ?>">
                        </td>
                        <?php 
                        $tmp_putih = 0;
                        $tmp_not_putih = 0;
                        foreach($senarai_calon as $calon): 
                        $parti_calon = $data_parti->parti($calon->pencalonan_parti);?>
                        <td style="<?php echo $parti_calon->parti_warna; ?>"><?php 
                        $peratus_sokongan = 0;
                        if(!empty($keseluruhan_jangkaan_keluar_mengundi)){
                            $peratus_sokongan = $keseluruhan_sokong_calon[$calon->pencalonan_bil] / $keseluruhan_jangkaan_keluar_mengundi * 100; 
                        }
                        echo number_format($peratus_sokongan, 2, '.', ','); 
                        $seratus = $seratus + $peratus_sokongan; ?> %
                        <input type="hidden" name="input_grading_dun[<?= $calon->pencalonan_bil ?>]" value="<?= $keseluruhan_sokong_calon[$calon->pencalonan_bil] ?>"></td>
                        <td style="<?php echo $parti_calon->parti_warna; ?>"><?php echo number_format($keseluruhan_sokong_calon[$calon->pencalonan_bil], 0, "", ","); 
                        $parti_pilihan = $data_parti->pilihan_parti($calon->pencalonan_parti);
                        if(!empty($parti_pilihan)){
                            if($tmp_putih <= $keseluruhan_sokong_calon[$calon->pencalonan_bil]){
                                $tmp_putih = $keseluruhan_sokong_calon[$calon->pencalonan_bil];
                            }
                        }else{
                            if($tmp_not_putih <= $keseluruhan_sokong_calon[$calon->pencalonan_bil]){
                                $tmp_not_putih = $keseluruhan_sokong_calon[$calon->pencalonan_bil];
                            }
                        }
                        ?>
                        </td>
                        <?php endforeach; ?>
                        <td>
                            <?php 
                            $peratus_atas_pagar = 0;
                            if(!empty($keseluruhan_jangkaan_keluar_mengundi)){
                                $peratus_atas_pagar = ($keseluruhan_atas_pagar / $keseluruhan_jangkaan_keluar_mengundi) * 100; 
                            }
                            echo number_format($peratus_atas_pagar, 2, '.', ''); 
                            $seratus = $seratus + $peratus_atas_pagar; ?> % 
                        </td>
                        <td><?= number_format($keseluruhan_atas_pagar, 0, "", ","); ?></td>
                        <td><?= number_format($seratus, 2, '.', ','); ?> %</td>
                        <td><?php $majoriti = $tmp_putih - $tmp_not_putih; 
                        echo number_format($majoriti, 0, "", ","); ?></td>
                        <td><?php 
                        $peratusan = 0;
                        if(!empty($keseluruhan_jangkaan_keluar_mengundi)){
                            $peratusan = number_format($majoriti/$keseluruhan_jangkaan_keluar_mengundi*100, 2, ".", ",");
                        }
                         echo $peratusan; ?> %</td>
                        <?php $status_grading_parlimen = grading_status($peratusan); ?>
                        <td style="<?php echo $status_grading_parlimen['warna']; ?>"><?php echo $status_grading_parlimen['grade']; ?></td>
                    </tr>
                    <tr>
                        <td>JUSTIFIKASI</td>
                        <td colspan=<?= 9 + count($senarai_calon)*2 ?>><textarea name="input_harian_ulasan" id="input_harian_ulasan" cols="30" rows="10" class="form-control"><?php echo $harian_ulasan; ?></textarea></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <input type="hidden" name="input_harian_bil" value="<?= $harian_bil ?>">
        <input type="hidden" name="input_dun_bil" value="<?= $dun->dun_bil ?>">
        <input type="hidden" name="input_pilihanraya_bil" value="<?= $pru->pilihanraya_bil ?>">
        <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
    </div>

    <?php } 
    endforeach; 
} ?>


</div>