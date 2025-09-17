<?php $senarai_parti = array(); 
$kiraan = array(); 
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
<div class="row g-3 mb-3">
    <?php foreach($senarai_parlimen as $parlimen): ?>
    <div class="col-12 col-lg-1 text-center d-flex align-items-stretch">
        <div class="p-3 border rounded w-100">
            <p><?= $parlimen->pt_nama ?></p>
            <?php 
            $calon = $data_status->menang($parlimen->pt_bil);
            $maklumat_calon = $data_calon->calon($calon->sgpt_pencalonan);
            $maklumat_ahli = $data_ahli->ahli($maklumat_calon->pencalonan_parlimen_ahliBil);
            $maklumat_parti = $data_parti->parti($maklumat_calon->pencalonan_parlimen_partiBil);
            $foto_ahli = $data_foto->foto($maklumat_ahli->ahli_foto);
            $foto_parti = $data_foto->foto($maklumat_parti->parti_logo);
            $kiraan[$maklumat_parti->parti_singkatan]++;
            
            ?>
            <img src="<?php echo base_url('assets/img/').$foto_parti->foto_nama; ?>" class="img-fluid rounded mb-3" style="object-fit: contain;width: 50px;height: 50px"/>            

        </div>
    </div>
    <?php endforeach; ?>
</div>

<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <tr>
            <th>BIL</th>
            <th>PARTI</th>
            <th>KIRAAN</th>
        </tr>
        <?php $bilangan = 1; foreach($senarai_parti as $parti): ?>
            <tr>
                <td><?= $bilangan++ ?></td>
                <td><?= $parti ?></td>
                <td><?= $kiraan[$parti] ?></td>
            </tr>
            <?php endforeach; ?>
    </table>
</div>