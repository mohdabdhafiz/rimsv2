<?php foreach($senarai_pilihanraya as $pru):
    if($pru->pilihanraya_jenis == 'PARLIMEN'){ 
        $senarai_parti_parlimen = $data_calon_parlimen->senarai_parti_jangkaan($pru->pilihanraya_bil);
        ?>
<div class="p-3 border rounded mb-3">
    <h3>LOCK STATUS <?= strtoupper($pru->pilihanraya_nama) ?></h3>
    <div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <?php foreach($senarai_parti_parlimen as $parti):
                $parti1 = $data_parti->parti($parti->pencalonan_parlimen_partiBil);
                $foto = $data_foto->foto($parti1->parti_logo);
            ?>
            <td valign="middle" class="text-center" style="<?= $parti1->parti_warna ?>">
                <img src="<?php echo base_url('assets/img/').$foto->foto_nama; ?>" class="img-fluid mb-3" style="object-fit: contain;max-width: 100px;height: 100px"/><br />
                <?= strtoupper($parti1->parti_singkatan) ?>
            </td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <?php $count = 0; $colspan = count($senarai_parti_parlimen); foreach($senarai_parti_parlimen as $parti): 
                $parti1 = $data_parti->parti($parti->pencalonan_parlimen_partiBil);
                $count = $count + $parti->kira;
                ?>
            <td valign="middle" class="text-center" style="<?= $parti1->parti_warna ?>"><h4 class="display-4"><?= $parti->kira ?></h4></td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <th colspan=<?= $colspan ?> class="bg-light text-center">
                <?= $count ?>
            </th>
        </tr>
    </table>
    </div>
</div>
<?php } ?>

<?php if($pru->pilihanraya_jenis == "DUN"){ 
    $senarai_parti_dun = $data_calon_dun->senarai_parti_jangkaan($pru->pilihanraya_bil);
    ?>
<div class="p-3 border rounded mb-3">
    <h3>LOCK STATUS <?= strtoupper($pru->pilihanraya_nama) ?></h3>
    <div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <?php foreach($senarai_parti_dun as $parti_dun):
                $parti2 = $data_parti->parti($parti_dun->pencalonan_parti);
                $foto1 = $data_foto->foto($parti2->parti_logo); 
            ?>
            <td valign="middle" class="text-center" style="<?= $parti2->parti_warna ?>">
                <img src="<?php echo base_url('assets/img/').$foto1->foto_nama; ?>" class="img-fluid mb-3" style="object-fit: contain;max-width: 100px;height: 100px"/><br />
                <?= strtoupper($parti2->parti_singkatan) ?>
            </td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <?php $count_dun = 0; $colspan_dun = count($senarai_parti_dun);  foreach($senarai_parti_dun as $parti_dun): 
                $parti2 = $data_parti->parti($parti_dun->pencalonan_parti);
                $count_dun = $count_dun + $parti_dun->kira;
                ?>
            <td valign="middle" class="text-center" style="<?= $parti2->parti_warna ?>"><h4 class="display-4"><?= $parti_dun->kira ?></h4></td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <th colspan=<?= $colspan_dun ?> class="bg-light text-center">
                <?= $count_dun ?>
            </th>
        </tr>
    </table>
    </div>
</div>
<?php } ?>

<?php endforeach; ?>