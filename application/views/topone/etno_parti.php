

<div class="p-3 border rounded mb-3">
    <h2 class="display-2">ANALISA STATUS <?= strtoupper($pru->pilihanraya_jenis) ?></h2>
    <p class="small text-muted"><?= strtoupper($pru->pilihanraya_nama) ?></p>
            <div class="p-3">
                    <?php 
                    $senarai_parlimen = array();
                    $senarai_dun = array();
                    $list_parti = array();
                    foreach($senarai_parti as $parti): 
                        if($pru->pilihanraya_jenis == 'PARLIMEN'){
                            $parti_bil = $parti->pencalonan_parlimen_partiBil;
                            $senarai_parlimen = $data_calon->menang_parlimen($pru->pilihanraya_bil);
                        }
                        if($pru->pilihanraya_jenis == 'DUN'){
                            $parti_bil = $parti->pencalonan_parti;
                            $senarai_dun = $data_calon->menang_dun($parti_bil, $pru->pilihanraya_bil);
                        }
                        $maklumat_parti = $data_parti->parti($parti_bil);
                        if(empty($parti_bil)){
                            break;
                        }
                        $p = $data_foto->foto($maklumat_parti->parti_logo);
                        ?>
                <div class="row g-3 mb-3">
                        <div class="col-12 col-lg-4 text-center">
                            <img src="<?php echo base_url('assets/img/').$p->foto_nama; ?>" class="img-fluid rounded mb-3" style="object-fit: contain;width: 300px;height: 300px"/>
                            <h1><?= $maklumat_parti->parti_singkatan ?></h1>
                            <p><?php echo $maklumat_parti->parti_nama; ?></p>
                        </div>
                        <?php if($pru->pilihanraya_jenis == 'PARLIMEN'){ ?>
                        <div class="col-12 col-lg-8 rounded p-3" style="<?= $maklumat_parti->parti_warna ?>">
                            <div class="row g-3">
                                <?php 
                                foreach($senarai_parlimen as $parlimen): 
                                $menang = $data_calon->menang($parlimen->pencalonan_parlimen_parlimenBil, $pru->pilihanraya_bil);
                                if($menang->pencalonan_parlimen_partiBil == $parti_bil){ ?>
                                <div class="col-12 col-lg-2">
                                    <p><?= $data_parlimen->parlimen_bil($parlimen->pencalonan_parlimen_parlimenBil)->pt_nama ?></p>
                                </div>
                                <?php } endforeach; ?>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if($pru->pilihanraya_jenis == 'DUN'){ ?>
                        <div class="col-12 col-lg-8 rounded" style="<?= $maklumat_parti->parti_warna ?>">
                            <div class="row g-3">
                                <?php 
                                
                                foreach($senarai_dun as $dun): 
                                    $menang = $data_calon->menang($dun->pencalonan_dun, $pru->pilihanraya_bil);
                                    if($menang->pencalonan_parti == $parti_bil){
                                ?>
                                <div class="col-12 col-lg-2">
                                    <p><?= $data_dun->dun_bil($dun->dun_nama)->dun_nama ?></p>
                                </div>
                                <?php }
                             endforeach; ?>
                            </div>
                        </div>
                        <?php } ?>
                </div>
                <?php endforeach; ?>
    </div>
</div>