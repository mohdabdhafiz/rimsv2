<?php if(count($senarai_calon) == 0){
    redirect('pengguna/logout');
} ?>


<div class="row g-1 justify-content-evenly">

<div class="col-12 p-3 text-center">
    <h1>RINGKASAN PENAMAAN CALON</h1>
    <?php foreach($pilihanraya as $pru){ echo $pru->pilihanraya_nama." (".$pru->pilihanraya_singkatan.")"; } ?>
</div>
    
    <div class="col-auto">
        <div class="p-3 border rounded">
            <h3>PENJURU</h3>
            <em class="text-muted small">Peratusan merujuk kepada bilangan calon daripada jumlah pencalonan bagi pilihan raya ini.</em>
            <div class="row g-3 justify-content-center">
                <?php foreach($penjuru as $pen): 
                        if($pen['bilangan_dun']!=0 && $pen['bilangan_penjuru']!=0){?>
                        <div class="col-auto p-3">
                        <div class="row g-2">
                            <div class="col-auto bg-primary text-white text-center">
                                <div class="p-3">
                                    <h1 class="display-1"><?php echo $pen['bilangan_penjuru']; ?></h1> <br /> <small>Penjuru <br /> (<?php echo $pen['peratusan']; ?>)</small>
                                </div>   
                            </div>
                            <div class="col-auto border text-center">
                                <div class="p-3">
                                <h1 class="display-1"><?php echo $pen['bilangan_dun']; ?></h1> <br /> <small>DUN</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                endforeach; ?>
            </div>
            <p class="text-end text-muted">Jumlah Calon: <?php echo count($senarai_calon); ?></p>
        </div>
    </div>
        
    <div class="col-auto">
        <div class="p-3 border rounded">
            <h3>PARTI BERTANDING</h3>
            <?php $kira_calon = 0; 
                    $kira_bil = 1; ?>
                    <table class="table table-sm">
                        <tr>
                            <th>BIL</th>
                            <th>NAMA PARTI</th>
                            <th class="text-center">JUMLAH <br /><small>(ORANG)</small></th>
                        </tr>
                        <?php
                        foreach($senarai_parti_calon as $p):?>
                        <tr>
                            <td class="text-center"><?php echo $kira_bil++; ?></td>
                            <td class="d-flex align-items-start">
                                <img src="<?php echo base_url('assets/img/').$parti->logo($p->pencalonan_parti); ?>" class="img-fluid rounded" style="object-fit: contain;width: 50px;height: 50px"/>
                                 <span class="mx-3"><?php echo $p->parti_nama; ?> (<?php echo $p->parti_singkatan; ?>)</span></td>
                            <td class="text-center"><?php echo count($kira_parti_calon->kira_parti_calon($p->parti_bil, $pilihanraya_bil)); ?></td>
                        </tr>
                        <?php 
                    endforeach;?>
                        <tr>
                            <td class="text-end" colspan=2><strong>JUMLAH</strong></td>
                            <td class="text-center"><strong><?php echo count($senarai_calon); ?></strong></td>
                        </tr>
                    </table>
        </div>
    </div>

    <div class="col-auto">
        <div class="p-3 border rounded">
            <h3>JULAT UMUR</h3>
            <em class="small text-muted">Peratusan merujuk kepada bilangan calon daripada keseluruhan pencalonan mengikut pilihan raya ini.</em>
            <div class="row g-1 justify-content-center">
                <?php foreach($julat_umur as $j): ?>
                            <div class="col-auto text-center p-1">
                            <div class="card">
                                <div class="card-body">
                                        <h1 class="display-3"><?php echo $j['deskripsi_1']; ?></h1>
                                        <p class="small text-muted">tahun</p>
                                </div>
                                <div class="card-body">
                                    <h2 class="display-1"><?php echo $j['bil_calon']; ?></h2>
                                    <p>calon</p>
                                    <p class="small">(<?php echo $j['peratus']; ?>)</p>
                                </div>
                            </div>
                        </div>

                            <?php endforeach; ?>
            </div>
            <p class="text-muted text-end">Jumlah Calon: <?php echo count($senarai_calon); ?></p>
        </div>
    </div>


    <div class="col-auto">
        <div class="p-3 border rounded">
            <h3>RUMUSAN UMUR CALON</h3>

            <div class="row g-1 justify-content-center">
                <div class="col-auto">

            <div class="row g-1 justify-content-center">
                <h2>Calon Tertua</h2>
            <?php foreach($kira_parti_calon->papar_umur_tua($pilihanraya_bil) as $u_tua): ?>
                                    <div class="col-auto p-3  text-center">
                                        <div class="card">
                                            <div class="card-body">
                                            
                                <img src="<?php echo base_url('assets/img/').$u_tua->foto_nama; ?>" class="img-fluid rounded" style="object-fit: contain;width: 100px;height: 100px"/>
                                <p><?php echo strtoupper($u_tua->dun_nama); ?></p>
                                <p><?php echo $u_tua->ahli_umur; ?> TAHUN</p>
                                <img src="<?php echo base_url('assets/img/').$parti->logo($u_tua->pencalonan_parti); ?>" class="img-fluid rounded" style="object-fit: contain;width: 50px;height: 50px"/>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
            </div>
            </div>

            <div class="col-auto">
            <div class="row g-1 justify-content-center">
                <h2>Calon Termuda</h2>
                <?php foreach($kira_parti_calon->papar_umur_muda($pilihanraya_bil) as $u_muda): ?>
                                    <div class="col-auto p-3  text-center">
                                        <div class="card">
                                            <div class="card-body">
                                            
                                <img src="<?php echo base_url('assets/img/').$ahli->foto($u_muda->ahli_bil); ?>" class="img-fluid rounded" style="object-fit: contain;width: 100px;height: 100px"/>
                                <p><?php echo strtoupper($u_muda->dun_nama); ?></p>
                                <p><?php echo $u_muda->ahli_umur; ?> TAHUN</p>
                                <img src="<?php echo base_url('assets/img/').$parti->logo($u_muda->pencalonan_parti); ?>" class="img-fluid rounded" style="object-fit: contain;width: 50px;height: 50px"/>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
            </div>

                </div></div>

        </div>
    </div>


    <div class="col-auto">
        <div class="p-3 border rounded">
            <h3>RUMUSAN JANTINA CALON</h3>
            <div class="row g-1 justify-content-center">
                <div class="col-auto p-3 text-center bg-light">
                    <h1 class="display-1"><?php $l = $kira_parti_calon->kira_jantina($pilihanraya_bil, 'LELAKI'); echo $l;?></h1>
                    <p class="small text-muted">calon</p>
                    <h2>LELAKI</h2>
                </div>
                <div class="col-auto p-3 text-center bg-dark text-white">
                    <h1 class="display-1"><?php $p = $kira_parti_calon->kira_jantina($pilihanraya_bil, 'PEREMPUAN'); echo $p;?></h1>
                    <p class="small text-muted">calon</p>
                    <h2>PEREMPUAN</h2>
                </div>
            </div>
            <p class="text-end text-muted">Jumlah Calon: <?php echo count($senarai_calon); ?></p>
        </div>
    </div>







</div>
