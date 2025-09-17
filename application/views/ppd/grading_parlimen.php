<?php
function grading_status($majoriti){
    if(20.01 <= $majoriti){
        $grade = 'PUTIH';
        $warna = 'background:white; color:black';
    }
    if($majoriti >= 0.00 && $majoriti <= 20.00){
        $grade = 'KELABU PUTIH';
        $warna = 'background:#BEBEBE; color:black';
    }
    if($majoriti <= -0.01 && $majoriti >= -20.00){
        $grade = 'KELABU HITAM';
        $warna = 'background:#696969; color:white';
    }
    if($majoriti <= -20.01){
        $grade = 'HITAM';
        $warna = 'background:#000000; color:white';
    }
    $grading = array(
        'grade' => $grade,
        'warna' => $warna
    );
    return $grading;
}

//INITIALIZATION
//$senarai_daerah_mengundi DAERAH MENGUNDI, BILANGAN PENGUNDI
$senarai_harian_daerah_mengundi = array(); //JANGKAAN KELUAR MENGUNDI, ATAS PAGAR
?>

<div class="p-3 border rounded mb-3">
    <h1>GRADING PARLIMEN <?= strtoupper($parlimen->pt_nama) ?></h1>
    <div class="row g-3 mt-3">
        <div class="col-12 col-lg-6">
            <?php echo anchor(base_url(), 'Laman Utama', "class='btn btn-primary w-100'"); ?>
        </div>
    </div>
</div>

<?php foreach($senarai_pilihanraya as $pru): 
$jumlah_pengundi = 0;
$jumlah_jangkaan_keluar_mengundi = 0;
$jumlah_pengundi_calon = array();
$jumlah_atas_pagar = 0;
$senarai_calon = $data_calon->senaraiCalonDenganGrading($parlimen->pt_bil, $pru->pilihanraya_bil); //SENARAI CALON
    echo form_open('grading/proses_parlimen'); ?>
<div class="table-responsive mb-3">
    <table class="table table-sm table-bordered table-hover">
        <thead>
            <tr class="bg-secondary text-white">
                <th>DAERAH MENGUNDI</th>
                <th>BILANGAN PENGUNDI (DM)</th>
                <th colspan=2>JANGKAAN KELUAR MENGUNDI</th>
                <?php foreach($senarai_calon as $calon): 
                    $jumlah_pengundi_calon[$calon->pencalonan_parlimen_bil] = 0; ?>
                <th colspan=2 style="<?= $calon->parti_warna ?>"><?= $calon->ahli_nama ?></th>
                <?php endforeach; ?>
                <th colspan=2>ATAS PAGAR / UNDI ROSAK</th>
                <th>100%</th>
                <th>MAJORITI</th>
                <th>PERATUS MAJORITI</th>
                <th>GRADING</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($senarai_daerah_mengundi as $dm): 
                $seratus = 0;
                $temp_highest_putih = 0; 
                $temp_highest_not_putih = 0;
                $harian_dm = $data_dm_harian->dm_semasa($dm->ppt_bil); 
                if(empty($harian_dm)){
                    $keluar_mengundi = 0;
                    $atas_pagar = 0;
                    $harian_dm_bil = "TIADA";
                }
                if(!empty($harian_dm)){
                    $keluar_mengundi = $harian_dm->hdpt_keluar_mengundi;
                    $atas_pagar = $harian_dm->hdpt_atas_pagar;
                    $harian_dm_bil = $harian_dm->hdpt_bil;
                }    
                $seratus = $seratus + $atas_pagar;
                ?>
            <tr>
                <td><?= $dm->ppt_nama ?></td>
                <td>
                    <?= $dm->ppt_bilangan_pengundi ?>
                    <?php $jumlah_pengundi = $jumlah_pengundi + $dm->ppt_bilangan_pengundi; ?>
                    <input type="hidden" name="input_daerah_mengundi_bil[]" value="<?= $dm->ppt_bil ?>">
                    <input type="hidden" name="input_bilangan_pengundi[]" value="<?= $dm->ppt_bilangan_pengundi ?>">
                </td>
                <td>
                    <input type="hidden" name="input_dm_bil[]" value="<?= $harian_dm_bil ?>">
                    <input type="text" name="input_dm_keluar_mengundi[]" id="input_dm_keluar_mengundi[]" style="width:80px;" class="text-center form-control" value="<?= $keluar_mengundi ?>">
                </td>
                <td><?php $bilangan_keluar_mengundi = ($keluar_mengundi/100)*$dm->ppt_bilangan_pengundi; echo floor($bilangan_keluar_mengundi); $jumlah_jangkaan_keluar_mengundi = $jumlah_jangkaan_keluar_mengundi + floor($bilangan_keluar_mengundi); ?>
                </td>
                <?php foreach($senarai_calon as $calon): 
                    $grading = $data_grading->hari_ini_pdm_parlimen($calon->pencalonan_parlimen_bil, $dm->ppt_bil);
                    if(empty($grading)){
                        $grad_bil = 'TIADA';
                        $grad = 0;
                    }else{
                        $grad = $grading->sgppt_peratus;
                        $grad_bil = $grading->sgppt_bil;
                    }
                    $bilangan_pengundi_grad = ($grad/100)*floor($bilangan_keluar_mengundi);
                    $seratus = $seratus + $grad;
                ?>
                <td style="<?= $calon->parti_warna ?>">
                    <input type="text" name="input_grading[<?= $calon->pencalonan_parlimen_bil ?>][]" id="input_grading[<?= $calon->pencalonan_parlimen_bil ?>][]" style="width:80px;" class="text-center form-control" value="<?= $grad ?>">
                    <input type="hidden" name="input_grading_bil[<?= $calon->pencalonan_parlimen_bil ?>][]" value="<?= $grad_bil ?>">
                </td>
                <td style="<?= $calon->parti_warna ?>"><?= floor($bilangan_pengundi_grad) ?> <?php $jumlah_pengundi_calon[$calon->pencalonan_parlimen_bil] = $jumlah_pengundi_calon[$calon->pencalonan_parlimen_bil] + floor($bilangan_pengundi_grad); ?></td>
                <?php endforeach; ?>
                <td>
                    <input type="text" name="input_dm_atas_pagar[]" id="input_dm_atas_pagar[]" style="width:80px;" class="text-center form-control" value="<?= $atas_pagar ?>">
                </td>
                <td><?php $bilangan_atas_pagar = ($atas_pagar/100)*floor($bilangan_keluar_mengundi); echo floor($bilangan_atas_pagar); $jumlah_atas_pagar = $jumlah_atas_pagar + floor($bilangan_atas_pagar); ?></td>
                <td style="<?php if($seratus > 100){ echo "background-color:red; color:white;"; } ?><?php if($seratus < 100){ echo "background-color:yellow"; } ?>"><?= $seratus ?>%</td>
                <td><?php $majoriti = $temp_highest_putih - $temp_highest_not_putih; echo $majoriti; ?></td>
                <td><?php $peratusan = ($majoriti / $dm->ppt_bilangan_pengundi) * 100; echo $peratusan; ?>%</td>
                <?php $grading_dm = grading_status($peratusan); ?>
                <td style="<?= $grading_dm['warna']; ?>"><?= $grading_dm['grade']; ?></td>
            </tr>
            <?php endforeach; 
            $harian = $data_dm_harian->parlimen_harian($parlimen->pt_bil, date("Y-m-d")); 
            if(empty($harian)){
                $ulasan = "";
            }else{
                $ulasan = $harian->harian_parlimen_ulasan;
            }    ?>
        </tbody>
    </table>

    <p class="mb-0"><strong>JUSTIFIKASI:</strong></p>
    <textarea class="form-control mb-3 mt-0" name="input_ulasan" id="input_ulasan" cols="30" rows="10"><?= $ulasan ?></textarea>
    <?php foreach($senarai_calon as $calon): ?>
        <input type="hidden" name="input_jumlah_pengundi_calon[<?= $calon->pencalonan_parlimen_bil ?>]" value="<?= $jumlah_pengundi_calon[$calon->pencalonan_parlimen_bil] ?>">
        <?php endforeach; ?>
    <input type="hidden" name="input_jumlah_atas_pagar" value="<?= $jumlah_atas_pagar ?>">
    <input type="hidden" name="input_jumlah_jangkaan_keluar_mengundi" value="<?= $jumlah_jangkaan_keluar_mengundi ?>">
    <input type="hidden" name="input_jumlah_pengundi" value="<?= $jumlah_pengundi ?>">
    <input type="hidden" name="input_pilihanraya_bil" value="<?= $pru->pilihanraya_bil ?>">
    <input type="hidden" name="bilangan_data" value="<?= count($senarai_daerah_mengundi) ?>">
    <input type="hidden" name="input_parlimen_bil" value="<?= $parlimen->pt_bil ?>">
    <button type="submit" class="btn btn-primary w-100">Simpan</button>
</div>
            </form>
<?php endforeach; ?>