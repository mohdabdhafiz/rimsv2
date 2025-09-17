<?php foreach($parti as $p): ?>
<div class="row g-3">
    <div class="col-12">
        <div class="p-3">
            <p class="small text-muted">Nombor Siri: <?php echo $p->parti_bil; ?></p>
            <h1><?php echo $p->parti_nama; ?></h1>
        </div>
    </div>
</div>

<div class="row g-3">
    
    <div class="col-auto col-lg-4">
        <div class="p-3">
            <h2>Maklumat Parti</h2>
            <div class="p-3 border rounded">
                <table class="table">
                    <tr>
                        <td>Nama Parti</td>
                        <td><?php echo $p->parti_nama; ?></td>
                    </tr>
                    <tr>
                        <td>Nama Singkatan Parti</td>
                        <td><?php echo $p->parti_singkatan; ?></td>
                    </tr>
                </table>
                <?php echo anchor('parti/kemaskini/'.$p->parti_bil, 'Kemaskini Maklumat Parti', "class='btn btn-primary btn-sm'"); ?>
            </div>
        </div>
    </div>

    <div class="col-auto col-lg-2">
        <div class="p-3 border rounded text-center text-white bg-info">
            <h1 class="display-1"><?php echo $bilangan_calon; ?></h1>
            <p class="small">calon pilihan raya</p>
        </div>
    </div>

    <div class="col-auto col-lg-6">
        <div class="p-3">
            <h2>Senarai Penglibatan Pilihan Raya</h2>
            <div class="p-3 border rounded">
                <table class="table table-bordered">
                    <tr>
                        <th>BIL</th>
                        <th>PILIHAN RAYA</th>
                        <th>TAHUN</th>
                        <th>BILANGAN CALON</th>
                        <th>BILANGAN PENYANDANG</th>
                    </tr>
                    <?php $bil=1; foreach($pencalonan->penglibatan_parti($p->parti_bil) as $pru): if($pru->pencalonan_parti == $p->parti_bil){?>
                    <tr>
                        <td><?php echo $bil++ ;?></td>
                        <td><?php echo $pru->pilihanraya_nama; ?></td>
                        <td><?php echo $pru->pilihanraya_tahun; ?></td>
                        <td><?php echo count($pencalonan->kira_calon_sahaja($p->parti_bil, $pru->pilihanraya_bil)); ?></td>
                        <td><?php echo count($pencalonan->kira_penyandang($p->parti_bil, $pru->pilihanraya_bil)); ?></td>
                    </tr>
                    <?php } endforeach; ?>
                </table>
            </div>
        </div>
    </div>

    <div class="col-auto">
        <div class="p-3">
            <h2>Senarai Ahli Parti Yang Pernah Bertanding</h2>
            <div class="p-3 border rounded">
                <div class="row g-2">
                    <?php foreach($pencalonan->penglibatan_parti($p->parti_bil) as $pru2): ?>
                    <?php foreach($pencalonan->papar_ikut_calon($pru2->pencalonan_pilihanraya) as $ahli): if($pru2->parti_bil == $ahli->parti_bil){?>
                    <div class="col ">
                        <div class="p-3 bg-light border rounded text-center">
                        <?php echo strtoupper($ahli->dun_negeri); ?>
                        <br /><img src="<?php echo base_url('assets/img/').$ahli->foto_nama; ?>" class="mt-1 mb-1 img-fluid rounded" style="object-fit: cover;width: 100px;height: 100px"/>
                        <br /><?php echo anchor('ahli/id/'.$ahli->ahli_bil, $ahli->ahli_nama); 
                        if($pru2->pencalonan_keputusan_sebenar == 'MENANG'){
                            echo "<br />PENYANDANG <br />DUN ".strtoupper($ahli->dun_nama);
                        }?>

                        </div>
                    </div>
                    <?php } endforeach; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>


</div>

<?php endforeach; ?>