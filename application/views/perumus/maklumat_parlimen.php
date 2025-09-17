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

$tarikh = date('Y-m-d');
?>

<div class="p-3 border rounded mb-3">
    <h1><?= strtoupper($parlimen->pt_nama) ?></h1>
    <div class="row g-3 mt-3">
        <div class="col-12 col-lg-6">
            <?php echo anchor(base_url(), 'LAMAN UTAMA', "class='btn btn-sm btn-outline-primary w-100'"); ?>
        </div>
        <div class="col-12 col-lg-6">
            <?php 
            $negeri = $data_negeri->negeri_nama($parlimen->pt_negeri);
            echo anchor('perumus/maklumat_negeri/'.$negeri->nt_bil, 'SENARAI PARLIMEN '.strtoupper($negeri->nt_nama), "class='btn btn-sm btn-outline-primary w-100'"); ?>
        </div>
    </div>
</div>
<?php 
if(!empty($senarai_pilihanraya)){
foreach($senarai_pilihanraya as $pru): 
    $semakan_jangkaan = $data_calon_parlimen->semak_jangkaan($parlimen->pt_bil, $pru->pilihanraya_bil);

    ?>
<div class="p-3 border rounded mb-3">
    <h2><?= strtoupper($pru->pilihanraya_nama) ?></h2>
    <div class="p-3 border rounded my-3">
        <div class="float-end">
            <?= form_open('japen/set_semula_parlimen') ?>
            <input type="hidden" name="input_parlimen_bil" value="<?= $parlimen->pt_bil ?>">
            <input type="hidden" name="input_pilihanraya_bil" value="<?= $pru->pilihanraya_bil ?>">
            <button type="submit" class="btn btn-danger">SET SEMULA</button>
            </form>
        </div>
        <h3>SENARAI PENCALONAN</h3>
        <div class="table-responsive mt-3">
            <table class="table table-sm table-bordered table-hover">
                <tr class="bg-secondary text-white">
                    <th>BIL</th>
                    <th>CALON</th>
                    <th>PARTI</th>
                    <th>PILIHAN JANGKAAN PEMENANG</th>
                </tr>
                <?php $bilangan = 1;
                    $tmp = $data_calon_parlimen->senarai_calon_tanpa_grading($parlimen->pt_bil, $pru->pilihanraya_bil);
                    $senarai_calon = $data_calon_parlimen->senarai_calon_grading_tarikh($parlimen->pt_bil, $pru->pilihanraya_bil, $tarikh);
                if(empty($senarai_calon) || count($senarai_calon) != count($tmp)){
                    $senarai_calon = $data_calon_parlimen->senaraiCalonDenganGrading($parlimen->pt_bil, $pru->pilihanraya_bil);
                }
                if(count($senarai_calon) != count($tmp)){
                    $senarai_calon = $tmp;
                }
                foreach($senarai_calon as $calon): 
                $parti = $data_parti->parti($calon->pencalonan_parlimen_partiBil);
                ?>
                <tr>
                    <td><?= $bilangan++ ?></td>
                    <td><?php echo strtoupper($calon->ahli_nama); ?></td>
                    <td><?php echo strtoupper($parti->parti_nama); ?> - <?php echo $parti->parti_singkatan; ?></td>
                    <td>
                        <?php if($calon->pencalonan_parlimen_jangkaan_japen != 'MENANG'){ ?>
                        <?php echo form_open('japen/pilihan_calon_parlimen'); ?>
                        <input type="hidden" name="input_calon_bil" value="<?= $calon->pencalonan_parlimen_bil ?>">
                        <input type="hidden" name="input_parlimen_bil" value="<?= $parlimen->pt_bil ?>">
                        <button type="submit" class="btn btn-outline-danger w-100" <?php if(!empty($semakan_jangkaan)){ echo "disabled"; } ?>>PILIH</button>
                        </form>
                        <?php }else{ ?>
                            <button class="btn btn-success w-100" disabled >MENANG</button>
                        <?php } ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

    <div class="p-3 border rounded mb-3">
        <h3>GRADING</h3>

        <div class="row g-3">
            <?php $senarai_harian = $data_harian->senarai_harian($parlimen->pt_bil, $pru->pilihanraya_bil); 
            foreach($senarai_harian as $arkib):
            ?>
            <div class="col-12 col-lg-2">
                <p class="small text-muted p-3 border text-center bg-light"><?php echo anchor('perumus/maklumat_harian/'.$arkib->harian_parlimen_bil, date_format(date_create($arkib->harian_parlimen_tarikh), "d.m.Y")); ?></p>
            </div>
            <?php endforeach; ?>
        </div>


        <?php 
    $hari_ini = date('Y-m-d');
                $bilangan_pengundi = $data_dm->jumlah_pengundi_parlimen($parlimen->pt_bil)->jumlah;
                $parlimen = $data_parlimen->parlimen_bil($parlimen->pt_bil);
                $pengundi = $data_pengundi->pengundi($parlimen->pt_bil, $pru->pilihanraya_bil);
                if($pengundi){
                    $bilangan_pengundi = $pengundi->ppt_jumlah_pengundi;
                }
        ?>


        <?php 
        $harian = $data_harian->sedia_ada($parlimen->pt_bil, $pru->pilihanraya_bil);
        $tarikh = $harian->harian_parlimen_tarikh;
        $harian_bil = $harian->harian_parlimen_bil;
        $harian_parlimen_color = $harian->harian_parlimen_color;
        $harian_parlimen_grading = $harian->harian_parlimen_grading;
        $harian_parlimen_keluar_mengundi = $harian->harian_parlimen_keluar_mengundi;
        $harian_parlimen_atas_pagar = $harian->harian_parlimen_atas_pagar;
        $harian_parlimen_tarikh = $harian->harian_parlimen_tarikh;
        $harian_ulasan = $harian->harian_parlimen_ulasan;
        $harian_parlimen_pengguna_waktu = $harian->harian_parlimen_pengguna_waktu;
        ?>
        <div class="table-responsive">
            <table class="table table-border table-hover table-bordered">
                <tr>
                    <th>Grading</th>
                    <td style="<?= $harian_parlimen_color ?>"><?= $harian_parlimen_grading ?></td>
                </tr>
                <tr>
                    <th>Jumlah Pengundi (Parlimen)</th>
                    <td><?= number_format($data_dm->jumlah_pengundi_parlimen($parlimen->pt_bil)->jumlah, 0, "", ","); ?></td>
                </tr>
                <tr>
                    <th>Jangkaan Keluar Mengundi (Parlimen)</th>
                    <td><?= $harian_parlimen_keluar_mengundi ?> %</td>
                </tr>
                <tr>
                    <th>Atas Pagar / Undi Rosak (Parlimen)</th>
                    <td><?= $harian_parlimen_atas_pagar ?> %</td>
                </tr>
                <tr>
                    <th>Kemaskini Terakhir Pada</th>
                    <td><?= date_format(date_create($harian_parlimen_pengguna_waktu), "d.m.Y H:i:s") ?></td>
                </tr>
            </table>
        </div>
        <?php
        $keseluruhan_jangkaan_keluar_mengundi = 0;
        $keseluruhan_sokong_calon = array();
        $keseluruhan_atas_pagar = 0;
        foreach($senarai_calon as $calon){
            $keseluruhan_sokong_calon[$calon->pencalonan_parlimen_bil] = 0;
        } ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="bg-secondary text-white">
                    <th>DM</th>
                    <th>BILANGAN PENGUNDI (DM)</th>
                    <th colspan=2>JANGKAAN KELUAR MENGUNDI (DM)</th>
                    <?php 
                    foreach($senarai_calon as $calon): 
                        $abr_parti = $data_parti->parti($calon->pencalonan_parlimen_partiBil); ?>
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
                    $senarai_dm = $data_dm->parlimen($parlimen->pt_bil);
                    $jumlah_pengundi = 0;
                    foreach($senarai_dm as $dm): 
                        $seratus = 0;
                    $harian_dm = array();
                    $harian_dm = $data_harian->dm_harian_hari($tarikh, $dm->ppt_bil);
                    if(!empty($harian_dm)){
                    $highest_bn = 0;
                    ?>
                    <tr>
                        <td>
                            <?= $dm->ppt_nama ?>
                        </td>
                        <td>
                            <?php $jumlah_pengundi = $jumlah_pengundi + $dm->ppt_bilangan_pengundi; 
                            echo number_format($dm->ppt_bilangan_pengundi, 0, "", ","); 
                            ?>
                        </td>
                        <td>
                            <?php echo $harian_dm->hdpt_keluar_mengundi; ?>%</td>
                        <td><?php 
                        $jumlah_jangkaan_keluar_mengundi = $harian_dm->hdpt_keluar_mengundi/100*$dm->ppt_bilangan_pengundi;
                        echo number_format(floor($jumlah_jangkaan_keluar_mengundi), 0, "", ",");
                        $keseluruhan_jangkaan_keluar_mengundi = $keseluruhan_jangkaan_keluar_mengundi + $jumlah_jangkaan_keluar_mengundi;
                        
                        ?>
                        </td>
                        <?php $temp_highest_putih = 0; 
                        $temp_highest_not_putih = 0;
                        foreach($senarai_calon as $calon): 
                            $grading = $data_grading->hari($tarikh, $calon->pencalonan_parlimen_bil, $dm->ppt_bil);
                            $grading_hari_ini = number_format(0,2,".",",");
                            if(!empty($grading)){
                                $grading_hari_ini = number_format($grading->sgppt_peratus,2,".",",");
                            }
                            $parti = $data_parti->parti($calon->pencalonan_parlimen_partiBil);
                            ?>
                            <td style="<?php echo $parti->parti_warna; ?>">
                                <?php echo $grading_hari_ini; $seratus = $seratus + $grading->sgppt_peratus; ?>%      
                            </td>
                            <td style="<?php echo $parti->parti_warna; ?>"><?php $pengundi = ($grading->sgppt_peratus/100)*$jumlah_jangkaan_keluar_mengundi; 
                                echo number_format(floor($pengundi), 0, "", ",");
                                $keseluruhan_sokong_calon[$calon->pencalonan_parlimen_bil] = $keseluruhan_sokong_calon[$calon->pencalonan_parlimen_bil] + floor($pengundi);
                            ?>
                            <?php $parti_pilihan = $data_parti->pilihan_parti($calon->pencalonan_parlimen_partiBil); 
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
                            <?= $harian_dm->hdpt_atas_pagar ?>%
                        </td>
                        <td><?php 
                        $seratus = $seratus + $harian_dm->hdpt_atas_pagar;
                        $jumlah_atas_pagar = $harian_dm->hdpt_atas_pagar/100*$jumlah_jangkaan_keluar_mengundi;
                        echo number_format(floor($jumlah_atas_pagar), 0, "", ",");
                        $keseluruhan_atas_pagar = $keseluruhan_atas_pagar + floor($jumlah_atas_pagar);
                        ?></td>
                        <?php $seratus = number_format($seratus, 2, ".", ","); ?>
                        <td style="<?php if($seratus >= 100.01 && $seratus != 100.00){ echo "background-color:red; color:white;"; } ?><?php if($seratus <= 99.99 && $seratus != 100.00){ echo "background-color:yellow; color:black;"; } ?>"><?php echo $seratus; ?>%</td>
                        <td><?php $majoriti = $temp_highest_putih - $temp_highest_not_putih;  
                        echo number_format($majoriti, 0, "", ",");
                        ?></td>
                        <td><?php 
                        $peratus_majoriti = 0;
                        if(!empty($jumlah_jangkaan_keluar_mengundi)){
                            $peratus_majoriti = ($majoriti/floor($jumlah_jangkaan_keluar_mengundi))*100;
                        }
                        $peratusan = number_format($peratus_majoriti, 2, ".", ","); echo $peratusan; ?>%</td>
                        <?php $status_grading_dm = grading_status($peratusan); ?>
                        <td style="<?php echo $status_grading_dm['warna']; ?>"><?php echo $status_grading_dm['grade']; ?></td>
                    </tr>
                    <?php } endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="bg-light">
                        <?php $seratus = 0; ?>
                        <th>JUMLAH</th>
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
                        $parti_calon = $data_parti->parti($calon->pencalonan_parlimen_partiBil);?>
                        <td style="<?php echo $parti_calon->parti_warna; ?>"><?php 
                        $peratus_sokongan = 0;
                        if(!empty($keseluruhan_jangkaan_keluar_mengundi)){
                            $peratus_sokongan = $keseluruhan_sokong_calon[$calon->pencalonan_parlimen_bil] / $keseluruhan_jangkaan_keluar_mengundi * 100; 
                        }
                        echo number_format($peratus_sokongan, 2, '.', ','); 
                        $seratus = $seratus + $peratus_sokongan; ?> %
                        <input type="hidden" name="input_grading_parlimen[<?= $calon->pencalonan_parlimen_bil ?>]" value="<?= $keseluruhan_sokong_calon[$calon->pencalonan_parlimen_bil] ?>"></td>
                        <td style="<?php echo $parti_calon->parti_warna; ?>"><?php echo number_format($keseluruhan_sokong_calon[$calon->pencalonan_parlimen_bil], 0, "", ","); 
                        $parti_pilihan = $data_parti->pilihan_parti($calon->pencalonan_parlimen_partiBil);
                        if(!empty($parti_pilihan)){
                            if($tmp_putih <= $keseluruhan_sokong_calon[$calon->pencalonan_parlimen_bil]){
                                $tmp_putih = $keseluruhan_sokong_calon[$calon->pencalonan_parlimen_bil];
                            }
                        }else{
                            if($tmp_not_putih <= $keseluruhan_sokong_calon[$calon->pencalonan_parlimen_bil]){
                                $tmp_not_putih = $keseluruhan_sokong_calon[$calon->pencalonan_parlimen_bil];
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
                        <th>JUSTIFIKASI</th>
                        <td colspan=<?= 9 + count($senarai_calon)*2 ?>><?php echo $harian_ulasan; ?></td>
                    </tr>
                </tfoot>
            </table>


    </div>


    </div>

</div>
<?php 
endforeach; 
}?>