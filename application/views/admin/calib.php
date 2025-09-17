<div class="row g-3">
<div class="col-6">
<div class="p-3 border rounded">
    <h1>PDM PARLIMEN</h1>
    <?php foreach($senarai_pdm_parlimen as $pdm_parlimen): ?>
        <p><?php 
            $nama_dm = $pdm_parlimen->ppt_nama;
            echo $nama_dm; ?> <br />
        <?php $nombor_depan = explode("/", $pdm_parlimen->ppt_nama); 
            echo "Data Pecahan = ".count($nombor_depan). "<br />";
            $nombor_parlimen = "P.".$nombor_depan['0'];
            echo "Nombor Parlimen = ".$nombor_parlimen."<br />";
        ?>
        </p>
        <?php 
        $senarai_parlimen = $data_parlimen->cari_dm_no($nombor_parlimen);
        foreach($senarai_parlimen as $parlimen): 
            $negeri = $parlimen->pt_negeri; ?>
        <p>
            <?php echo $parlimen->pt_nama; ?><br />
            <?php 
            $split = explode(' ', $parlimen->pt_nama);
            $ada = $data_pdm->semak_pdm_parlimen($parlimen->pt_bil, $nama_dm);
            if(empty($ada) && $nombor_parlimen == $split['0']){
                $data_pdm->tambah_pdm_parlimen($nama_dm, $parlimen->pt_bil, $pdm_parlimen->ppt_bilangan_pengundi);
                echo $nama_dm." telah dimasukkan <br />";
            } 
            if($nombor_parlimen != $split['0']){
                $data_pdm->padam($pdm_parlimen->ppt_bil);
            }
            ?>
        </p>
        <?php endforeach; ?>

        <?php 
            if(!empty($nombor_depan['1'])){
                $senarai_dun = $data_dun->cari_dm_no($nombor_dun, $negeri);
        foreach($senarai_dun as $dun): ?>
        <p>
            <?php echo $dun->dun_nama; ?><br />
            <?php 
            $ada_dun = $data_pdm->semak_pdm_dun($dun->dun_bil, $nama_dm);
            if(empty($ada_dun)){
                $data_pdm->tambah_pdm_dun($nama_dm, $dun->dun_bil, $pdm_parlimen->ppt_bilangan_pengundi);
                echo $nama_dm." telah dimasukkan <br />";
            } ?>
        </p>
        <?php endforeach; 
        }?>

    <?php endforeach; ?>
</div>
</div>

<div class="col-6">
<div class="p-3 border rounded">
    <h1>PDM DUN</h1>
    <?php foreach($senarai_pdm_dun as $pdm_dun): ?>
        <p><?php 
            $nama_dm = $pdm_dun->pdt_nama;
            echo $nama_dm; ?> <br />
        <?php $nombor_depan = explode("/", $pdm_dun->pdt_nama); 
            $nombor_parlimen = "P.".$nombor_depan['0'];
            echo "Nombor Parlimen = ".$nombor_parlimen."<br />";
            if(count($nombor_depan) != 3){
                $data_pdm->padam_dun($pdm_dun->pdt_bil);
            }
            if(!empty($nombor_depan['1'])){
            $nombor_dun = "N.".$nombor_depan['1'];
            echo "Nombor DUN = " . $nombor_dun."<br />";
            }
        ?>
        </p>
        <?php 
        $senarai_parlimen = $data_parlimen->cari_dm_no($nombor_parlimen);
        foreach($senarai_parlimen as $parlimen): 
            $negeri = $parlimen->pt_negeri; ?>
        <p>
            <?php echo $parlimen->pt_nama; ?><br />
            <?php 
            $ada = $data_pdm->semak_pdm_parlimen($parlimen->pt_bil, $nama_dm);
            if(empty($ada)){
                $data_pdm->tambah_pdm_parlimen($nama_dm, $parlimen->pt_bil, $pdm_parlimen->ppt_bilangan_pengundi);
                echo $nama_dm." telah dimasukkan <br />";
            } ?>
        </p>
        <?php endforeach; ?>

        <?php 
            if(!empty($nombor_depan['1'])){
                $senarai_dun = $data_dun->cari_dm_no($nombor_dun, $negeri);
        foreach($senarai_dun as $dun): ?>
        <p>
            <?php echo $dun->dun_nama; ?><br />
            <?php 
            $ada_dun = $data_pdm->semak_pdm_dun($dun->dun_bil, $nama_dm);
            if(empty($ada_dun)){
                $data_pdm->tambah_pdm_dun($nama_dm, $dun->dun_bil, $pdm_parlimen->ppt_bilangan_pengundi);
                echo $nama_dm." telah dimasukkan <br />";
            } ?>
        </p>
        <?php endforeach; 
        }?>

    <?php endforeach; ?>
</div>
</div>



</div>