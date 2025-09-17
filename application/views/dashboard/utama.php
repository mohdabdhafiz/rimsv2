

<div class="row g-3 justify-content-center">


    <div class="col-auto">
        <div class="card bg-light">
            <div class="card-body">
            <h3>PENJURU</h3>
                <div class="row g-1">

                    <?php foreach($penjuru as $pen): 
                        if($pen['bilangan_dun']!=0 && $pen['bilangan_penjuru']!=0){?>
                        <div class="col p-3">
                        <div class="row">
                            <div class="col card bg-primary text-white text-center">
                                <div class="card-body">
                                    <h1 class="display-1"><?php echo $pen['bilangan_penjuru']; ?></h1> <br /> <small>Penjuru</small>
                                </div>   
                            </div>
                            <div class="col card text-center">
                                <div class="card-body">
                                <h1 class="display-1"><?php echo $pen['bilangan_dun']; ?></h1> <br /> <small>DUN</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                endforeach; ?>
                </div>
            </div>
            </div>
        </div>
            

    <div class="col-auto">
        <div class="card mb-3 bg-white">
            <div class="card-body">
                <h3>PARTI BERTANDING</h3>
                <div class=" mb-3 p-2">
                    <?php $kira_calon = 0; 
                    $kira_bil = 1; ?>
                    <table class="table table-sm">
                        <tr>
                            <th>BIL</th>
                            <th>NAMA PARTI</th>
                            <th>JUMLAH</th>
                        </tr>
                        <?php
                        foreach($senarai_parti_calon as $p):?>
                        <tr>
                            <td><?php echo $kira_bil++; ?></td>
                            <td class="d-flex align-items-center">
                                <img src="<?php echo base_url('assets/img/').$parti->logo($p->pencalonan_parti); ?>" class="img-fluid rounded" style="object-fit: cover;width: 50px;height: 50px"/>
                                 <span class="mx-3"><?php echo $p->parti_nama; ?> (<?php echo $p->parti_singkatan; ?>)</span></td>
                            <td><?php $bilangan_calon =  count($kira_parti_calon->kira_parti_calon($p->parti_nama));
                            $kira_calon += $bilangan_calon; echo $bilangan_calon; ?></td>
                        </tr>
                        <?php 
                    endforeach;?>
                        <tr>
                            <td class="text-right" colspan=2><strong>JUMLAH</strong></td>
                            <td><strong><?php echo $kira_calon; ?></strong></td>
                        </tr>
                    </table>
                </div>
            </div>      
        </div>
        </div>

        <div class="col-auto card mb-3 bg-white">
            <div class="card-body">
                <h3>JULAT UMUR</h3>

                <div class="row g-1">
                    
                    
                
                    

                    <?php foreach($julat_umur as $j): ?>
                        <div class="col p-3 text-center">
                        <div class=" card">
                            <div class="card-body">
                                    <h1 class="display-1"><?php echo $j['deskripsi_1']; ?></h1>
                            </div>
                            <div class="card-body">
                                <h2 class="display-2"><?php echo $j['bil_calon']; ?></h2>
                                <p>calon</p>
                            </div>
                            <div class="card-body">
                                <h3><?php echo $j['peratus']; ?></h3>
                            </div>
                        </div>
                    </div>

                        <?php endforeach; ?>

                
                </div>

            </div>
            
        </div>
        <div class="col-auto card mb-3 bg-white">
            <div class="card-body">
                <h3>UMUR</h3>
                <div class="row">
                    <div class="col p-3">
                        <div class="card">
                            <div class="card-body">
                            <h1>Calon Tertua</h1>
                                <div class="row">

                                    <?php foreach($kira_parti_calon->papar_umur_tua($pilihanraya_bil) as $u_tua): ?>
                                    <div class="col p-3  text-center">
                                        <div class="card">
                                            <div class="card-body">
                                            
                                <img src="<?php echo base_url('assets/img/').$u_tua->foto_nama; ?>" class="img-fluid rounded" style="object-fit: cover;width: 100px;height: 100px"/>
                                <p><?php echo strtoupper($u_tua->dun_nama); ?></p>
                                <p><?php echo $u_tua->ahli_umur; ?> TAHUN</p>
                                <img src="<?php echo base_url('assets/img/').$parti->logo($u_tua->pencalonan_parti); ?>" class="img-fluid rounded" style="object-fit: cover;width: 50px;height: 50px"/>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>

                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="col p-3">
                        <div class="card">
                            <div class="card-body">
                                <h1>Calon Termuda</h1>
                                <div class="row">

                                    <?php foreach($kira_parti_calon->papar_umur_muda($pilihanraya_bil) as $u_muda): ?>
                                    <div class="col p-3  text-center">
                                        <div class="card">
                                            <div class="card-body">
                                            
                                <img src="<?php echo base_url('assets/img/').$u_muda->foto_nama; ?>" class="img-fluid rounded" style="object-fit: cover;width: 100px;height: 100px"/>
                                <p><?php echo strtoupper($u_muda->dun_nama); ?></p>
                                <p><?php echo $u_muda->ahli_umur; ?> TAHUN</p>
                                <img src="<?php echo base_url('assets/img/').$parti->logo($u_muda->pencalonan_parti); ?>" class="img-fluid rounded" style="object-fit: cover;width: 50px;height: 50px"/>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
        <div class="col-auto card mb-3 bg-white">
            <div class="card-body">
                <h3>JANTINA</h3>

                <div class="row g-1">

                    <div class="col-auto p-3 text-center">
                        <div class="card">
                            <div class="card-body">
                                <h2>LELAKI</h2>
                            </div>
                            <div class="card-body">
                                <h3><?php $l = $kira_parti_calon->kira_jantina($pilihanraya_bil, 'LELAKI'); echo $l;?> calon</h3>
                            </div>
                        </div>
                    </div>


                    <div class="col-auto p-3 text-center">
                        <div class="card">
                            <div class="card-body">
                                <h2>PEREMPUAN</h2>
                            </div>
                            <div class="card-body">
                                <h3><?php $p = $kira_parti_calon->kira_jantina($pilihanraya_bil, 'PEREMPUAN'); echo $p;?> calon</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-auto p-3 text-center">
                        <div class="card">
                            <div class="card-body">
                                <h2>JUMLAH:<br /><?php echo $l + $p; ?> CALON</h2>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
</div>