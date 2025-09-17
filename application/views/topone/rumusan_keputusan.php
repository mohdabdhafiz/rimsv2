<?php $senarai_parti = array(); 
$kiraan = array(); 
$senarai_parti_parlimen = array();
foreach($senarai_parlimen as $par){
    $c = $data_status->menang($par->pt_bil);
    $mc = $data_calon->calon($c->sgpt_pencalonan);
    $p = $data_parti->parti($mc->pencalonan_parlimen_partiBil);
    if(!in_array($p->parti_singkatan, $senarai_parti)){
        array_push($senarai_parti, $p->parti_singkatan);
    }
}
foreach($senarai_parti as $prt){
    $kiraan[$prt] = 0;
}
?>
<h1>KEPUTUSAN SEMASA</h1>
<p><?php echo strtoupper($pru->pilihanraya_nama); ?></p>
    <?php foreach($senarai_parlimen as $parlimen): ?>
            <?php 
            $calon = $data_status->menang($parlimen->pt_bil);
            $maklumat_calon = $data_calon->calon($calon->sgpt_pencalonan);
            $maklumat_ahli = $data_ahli->ahli($maklumat_calon->pencalonan_parlimen_ahliBil);
            $maklumat_parti = $data_parti->parti($maklumat_calon->pencalonan_parlimen_partiBil);
            $kiraan[$maklumat_parti->parti_singkatan]++;
            $temp = array(
                'bil' => $maklumat_parti->parti_singkatan,
                'parlimen' => $parlimen->pt_nama
            );
            array_push($senarai_parti_parlimen, $temp);
        endforeach; ?>

<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <tr class="bg-secondary text-white">
            <th>BIL</th>
            <th>PARTI</th>
            <th>KIRAAN</th>
            <th>SENARAI PARLIMEN</th>
        </tr>
        <?php $bilangan = 1; foreach($senarai_parti as $parti): ?>
            <tr>
                <td><?= $bilangan++ ?></td>
                <td><?= $parti ?></td>
                <td><?= $kiraan[$parti] ?></td>
                <td><div class="row g-3">
                    <?php foreach($senarai_parti_parlimen as $par2):
                        if($par2['bil'] == $parti){ ?>
                    <div class="col-12 col-lg-3">
                        <?php echo $par2['parlimen']; ?>
                    </div>
                    <?php } endforeach; ?>
                </div></td>
            </tr>
            <?php endforeach; ?>
    </table>
</div>