<div class="row g-3 mb-3">

    <?php foreach($senarai_rekod as $rekod): 
        $dun = $data_dun->dun_bil($rekod->rpdt_dun_bil); 
        $calon_baru = $data_calon->maklumat_calon($rekod->rpdt_calon_baru);
        $calon_sebelum = $data_calon->maklumat_calon($rekod->rpdt_calon_sebelum);
        $calon_selepas = $data_calon->maklumat_calon($rekod->rpdt_calon_selepas); 
        ?>
    <div class="col-12 col-lg-12 d-flex align-items-stretch">
        <div class="p-3 border rounded w-100">
            <div class="row g-3 mb-3">
                <div class="col-12 col-lg-4 d-flex justify-content-center align-items-start">
                    <div class="w-100 d-flex align-items-center">
                        <img src="<?= base_url() ?>assets/bendera/<?= $data_negeri->nama_foto($dun->dun_negeri)->nt_nama_fail ?>" alt="<?= strtoupper($dun->dun_negeri) ?>" class="img-fluid p-1" style="object-fit: contain;max-width: 1000px;height: 40px;">
                        <h2 class='p-1'>DUN <?= strtoupper($dun->dun_nama) ?></h2> 
                    </div>
                </div>
                <div class="col-12 col-lg-4 d-flex justify-content-center align-items-start">
                    <div class="w-100">
                    <?php if($rekod->rpdt_kategori_perubahan == "TUKAR"){ 
                        $parti_sebelum = $data_parti->parti($calon_sebelum->pencalonan_parti); 
                        $foto_sebelum = $data_foto->foto($parti_sebelum->parti_logo);    
                        $parti_selepas = $data_parti->parti($calon_selepas->pencalonan_parti); 
                        $foto_selepas = $data_foto->foto($parti_selepas->parti_logo);
                    ?>
                    <p class="text-center"><span class="display-6"><img src="<?php echo base_url('assets/img/').$foto_sebelum->foto_nama; ?>" class="img-fluid m-auto" style="object-fit: contain;max-width: 100px;height: 50px;"/> ></span>  <span class="display-1"><img src="<?php echo base_url('assets/img/').$foto_selepas->foto_nama; ?>" class="img-fluid m-auto" style="object-fit: contain;max-width: 200px;height: 100px;"/></span></p>
                    <?php } ?>

                    <?php if($rekod->rpdt_kategori_perubahan == "BARU"){ 
                        $parti_baru = $data_parti->parti($calon_baru->pencalonan_parti); 
                        $foto_baru = $data_foto->foto($parti_baru->parti_logo);
                        ?>
                    <p class="text-center"><span class="display-1"><img src="<?php echo base_url('assets/img/').$foto_baru->foto_nama; ?>" class="img-fluid m-auto" style="object-fit: contain;max-width: 100px;height: 100px"/></span></p>
                    <?php } ?>

                    <?php if($rekod->rpdt_kategori_perubahan == '10000') { ?>
                    <p class="text-center"><span class="display-4">MAJORITI > 10,000</span></p>
                    <?php } ?>

                    <?php if($rekod->rpdt_kategori_perubahan == 'PENGEMASKINIAN MAKLUMAT') { ?>
                        <div class="alert alert-warning text-center">
                            <i class='bx bxs-megaphone'></i> MAKLUMAT DIKEMASKINI
                        </div>
                    <?php } ?>

                    </div>
                </div>
                <?php
                $ls = $data_calon->jangkaan($dun->dun_bil, $calon_baru->pencalonan_pilihanraya);
                if(!empty($ls)){ 
                $parti_ls = $data_parti->parti($ls->pencalonan_parti);
                $foto_ls = $data_foto->foto($parti_ls->parti_logo);
                ?>
                <div class="col-12 col-lg-4 d-flex justify-content-center align-items-start">
                    <div class="w-100 text-center">
                        <p>LOCK STATUS</p>
                        <img src="<?php echo base_url('assets/img/').$foto_ls->foto_nama; ?>" class="img-fluid m-auto" style="object-fit: contain;max-width: 100px;height: 100px"/>
                    </div>
                </div>
                <?php } ?>
            </div>


            <div class="row g-3">
                <div class="col-12 col-lg-12">
                        <table class="table table-bordered table-sm">
                            <?php 
                            $susunan = array();
                            $senarai_calon = $data_undi->senarai_pemenang_dun($dun->dun_bil, $pru->pilihanraya_bil); ?>
                        <tr>
                            <?php 
                                foreach($senarai_calon as $calon):
                                    $c = $data_calon->maklumat_calon($calon->kdt_pencalonan);
                                    $parti_calon = $data_parti->parti($c->pencalonan_parti);
                                    $foto_parti = $data_foto->foto($parti_calon->parti_logo);
                            ?>
                            <td class="text-center" valign="middle" style="<?= $parti_calon->parti_warna ?>">
                                <img src="<?php echo base_url('assets/img/').$foto_parti->foto_nama; ?>" class="img-fluid mb-3 mx-auto" style="object-fit: contain;max-width: 50px;max-height: 50px"/><br />
                                <?= strtoupper($calon->ahli_nama) ?>
                            </td>
                        <?php endforeach; ?>
                        </tr>
                        <tr>
                        <?php foreach($senarai_calon as $calon): 
                                    array_push($susunan, $calon->kdt_undi);
                                    ?>
                        
                            <td class="text-center" valign="middle"><?= $calon->kdt_undi ?></td>
                        <?php endforeach;
                        array_multisort($susunan, SORT_DESC); 
                        $majoriti = $susunan[0] - $susunan[1];
                        $colspan = count($senarai_calon) - 1;
                        ?>
                        </tr>
                        
                    </table>

                    <table class="table table-sm table-bordered">
                    <tr>
                            <th class="text-center" valign="middle">MAJORITI</th>
                            <th class="text-center" valign="middle" colspan=<?= $colspan ?>><?= number_format($majoriti, 0, '', ',') ?></th>
                        </tr>
                        <tr>
                            <th class="text-center" valign="middle">PETI UNDI SEMASA</th>
                            <th class="text-center" valign="middle" colspan=<?= $colspan ?>><?= $rekod->rpdt_peti_undi ?></th>
                        </tr>
                    </table>
                </div>
            </div>
            <p class="small text-muted text-end">Kemaskini terakhir pada <?= $rekod->rpdt_waktu ?></p>
        </div>
    </div>
    <?php endforeach; ?>

    
</div>

