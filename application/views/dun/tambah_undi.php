<?php if(!empty($senarai_pilihanraya)){ ?>
<h2>KEMASKINI MAKLUMAT UNDI BAGI DUN <?= strtoupper($dun->dun_nama) ?></h2>
<?php foreach($senarai_pilihanraya as $pru): 
    $maklumat_peti_undi = $data_rekod->peti_undi_dun($dun->dun_bil, $pru->pilihanraya_bil);
    ?>
<p class="small text-muted mt-3"><?= strtoupper($pru->pilihanraya_nama) ?></p>
<?php echo form_open('undi/proses_dun'); ?>
<label class="form-label">1) Masukkan bilangan undian semasa:</label>
<div class="table-responsive">
    <table class="table table-sm table-bordered">
        <tr>
            <?php 
            $senarai_calon = $data_calon->calon_dun($dun->dun_bil, $pru->pilihanraya_bil); 
            foreach($senarai_calon as $calon): 
                $parti1 = $data_parti->parti($calon->pencalonan_parti);
                $foto = $data_foto->foto($parti1->parti_logo);
            ?>
            <td class="text-center" valign="bottom" style="<?= $parti1->parti_warna ?>">
            <?php if(!empty($foto)){ ?>
                <img src="<?php echo base_url('assets/img/').$foto->foto_nama; ?>" class="img-fluid mb-3 mx-auto" style="object-fit: contain;max-width: 100px;max-height: 100px"/><br />
                <?php } ?>
                <?= strtoupper($calon->ahli_nama) ?>
            </td>
            <?php endforeach; ?>
            <td class="text-center" valign="bottom">LOCK UNDI</td>
            <td class="text-center" valign="bottom">MAJORITI</td>
            <td class="text-center" valign="bottom">LOCK STATUS</td>
        </tr>
        <tr>
            <?php $bil_undi = array();
                foreach($senarai_calon as $calon): 
                $bilangan_undi = $data_undi->undi_dun($calon->pencalonan_bil); 
                $parti_calon = $data_parti->parti($calon->pencalonan_parti);
                $foto_simpan = $data_foto->foto($parti_calon->parti_logo);
                if(empty($bilangan_undi)){
                    $undi = 0;
                }else{
                    $undi = $bilangan_undi->kdt_undi;
                }
                array_push($bil_undi, $undi);
                ?>
            <td class="text-center" valign="middle" style="<?= $parti_calon->parti_warna ?>">
            <input type="text" name="input_bilangan_pengundi[]" id="input_bilangan_pengundi[]" class="bg-light form-control m-auto text-center" style="width:100px;" placeholder="0" value="<?= $undi ?>">
            <input type="hidden" name="input_calon_bil[]" value="<?php echo $calon->pencalonan_bil; ?>">
            </td>
            <?php endforeach; ?>

            <?php 
            $menang = $data_undi->pemenang_dun($dun->dun_bil, $pru->pilihanraya_bil); 
            
            if(empty($menang)){
                $pemenang = "BELUM DITETAPKAN";
                $color = "";
            }else{
                $pemenang = $data_ahli->ahli($menang->pencalonan_ahli)->ahli_nama; 
                $parti = $data_parti->parti($menang->pencalonan_parti);
                $foto_pemenang = $data_foto->foto($parti->parti_logo);
                $color = $parti->parti_warna;
            } 
            ?>
            <td class="text-center" valign="middle" style="<?= $color ?>">
                <?php if(!empty($foto_pemenang)){ ?>
                <img src="<?php echo base_url('assets/img/').$foto_pemenang->foto_nama; ?>" class="img-fluid mb-3 mx-auto" style="object-fit: contain;max-width: 100px;max-height: 100px"/><br />
                <?php } ?>
            <?= strtoupper($pemenang) ?>
            
            </td>
            
            
            <?php 
            $calon_pilihan = $data_calon->jangkaan($dun->dun_bil, $pru->pilihanraya_bil);
            if(empty($calon_pilihan)){
                $color = "background:red; color:white;";
                $grading = "BELUM DITETAPKAN";
            }else{
                $parti = $data_parti->parti($calon_pilihan->pencalonan_parti);
                $foto_pilihan = $data_foto->foto($parti->parti_logo); 
                $color = $parti->parti_warna;
            }   
             ?>
            <td class="text-center" valign="middle">
                <?php 
                array_multisort($bil_undi, SORT_DESC); 
                $majoriti = $bil_undi[0] - $bil_undi[1];
                echo number_format($majoriti,0,'',',');
                ?>
            </td>
            <td class="text-center" valign="middle" style="<?= $color ?>">
                <?php if(!empty($foto_pilihan)){ ?>
                <img src="<?php echo base_url('assets/img/').$foto_pilihan->foto_nama; ?>" class="img-fluid mb-3 mx-auto" style="object-fit: contain;width: 100px;max-height: 300px"/><br />
                <?php }else{ ?>
                <?= $grading ?>
                <?php } ?>
            </td>
        </tr>
    </table>
</div>

<?php
$current_peti_undi = 'BELUM DITETAPKAN'; 
$currentUndiRosak = 0;
if(!empty($maklumat_peti_undi)){
    $current_peti_undi = $maklumat_peti_undi->rpdt_peti_undi;
    if(!empty($maklumat_peti_undi->rpdt_undi_rosak)){
        $currentUndiRosak = $maklumat_peti_undi->rpdt_undi_rosak;
    }
} 
 ?>
 
<div class="mb-3">
    <label for="input_peti_undi" class="form-label">2) Masukkan maklumat peti undi semasa:</label>
    <input type="text" name="input_peti_undi" id="input_peti_undi" class="form-control" value="<?= $current_peti_undi ?>">
    <p class="small text-muted">Contoh: 11/177</p>
</div>

<div class="mb-3">
    <label for="inputUndiRosak" class="form-label">3) Masukkan Jumlah Kertas <strong>Undi Rosak</strong>:</label>
    <input type="text" name="inputUndiRosak" id="inputUndiRosak" class="form-control" value="<?= $currentUndiRosak ?>">
    <p class="small text-muted">Contoh: 2</p>
</div>


<input type="hidden" name="input_dun_bil" value="<?= $dun->dun_bil ?>">
<input type="hidden" name="input_pilihanraya_bil" value="<?= $pru->pilihanraya_bil ?>">
<button type="submit" class="btn btn-secondary w-100">HANTAR</button>
</form>
<?php endforeach; ?>

<?php } ?>