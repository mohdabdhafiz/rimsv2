<?php 
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/sidebar');
$this->load->view('ppd_na/susunletak/navbar');
?>

<?php
function warnaGrading($grading){
    $warna = "";
    switch($grading){
        case 'PUTIH': 
            $warna = 'background:white; color:black';
            break;
        case 'KELABU PUTIH':
            $warna = 'background:#BEBEBE; color:black';
            break;
        case 'KELABU HITAM' :
            $warna = 'background:#696969; color:white';
            break;
        case 'HITAM' :
            $warna = 'background:#000000; color:white';
            break;
    }   
    return $warna;
}

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

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('harian') ?>">Harian</a></li>
                <li class="breadcrumb-item active">Grading Harian DUN <?= strtoupper($dun->dun_nama) ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Kemaskini Grading</h1>
            <p><strong>DUN</strong>: <?= strtoupper($dun->dun_nama) ?>
            <br><strong>Tarikh</strong>: <?= $harian->harian_tarikh ?></p>
            <?php echo form_open('grading/proses_grading_dun_kedua'); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="bg-secondary text-white">
                    <th class="text-center" valign="middle">DAERAH MENGUNDI (DM)</th>
                    <th class="text-center" valign="middle">BILANGAN PENGUNDI (DM)</th>
                    <th class="text-center" valign="middle" colspan=2>JANGKAAN KELUAR MENGUNDI (DM)</th>
                    <?php 
                    $keseluruhan_sokong_calon = array();
                    foreach($senaraiCalon as $calon): 
                        $keseluruhan_sokong_calon[$calon->pencalonan_bil] = 0;
                        ?>
                    <th class="text-center" valign="middle" colspan=2 style="<?php echo $calon->parti_warna; ?>"><?php  echo "SOKONG ".$calon->parti_singkatan; ?><br />
                    <?php echo strtoupper($calon->ahli_nama); ?>
                    </th>
                    <?php endforeach; ?>
                    <th class="text-center" valign="middle" colspan=2>ATAS PAGAR / UNDI ROSAK</th>
                    <th class="text-center" valign="middle">100%</th>
                    <th class="text-center" valign="middle">MAJORITI (GRADING)</th>
                    <th class="text-center" valign="middle">PERATUS MAJORITI (GRADING)</th>
                    <th class="text-center" valign="middle">STATUS GRADING</th>
                    <th class="text-center" valign="middle">PILIHAN PARTI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $jumlah_pengundi = 0;
                    $keseluruhan_jangkaan_keluar_mengundi = 0;
                    $keseluruhan_atas_pagar = 0;
                    foreach($senaraiDM as $dm): 
                        $seratus = 0;
                    $highest_bn = 0;
                    ?>
                    <tr>
                        <td class="text-center" valign="middle">
                            <?= $dm->pdt_nama ?>
                            <input type="hidden" name="input_dm_bil[]" value="<?= $dm->pdt_bil ?>">
                        </td>
                        <td class="text-center" valign="middle">
                            <?php $jumlah_pengundi = $jumlah_pengundi + $dm->pdt_bilangan_pengundi; 
                            echo number_format($dm->pdt_bilangan_pengundi, 0, "", ","); 
                            ?>
                            <input type="hidden" name="input_hddt_bil[]" value="<?= $dm->hddt_bil ?>">
                            <input type="hidden" name="input_hddt_pengundi[]" value="<?= $dm->pdt_bilangan_pengundi ?>">
                        </td>
                        <td class="text-center" valign="middle">
                            <input class="form-control text-center bg-light m-auto" style="width:100px;" type="text" name="input_hddt_keluar_mengundi[]" id="input_hddt_keluar_mengundi[]" value="<?php echo $dm->hddt_keluar_mengundi; ?>"></td>
                        <td class="text-center" valign="middle"><?php 
                        $jumlah_jangkaan_keluar_mengundi = $dm->hddt_keluar_mengundi/100*$dm->pdt_bilangan_pengundi;
                        echo number_format(floor($jumlah_jangkaan_keluar_mengundi), 0, "", ",");
                        $keseluruhan_jangkaan_keluar_mengundi = $keseluruhan_jangkaan_keluar_mengundi + $jumlah_jangkaan_keluar_mengundi;
                        
                        ?>
                        </td>
                        <?php 
                        $tertinggi = 0;
                        $parti_tertinggi_dm = 0;
                        $temp_highest_putih = 0; 
                        $temp_highest_not_putih = 0;
                        $susunan = array();
                        foreach($senaraiCalon as $calon): 
                            $grading = $dataGrading->hari_pdm_dun($calon->pencalonan_bil, $dm->pdt_bil, $harian->harian_tarikh);
                            ?>
                            <td class="text-center" valign="middle" style="<?php echo $calon->parti_warna; ?>">
                                <input type="hidden" name="input_grading_bil[<?= $calon->pencalonan_bil ?>][]" value="<?= $grading->sgpdt_bil ?>">
                                <input class="form-control text-center bg-light m-auto" style="width:100px;" type="text" name="input_grading[<?= $calon->pencalonan_bil ?>][]" id="input_grading[<?= $calon->pencalonan_bil ?>][]" value="<?php echo $grading->sgpdt_peratus; $seratus = $seratus + $grading->sgpdt_peratus; ?>">
                                
                            </td>
                            <td class="text-center" valign="middle" style="<?php echo $calon->parti_warna; ?>"><?php $pengundi = ($grading->sgpdt_peratus/100)*$jumlah_jangkaan_keluar_mengundi; 
                                echo number_format(floor($pengundi), 0, "", ",");
                                $keseluruhan_sokong_calon[$calon->pencalonan_bil] = $keseluruhan_sokong_calon[$calon->pencalonan_bil] + floor($pengundi);
                            ?>
                            <?php $parti_pilihan = $dataParti->pilihan_parti($calon->pencalonan_parti); 
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
                                if($tertinggi <= $pengundi){
                                    $tertinggi = $pengundi;
                                    $parti_tertinggi_dm = $calon->pencalonan_parti;
                                }
                                array_push($susunan, $pengundi);
                                ?>
                            </td>
                            <?php endforeach; ?>
                        <td class="text-center" valign="middle">
                            <input class="form-control text-center bg-light m-auto" style="width:100px;" type="text" name="input_hddt_atas_pagar[]" id="input_hddt_atas_pagar[]" value="<?= $dm->hddt_atas_pagar ?>">
                        </td>
                        <td class="text-center" valign="middle"><?php 
                        $seratus = $seratus + $dm->hddt_atas_pagar;
                        $jumlah_atas_pagar = $dm->hddt_atas_pagar/100*$jumlah_jangkaan_keluar_mengundi;
                        echo number_format(floor($jumlah_atas_pagar), 0, "", ",");
                        $keseluruhan_atas_pagar = $keseluruhan_atas_pagar + floor($jumlah_atas_pagar);
                        ?></td>
                        <td class="text-center" valign="middle" style="<?php if($seratus > 100){ echo "background-color:red; color:white;"; } ?>"><?php echo number_format($seratus, 2, ".", ","); ?> %</td>
                        <td class="text-center" valign="middle"><?php 
                        array_multisort($susunan, SORT_DESC);
                        $majoriti = $susunan[0] - $susunan[1];
                        $majoritiGrading = $temp_highest_putih - $temp_highest_not_putih;  
                        echo number_format($majoriti, 0, "", ",");
                        ?></td>
                        <td class="text-center" valign="middle"><?php 
                        $peratus_majoriti = 0;
                        if(!empty($jumlah_jangkaan_keluar_mengundi)){
                            $peratus_majoriti = ($majoritiGrading/floor($jumlah_jangkaan_keluar_mengundi))*100;
                        }
                        $peratusan = number_format($peratus_majoriti, 2, ".", ","); echo $peratusan; ?> %</td>
                        <?php $status_grading_dm = grading_status($peratusan); ?>
                        <td style="<?= $status_grading_dm['warna'] ?>" class="text-center" valign="middle"><?= $status_grading_dm['grade'] ?></td>
                        <td class="text-center" valign="middle" class="text-center" valign="middle">
                            <?php $dm_pp = $dataParti->parti($parti_tertinggi_dm);
                            $foto_dmpp = $dataFoto->foto($dm_pp->parti_logo);
                            ?>
                            <img src="<?php echo base_url('assets/img/').$foto_dmpp->foto_nama; ?>" class="img-fluid" style="object-fit: contain;max-width: 100px;height: 100px;"/> <br/>
                            <?= $dm_pp->parti_singkatan ?>
                            <input type="hidden" name="input_hddt_parti[]" value="<?= $parti_tertinggi_dm ?>">
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="bg-light">
                        <?php $seratus = 0; ?>
                        <th class="text-center" valign="middle">JUMLAH</th>
                        <th class="text-center" valign="middle"><?= number_format($jumlah_pengundi, 0, "", ",") ?></th>
                        <th class="text-center" valign="middle"><?php 
                        $peratus = 0;
                        if(!empty($jumlah_pengundi)){
                            $peratus = ($keseluruhan_jangkaan_keluar_mengundi / $jumlah_pengundi) * 100; 
                        }
                        echo number_format($peratus, 2, ".", ""); ?> %</th>
                        <th class="text-center" valign="middle"><?= number_format($keseluruhan_jangkaan_keluar_mengundi, 0, "", ",") ?>
                        <input type="hidden" name="input_pengundi_keluar" value="<?= $keseluruhan_jangkaan_keluar_mengundi ?>">
                        </th>
                        <?php 
                        $tertinggi = 0;
                        $parti_tertinggi = 0;
                        $tmp_putih = 0;
                        $tmp_not_putih = 0;
                        $susunan = array();
                        foreach($senaraiCalon as $calon): 
                        $parti_calon = $dataParti->parti($calon->pencalonan_parti);?>
                        <th class="text-center" valign="middle" style="<?php echo $parti_calon->parti_warna; ?>"><?php 
                        $peratus_sokongan = 0;
                        if(!empty($keseluruhan_jangkaan_keluar_mengundi)){
                            $peratus_sokongan = $keseluruhan_sokong_calon[$calon->pencalonan_bil] / $keseluruhan_jangkaan_keluar_mengundi * 100; 
                        }
                        echo number_format($peratus_sokongan, 2, '.', ','); 
                        $seratus = $seratus + $peratus_sokongan; ?> %
                        <input type="hidden" name="input_grading_dun[<?= $calon->pencalonan_bil ?>]" value="<?= $keseluruhan_sokong_calon[$calon->pencalonan_bil] ?>"></th>
                        <th class="text-center" valign="middle" style="<?php echo $parti_calon->parti_warna; ?>"><?php echo number_format($keseluruhan_sokong_calon[$calon->pencalonan_bil], 0, "", ","); 
                        $parti_pilihan = $dataParti->pilihan_parti($calon->pencalonan_parti);
                        if(!empty($parti_pilihan)){
                            if($tmp_putih <= $keseluruhan_sokong_calon[$calon->pencalonan_bil]){
                                $tmp_putih = $keseluruhan_sokong_calon[$calon->pencalonan_bil];
                            }
                        }else{
                            if($tmp_not_putih <= $keseluruhan_sokong_calon[$calon->pencalonan_bil]){
                                $tmp_not_putih = $keseluruhan_sokong_calon[$calon->pencalonan_bil];
                            }
                        }
                        if($tertinggi <= $keseluruhan_sokong_calon[$calon->pencalonan_bil]){
                            $tertinggi = $keseluruhan_sokong_calon[$calon->pencalonan_bil];
                            $parti_tertinggi = $calon->pencalonan_parti;
                        }
                        array_push($susunan, $keseluruhan_sokong_calon[$calon->pencalonan_bil]);
                        ?>
                        </th>
                        <?php endforeach; ?>
                        <th class="text-center" valign="middle">
                            <?php 
                            $peratus_atas_pagar = 0;
                            if(!empty($keseluruhan_jangkaan_keluar_mengundi)){
                                $peratus_atas_pagar = ($keseluruhan_atas_pagar / $keseluruhan_jangkaan_keluar_mengundi) * 100; 
                            }
                            echo number_format($peratus_atas_pagar, 2, '.', ''); 
                            $seratus = $seratus + $peratus_atas_pagar; ?> % 
                        </th>
                        <th class="text-center" valign="middle"><?= number_format($keseluruhan_atas_pagar, 0, "", ","); ?></th>
                        <th class="text-center" valign="middle"><?= number_format($seratus, 2, '.', ','); ?> %</th>
                        <th class="text-center" valign="middle">
                            <?php 
                        array_multisort($susunan, SORT_DESC);
                        $majoriti = $susunan[0] - $susunan[1];
                        $majoritiGrading = $tmp_putih - $tmp_not_putih; 
                        echo number_format($majoritiGrading, 0, "", ","); ?></th>
                        <th class="text-center" valign="middle"><?php 
                        $peratusan = 0;
                        if(!empty($keseluruhan_jangkaan_keluar_mengundi)){
                            $peratusan = number_format($majoritiGrading/$keseluruhan_jangkaan_keluar_mengundi*100, 2, ".", ",");
                        }
                         echo $peratusan; ?> %</th>
                        <?php $status_grading_dun = grading_status($peratusan); ?>
                        <th style="<?= $status_grading_dun['warna'] ?>" class="text-center" valign="middle">
                            <?= $status_grading_dun['grade'] ?>
                        </th>
                        <th class="text-center" valign="middle" class="text-center" valign="middle">
                            <?php 
                            $harian_parti = $parti_tertinggi;
                            $keseluruhan_pp = $dataParti->parti($parti_tertinggi);
                            $foto_kpp = $dataFoto->foto($keseluruhan_pp->parti_logo);
                            ?>
                            <img src="<?php echo base_url('assets/img/').$foto_kpp->foto_nama; ?>" class="img-fluid" style="object-fit: contain;max-width: 100px;height: 100px;"/> <br/>
                            <?= $keseluruhan_pp->parti_singkatan ?>
                        </th>
                    </tr>
                    <tr>
                        <td>JUSTIFIKASI</td>
                        <td colspan=<?= 10 + count($senaraiCalon)*2 ?>><textarea name="input_harian_ulasan" id="input_harian_ulasan" cols="30" rows="10" class="form-control"><?php echo $harian->harian_ulasan; ?></textarea></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <input type="hidden" name="input_harian_bil" value="<?= $harian->harian_bil ?>">
        <input type="hidden" name="input_dun_bil" value="<?= $dun->dun_bil ?>">
        <input type="hidden" name="input_pilihanraya_bil" value="<?= $harian->harian_pilihanraya ?>">
        <div class="mt-3 d-flex justify-content-center">
            <button type="submit" class="btn btn-outline-primary shadow-sm">Simpan</button>
        </div>
                        </form>
        </div>
    </div>

    


    </section>

</main>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>