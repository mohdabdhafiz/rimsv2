
<?php $this->load->view('data/nav'); ?>

<?php $tarikh = date('Y-m-d'); 
if(!empty($pilihan_tarikh)){
    $tarikh = $pilihan_tarikh; 
}
$senarai_harian = array('PUTIH', 'KELABU PUTIH', 'KELABU HITAM', 'HITAM');
?>
<p class="small text-muted"><?php echo date_format(date_create($tarikh), "d.m.Y"); ?></p>
<p><strong>Laporan Grading Parlimen/DUN Mengikut Pilihan Raya</strong></p>



<?php 
$bilangan = 1;
foreach($senarai_pilihanraya as $pru): 
    
    ?>

<?php if($pru->pilihanraya_jenis == 'PARLIMEN'){ 
    $list_harian = $data_harian_parlimen->senarai_pilihanraya($pru->pilihanraya_bil);
$senarai_negeri = $data_pru->senarai_negeri_parlimen($pru->pilihanraya_bil);
$jumlah_grading = array();
?>

    <p><strong><?= $bilangan++ ?>. <?= $pru->pilihanraya_nama ?></strong></p>
    <div class="row g-1 my-3">
        <?php foreach($list_harian as $sh): ?>
        <div class="col-12 col-lg-2 text-center">
            <div class="p-1 border rounded bg-light">
                <?php echo anchor('laporan/maklumat_harian/'.$sh->harian_parlimen_bil, date_format(date_create($sh->harian_parlimen_tarikh), "d.m.Y")); ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="table-responsive">
<table class="table table-sm table-bordered table-striped table-hover">
    <tr class="bg-secondary text-white">
        <th>NEGERI</th>
        <?php foreach($senarai_harian as $harian):
        $jumlah_grading[$harian] = 0;
             ?>
        <th><?= $harian ?></th>
        <?php endforeach; ?>
    </tr>
    <?php foreach($senarai_negeri as $negeri): 
        $senaraiParlimen = $data_harian_parlimen->ikutParlimen($tarikh, $negeri->pt_negeri, $pru->pilihanraya_bil); ?>
    <tr>
        <td>
            <?= $negeri->pt_negeri ?><br >
            Bilangan Parlimen: <?= count($senaraiParlimen); ?>
        </td>
        <?php foreach($senarai_harian as $harian): ?>
        <td>
            <ol>
            <?php foreach($senarai_parlimen as $parlimen): 
                if($parlimen->harian_parlimen_grading == $harian){
                $jumlah_grading[$harian]++;
                $parti_menang = $data_calon_parlimen->menang_hari_ini($tarikh, $parlimen->pt_bil, $pru->pilihanraya_bil);
                ?>
                <li><?= $parlimen->pt_nama ?> 
                <?php if(!empty($parti_menang)){ ?>
                (<?= $parti_menang->parti_singkatan ?>)
                    <?php } ?>
                </li>
                <?php } 
            endforeach; ?>
                </ol>
        </td>
        <?php endforeach; ?>
    </tr>
    <?php endforeach; ?>
    <tr>
        <th>JUMLAH</th>
        <?php foreach($senarai_harian as $harian): ?>
        <th><?= $jumlah_grading[$harian] ?></th>
        <?php endforeach; ?>
    </tr>
</table>
</div>

<?php } ?>

<?php if($pru->pilihanraya_jenis == 'DUN'){ 
$jumlah_grading_dun = array();
$senarai_negeri = $data_pru->senarai_negeri_dun($pru->pilihanraya_bil);
$list_harian = $data_harian_dun->senarai_pilihanraya($pru->pilihanraya_bil);
?>

    <p><strong><?= $bilangan++ ?>. <?= $pru->pilihanraya_nama ?> (<?= $pru->pilihanraya_singkatan ?>)</strong></p>
<div class="row g-1 my-3">
        <?php foreach($list_harian as $sh): ?>
        <div class="col-12 col-lg-2 text-center">
            <div class="p-1 border rounded bg-light">
                <?php echo anchor('laporan/maklumat_harian_dun/'.$sh->harian_bil, date_format(date_create($sh->harian_tarikh), "d.m.Y")); ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="table-responsive">
<table class="table table-sm table-hover table-striped table-bordered">
<tr>
    <th>NEGERI</th>
    <?php foreach($senarai_harian as $harian): 
        $jumlah_grading_dun[$harian] = 0; ?>
    <th><?= $harian ?></th>
    <?php endforeach; ?>
</tr>
<?php foreach($senarai_negeri as $negeri): 
    $senaraiDun = $data_harian_dun->ikutDun($tarikh, $negeri->dun_negeri, $pru->pilihanraya_bil); ?>
<tr>
    <td>
        <?= $negeri->dun_negeri ?><br />
        Bilangan DUN: <?= count($senaraiDun); ?>
    </td>
    <?php foreach($senarai_harian as $harian): ?>
        <td>
            <ol>
            <?php foreach($senaraiDun as $dun): 
            if($dun->harian_grading == $harian){
                $jumlah_grading_dun[$harian]++; 
                $parti_menang = $data_calon_dun->menang_hari_ini($tarikh, $dun->dun_bil, $pru->pilihanraya_bil);
                ?>
                <li><?= $dun->dun_nama ?> <?php if(!empty($parti_menang)){ ?>
                (<?= $parti_menang->parti_singkatan ?>)
                    <?php } ?>
                </li>
                <?php
            }
            endforeach; ?>
                </ol>
        </td>
        <?php endforeach; ?>
</tr>
<?php endforeach; ?>
<tr>
        <th>JUMLAH</th>
        <?php foreach($senarai_harian as $harian): ?>
        <th><?= $jumlah_grading_dun[$harian] ?></th>
        <?php endforeach; ?>
    </tr>
</table>
</div>

<?php } ?>



<?php endforeach; ?>