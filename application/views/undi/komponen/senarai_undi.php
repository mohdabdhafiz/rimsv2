<h1>RUMUSAN UNDIAN</h1>

<?php foreach($senarai_pilihanraya as $pru):


    if($pru->pilihanraya_jenis == 'PARLIMEN'){
        $senarai_parti = $data_calon_parlimen->senarai_parti($pru->pilihanraya_bil);
    ?>
<h2><?= strtoupper($pru->pilihanraya_nama) ?></h2>
<p class="small text-muted">BILANGAN PENGUNDI</p>
<div class="table-responsive">
<table class="table table-sm table-hover table-striped">
<tr>
    <th>NEGERI</th>
    <?php 
    $jumlah_undi_parti = array();
    foreach($senarai_parti as $parti): 
        $jumlah_undi_parti[$parti->pencalonan_parlimen_partiBil] = 0;
        $p = $data_parti->parti($parti->pencalonan_parlimen_partiBil); ?>
    <th><?= $p->parti_singkatan ?></th>
    <?php endforeach; ?>
</tr>
<?php foreach($senarai_negeri as $negeri): ?>
<tr>
    <th><?= $negeri->nt_nama ?></th>
    <?php foreach($senarai_parti as $parti): 
        $senarai_undian = $data_calon_parlimen->calon_undi($negeri->nt_nama, $pru->pilihanraya_bil, $parti->pencalonan_parlimen_partiBil); 
        $total_undi = 0;
        foreach($senarai_undian as $undi){
            $total_undi = $total_undi + $undi->kpt_undi;
        }
        $jumlah_undi_parti[$parti->pencalonan_parlimen_partiBil] = $jumlah_undi_parti[$parti->pencalonan_parlimen_partiBil] + $total_undi;
        ?>
    <td><?= number_format($total_undi, 0, '', ','); ?></td>
    <?php endforeach; ?>
</tr>
<?php endforeach; ?>
<tr>
    <th>JUMLAH</th>
    <?php foreach($senarai_parti as $parti): ?>
    <th><?= number_format($jumlah_undi_parti[$parti->pencalonan_parlimen_partiBil],0,'',',') ?></th>
    <?php endforeach; ?>
</tr>
</table>
</div>
<?php
    } 
    if($pru->pilihanraya_jenis == 'DUN'){
        $senarai_parti = $data_calon_dun->senarai_parti($pru->pilihanraya_bil);
?>
<h2><?= strtoupper($pru->pilihanraya_nama) ?></h2>
<p class="small text-muted">BILANGAN PENGUNDI</p>
<div class="table-responsive">
<table class="table table-sm table-hover table-striped">
<tr>
    <th>NEGERI</th>
    <?php 
    $jumlah_undi_parti = array();
    foreach($senarai_parti as $parti): 
        $jumlah_undi_parti[$parti->pencalonan_parti] = 0;
        $p = $data_parti->parti($parti->pencalonan_parti); ?>
    <th><?= $p->parti_singkatan ?></th>
    <?php endforeach; ?>
</tr>
<?php foreach($senarai_negeri as $negeri): ?>
<tr>
    <th><?= $negeri->nt_nama ?></th>
    <?php foreach($senarai_parti as $parti): 
        $senarai_undian = $data_calon_dun->calon_undi($negeri->nt_nama, $pru->pilihanraya_bil, $parti->pencalonan_parti); 
        $total_undi = 0;
        foreach($senarai_undian as $undi){
            $total_undi = $total_undi + $undi->kdt_undi;
        }
        $jumlah_undi_parti[$parti->pencalonan_parti] = $jumlah_undi_parti[$parti->pencalonan_parti] + $total_undi;?>
    <td><?= number_format($total_undi, 0, '', ','); ?></td>
    <?php endforeach; ?>
</tr>
<?php endforeach; ?>
<tr>
    <th>JUMLAH</th>
    <?php foreach($senarai_parti as $parti): ?>
    <th><?= number_format($jumlah_undi_parti[$parti->pencalonan_parti],0,'',',') ?></th>
    <?php endforeach; ?>
</tr>
</table>
</div>
<?php } ?>


<?php endforeach; ?>