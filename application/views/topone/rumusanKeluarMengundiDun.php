<h6 class="text-center">RUMUSAN KELUAR MENGUNDI</h6>
<h5 class="display-5 text-center"><?= $pru->pilihanraya_nama ?></h5>

<?php
$bilanganDun = count($senaraiDun);
$bilanganRow = floor($bilanganDun / 6);
$count = 0;
?>

<div class="row g-1">
    <div class="col-12 col-lg-2">
    <?php foreach($senaraiDun as $dun): 
        $peratus = 0;
        $jumlahPengundi = $dun->jumlahPengundi; 
        $pengundi = $dun->pengundiKeluarMengundi;
        if(!empty($jumlahPengundi)){
            $peratus = ($pengundi / $jumlahPengundi) * 100;
        }
    ?>
        <div class="p-1 border rounded d-flex justify-content-between align-items-top mb-1">
            <div class="d-flex flex-column text-start">
                <span class=""><?= $dun->dun_nama ?></span>
                <span class='small text-muted mt-auto' id="jumlahPengundiDun[<?= $dun->dun_bil ?>]"><?= $dun->jumlahPengundi ?></span>
            </div>
            <div class="d-flex flex-column text-end ms-3">
                <span class="text-primary" id="peratus[<?= $dun->dun_bil ?>]"><?= number_format($peratus, 2, '.', '') ?>%</span>
                <span class='small text-muted mt-auto' id="pengundi[<?= $dun->dun_bil ?>]"><?= $dun->pengundiKeluarMengundi ?></span>
            </div>
        </div>
        <?php
        $count++;
        if($count == $bilanganRow){
            echo "</div><div class='col-12 col-lg-2'>";
            $count = 0;
        }
        ?>
    <?php 
        endforeach; ?>
    </div>
</div>