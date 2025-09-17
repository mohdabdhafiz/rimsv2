<?php
if($pru->pilihanraya_jenis == "PARLIMEN"){
    $senarai_parti = $data_calon_parlimen->parti_menang($pru->pilihanraya_bil);
    $jumlah_tanding = count($data_pru->senarai_parlimen_pilihanraya($pru->pilihanraya_bil));
}
if($pru->pilihanraya_jenis == "DUN"){
    $senarai_parti = $data_calon_dun->parti_menang($pru->pilihanraya_bil);
    $jumlah_tanding = count($data_pru->senarai_dun_pilihanraya($pru->pilihanraya_bil));
}
?>

<table class="table table-bordered">
    <tr>
        <?php foreach($senarai_parti as $parti): 
            if($pru->pilihanraya_jenis == "PARLIMEN"){
                $p = $data_parti->parti($parti->pencalonan_parlimen_partiBil); 
            }
            if($pru->pilihanraya_jenis == "DUN"){
                $p = $data_parti->parti($parti->pencalonan_parti); 
            }
                $foto_parti = $data_foto->foto($p->parti_logo);
            ?>
        <td style='<?= $p->parti_warna ?>' valign="middle" class="text-center">
            <img src="<?php echo base_url('assets/img/').$foto_parti->foto_nama; ?>" class="img-fluid mb-3 mx-auto" style="object-fit: contain;max-width: 100px;height: 100px"/><br />
            <?= $p->parti_singkatan ?>
        </td>
        <?php endforeach; ?>
    </tr>
    <tr>
    <?php 
    $bil = count($senarai_parti);
    $colspan = $bil / 2;
    $jumlah = 0;
    foreach($senarai_parti as $parti): 
            if($pru->pilihanraya_jenis == "PARLIMEN"){
                $p = $data_parti->parti($parti->pencalonan_parlimen_partiBil); 
            }
            if($pru->pilihanraya_jenis == "DUN"){
                $p = $data_parti->parti($parti->pencalonan_parti); 
            }
                $jumlah = $jumlah + $parti->kira;
            ?>
        <td style='<?= $p->parti_warna ?>' valign="middle" class="text-center">
            <div class="d-flex justify-content-center align-items-center">
                <div class="">
                    <h1 class="display-1"><?= $parti->kira ?></h1>
                    <span class="small">Semasa</span>
                </div>
                <div class="ms-3">
                    <?php
                        $jumlahSebenar = 0;
                        if(!empty($parti->kiraMenang)){
                            $jumlahSebenar = $parti->kiraMenang;
                        }
                    ?>
                <h1 class="display-1"><?= $jumlahSebenar ?></h1>
                    <span class="small">Rasmi</span>
                </div>
            </div>
        </td>
        <?php endforeach; ?>
    </tr>
    <tr class="bg-light">
        <th colspan=<?= $colspan ?> valign="middle" class="text-center">JUMLAH</th>
        <th colspan=<?= $colspan + 1 ?> valign="middle" class="text-center"><?= $jumlah; ?></th>
    </tr>
</table>