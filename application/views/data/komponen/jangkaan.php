<?php foreach($senarai_pilihanraya as $pru): 
    if($pru->pilihanraya_jenis == 'PARLIMEN'){
        $senarai_calon = $data_calon_parlimen->senarai_parti_jangkaan($pru->pilihanraya_bil);
        ?>
<div class="p-3 border rounded mb-3">
    <h3><?= strtoupper($pru->pilihanraya_nama) ?></h3>
    <p class="small text-muted">JANGKAAN PEMENANG</p>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>PARTI</th>
                <th>PARLIMEN</th>
            </tr>
            <?php foreach($senarai_calon as $calon): 
                $parti = $data_parti->parti($calon->pencalonan_parlimen_partiBil); 
                $senarai_parlimen = $data_calon_parlimen->senarai_calon_jangkaan($calon->pencalonan_parlimen_partiBil, $pru->pilihanraya_bil); ?>
            <tr>
                <td><?= $parti->parti_singkatan ?></td>
                <td>
                    <ol>
                    <?php foreach($senarai_parlimen as $p): ?>
                            <li><?= $p->pt_nama ?> (<?= $p->pt_negeri ?>)</li>
                        <?php endforeach; ?>
                        </ol>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php } ?> 


<?php if($pru->pilihanraya_jenis == 'DUN'){ 
        $senarai_calon = $data_calon_dun->senarai_parti_jangkaan($pru->pilihanraya_bil);
        ?>
<div class="p-3 border rounded mb-3">
    <h3><?= strtoupper($pru->pilihanraya_nama) ?></h3>
    <p class="small text-muted">JANGKAAN PEMENANG</p>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>PARTI</th>
                <th>DUN</th>
            </tr>
            <?php foreach($senarai_calon as $calon): 
                $parti = $data_parti->parti($calon->pencalonan_parti); 
                $senarai_dun = $data_calon_dun->senarai_calon_jangkaan($calon->pencalonan_parti, $pru->pilihanraya_bil); ?>
            <tr>
                <td><?= $parti->parti_singkatan ?></td>
                <td>
                    <ol>
                    <?php foreach($senarai_dun as $d): ?>
                            <li><?= $d->dun_nama ?> (<?= $d->dun_negeri ?>)</li>
                        <?php endforeach; ?>
                        </ol>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>


<?php } endforeach; ?>