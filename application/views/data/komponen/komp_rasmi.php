<p>KOMP RASMI</p>
<?php foreach($senarai_pilihanraya as $pru): 
    if($pru->pilihanraya_jenis == "PARLIMEN"){?>
    <h1><?= $pru->pilihanraya_nama ?></h1>
    <?php 
    $senarai_parlimen = $data_calon_parlimen->parlimen_pilihanraya($pru->pilihanraya_bil);
    if(!empty($senarai_parlimen)){ ?> 
    
    <table class="table table-sm table-bordered table-hover">
        <tr>
            <th>BILANGAN</th>
            <th>NEGERI</th>
            <th>PARLIMEN</th>
            <th>JANGKAAN</th>
            <th>KEPUTUSAN SEMASA</th>
            <th>STATUS</th>
        </tr>
    <?php $bilangan = 1; $calculation = 0; foreach($senarai_parlimen as $parlimen):
    $calon_jangkaan = $data_calon_parlimen->jangkaan($parlimen->pt_bil, $pru->pilihanraya_bil);
    $calon_tidak_rasmi = $data_calon_parlimen->tidak_rasmi($parlimen->pt_bil, $pru->pilihanraya_bil);
    $calon_rasmi = $data_calon_parlimen->rasmi($parlimen->pt_bil, $pru->pilihanraya_bil);
    $parti_jangkaan = '';
    $parti_tidak_rasmi = '';
        ?>
        <tr>
            <td><?= $bilangan++ ?></td>
            <td><?= $parlimen->pt_negeri ?></td>
            <td><?= $parlimen->pt_nama ?></td>
            <td><?php
            if(!empty($calon_jangkaan)){
                $parti = $data_parti->parti($calon_jangkaan->pencalonan_parlimen_partiBil);
                echo $parti->parti_singkatan;
                $parti_jangkaan = $parti->parti_singkatan;
            }
             ?></td>
            <td><?php 
            if(!empty($calon_tidak_rasmi)){
                $parti = $data_parti->parti($calon_tidak_rasmi->pencalonan_parlimen_partiBil);
                echo $parti->parti_singkatan;
                $parti_tidak_rasmi = $parti->parti_singkatan;
            }
             ?></td>
             <?php 
            if($parti_jangkaan == $parti_tidak_rasmi){
                $warna = "background-color:white";
                $calculation++;
            }
            if($parti_jangkaan != $parti_tidak_rasmi){
                $warna = "background-color:red";
            }
             ?>
            <td style="<?= $warna ?>"></td>
        </tr>
    <?php endforeach; 
    $bilangan_parlimen = count($senarai_parlimen);
    ?>
    <tr>

    </tr>
    </table>
    <p>JUMLAH KIRAAN PARTI JANGKAAN DAN PARTI KEPUTUSAN SEMASA = <?= $calculation ?>/<?= $bilangan_parlimen ?></p>
    <p>KETEPATAN = <?php
    
    $peratus = ($calculation/$bilangan_parlimen)*100; echo number_format($peratus, 2, '.', ''); ?>%</p>
<?php  }  
}?>

<?php if($pru->pilihanraya_jenis == "DUN"){ ?>
    <h1><?= $pru->pilihanraya_nama ?></h1>
    <?php 
    $senarai_dun = $data_calon_dun->dun_pilihanraya($pru->pilihanraya_bil);
    if(!empty($senarai_dun)){ ?> 
    
    <table class="table table-sm table-bordered table-hover">
        <tr>
            <th>BILANGAN</th>
            <th>NEGERI</th>
            <th>DUN</th>
            <th>JANGKAAN</th>
            <th>KEPUTUSAN SEMASA</th>
            <th>STATUS</th>
        </tr>
    <?php $bilangan = 1; $calculation = 0; foreach($senarai_dun as $dun):
    $calon_jangkaan = $data_calon_dun->jangkaan($dun->dun_bil, $pru->pilihanraya_bil);
    $calon_tidak_rasmi = $data_calon_dun->tidak_rasmi($dun->dun_bil, $pru->pilihanraya_bil);
    $calon_rasmi = $data_calon_dun->rasmi($dun->dun_bil, $pru->pilihanraya_bil);
    $parti_jangkaan = '';
    $parti_tidak_rasmi = '';
        ?>
        <tr>
            <td><?= $bilangan++ ?></td>
            <td><?= $dun->dun_negeri ?></td>
            <td><?= $dun->dun_nama ?></td>
            <td><?php
            if(!empty($calon_jangkaan)){
                $parti = $data_parti->parti($calon_jangkaan->pencalonan_parti);
                echo $parti->parti_singkatan;
                $parti_jangkaan = $parti->parti_singkatan;
            }
             ?></td>
            <td><?php 
            if(!empty($calon_tidak_rasmi)){
                $parti = $data_parti->parti($calon_tidak_rasmi->pencalonan_parti);
                echo $parti->parti_singkatan;
                $parti_tidak_rasmi = $parti->parti_singkatan;
            }
             ?></td>
             <?php 
            if($parti_jangkaan == $parti_tidak_rasmi){
                $warna = "background-color:white";
                $calculation++;
            }
            if($parti_jangkaan != $parti_tidak_rasmi){
                $warna = "background-color:red";
            }
             ?>
            <td style="<?= $warna ?>"></td>
        </tr>
    <?php endforeach; 
    $bilangan_dun = count($senarai_dun);
    ?>
    <tr>

    </tr>
    </table>
    <p>JUMLAH KIRAAN PARTI JANGKAAN DAN PARTI KEPUTUSAN SEMASA = <?= $calculation ?>/<?= $bilangan_dun ?></p>
    <p>KETEPATAN = <?php
    
    $peratus = ($calculation/$bilangan_dun)*100; echo number_format($peratus, 2, '.', ''); ?>%</p>
<?php  }  
}?>





<?php endforeach; ?>