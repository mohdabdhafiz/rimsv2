
<div class="row g-3">
<?php foreach($senarai_parlimen as $parlimen): 
    $rekod = $data_rekod->rekod_terakhir_parlimen($parlimen->pt_bil, $pru->pilihanraya_bil); 
    ?>
    <div class="col-12 col-lg-6 d-flex align-items-stretch">
        <div class="p-3 border rounded w-100">
            <?php
                $ls = $data_calon->jangkaan($parlimen->pt_bil, $pru->pilihanraya_bil);
                if(!empty($ls)){ 
                $parti_ls = $data_parti->parti($ls->pencalonan_parlimen_partiBil);
                $foto_ls = $data_foto->foto($parti_ls->parti_logo);
                ?>

                    <div class="float-end text-center">
                        <img src="<?php echo base_url('assets/img/').$foto_ls->foto_nama; ?>" class="img-fluid m-auto" style="object-fit: contain;max-width: 40px;height: 40px;"/><br />
                        LOCK STATUS
                    </div>

                <?php } ?>
            <h2><?= $parlimen->pt_nama ?></h2>
            <?php $susunan = array();
                            $senarai_calon = $data_undi->senarai_pemenang($parlimen->pt_bil, $pru->pilihanraya_bil); 
                            if(!empty($senarai_calon)){ ?>
            <table class="table table-bordered">
            <tr>

                            <?php 
                            
                                foreach($senarai_calon as $calon):
                                    $c = $data_calon->calon($calon->kpt_pencalonan);
                                    $parti_calon = $data_parti->parti($c->pencalonan_parlimen_partiBil);
                                    $foto_parti = $data_foto->foto($parti_calon->parti_logo);
                            ?>
                            <td class="text-center" valign="middle" style="<?= $parti_calon->parti_warna ?>">
                                <img src="<?php echo base_url('assets/img/').$foto_parti->foto_nama; ?>" class="img-fluid mb-3 mx-auto" style="object-fit: contain;max-width: 50px;max-height: 50px"/><br />
                                <?= strtoupper($calon->ahli_nama) ?> (<?= strtoupper($parti_calon->parti_singkatan) ?>)
                            </td>
                        <?php endforeach;
                        ?>
                        </tr>
                        <tr>

                            <?php 
                            
                                foreach($senarai_calon as $calon):
                                    array_push($susunan, $calon->kpt_undi);
                            ?>
                            <td class="text-center" valign="middle"><?= $calon->kpt_undi ?></td>
                        <?php endforeach;
                        array_multisort($susunan, SORT_DESC); 
                        $majoriti = $susunan[0] - $susunan[1];
                        ?>
                        </tr>
                        
                    </table>
                    <table class="table table-sm table-bordered">
                    <tr>
                            <th class="text-center" valign="middle">MAJORITI</th>
                            <th class="text-center" valign="middle"><?= number_format($majoriti, 0, '', ',') ?></th>
                        </tr>
                        <tr>
                            <th class="text-center" valign="middle">PETI UNDI</th>
                            <th class="text-center" valign="middle"><?= $rekod->rppt_peti_undi ?></th>
                        </tr>
                    </table>
                    <p>Kemaskini terakhir: <?= $rekod->rppt_waktu ?></p>
                    <?php } ?>
        </div>
    </div>
<?php endforeach; ?>
</div>