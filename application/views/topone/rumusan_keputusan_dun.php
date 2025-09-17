


<?php $senarai_parti = array(); 
$kiraan = array(); 
$senarai_parti_dun = array();
foreach($senarai_dun as $d){
    $c = $data_status->menang_dun($d->dun_bil);
    if(!empty($c)){
        $mc = $data_calon->maklumat_calon($c->status_grading_pencalonan);
        if(!empty($mc)){
            $p = $data_parti->parti($mc->pencalonan_parti);
            if(!in_array($p->parti_singkatan, $senarai_parti)){
                array_push($senarai_parti, $p->parti_singkatan);
            }
        }
    }
    
}
foreach($senarai_parti as $prt){
    $kiraan[$prt] = 0;
}
?>
<p><strong><?= $nomborBilangan ?>. Keputusan Semasa <?php echo $pru->pilihanraya_nama; ?></strong></p>
    <?php foreach($senarai_dun as $dun): ?>
            <?php 
            $calon = $data_status->menang_dun($dun->dun_bil);
            if(!empty($calon)){
                $maklumat_calon = $data_calon->maklumat_calon($calon->status_grading_pencalonan);
                if(!empty($maklumat_calon)){
                    $maklumat_ahli = $data_ahli->ahli($maklumat_calon->pencalonan_ahli);
                    $maklumat_parti = $data_parti->parti($maklumat_calon->pencalonan_parti);
                    $kiraan[$maklumat_parti->parti_singkatan]++;
                    $temp = array(
                        'bil' => $maklumat_parti->parti_singkatan,
                        'dun' => $dun->dun_nama
                    );
                    array_push($senarai_parti_dun, $temp);
                }
            }
            
        endforeach; ?>

<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <tr class="bg-secondary text-white">
            <th>BIL</th>
            <th>PARTI</th>
            <th>KIRAAN DUN</th>
            <th>SENARAI <?= $pru->pilihanraya_jenis ?></th>
        </tr>
        <?php $jumlahDun = 0; $bilangan = 1; foreach($senarai_parti as $parti): ?>
            <tr>
                <td><?= $bilangan++ ?></td>
                <td><?= $parti ?></td>
                <td>
                    <?= $kiraan[$parti] ?>
                    <?php $jumlahDun = $jumlahDun + $kiraan[$parti]; ?>
                </td>
                <td><div class="row g-3">
                    <?php foreach($senarai_parti_dun as $d2):
                        if($d2['bil'] == $parti){ ?>
                    <div class="col-12 col-lg-3">
                        <?php echo $d2['dun']; ?>
                    </div>
                    <?php } endforeach; ?>
                </div></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <th></th>
                <th></th>
                <th><?= $jumlahDun ?>/<?= count($senarai_dun) ?></th>
                <th></th>
            </tr>
    </table>
</div>