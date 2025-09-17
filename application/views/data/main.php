<h1>LAPORAN</h1>

<h2>2.1 KAWASAN PARLIMEN, DUN DAN PRK BUGAYA</h2>
<table class="table table-bordered mb-3">
    <tr>
        <th>PARTI</th>
        <?php $jumlah_calon = array(); foreach($senarai_pilihanraya as $pru): ?>
        <th><?php echo $pru->pilihanraya_nama; $jumlah_calon[$pru->pilihanraya_bil] = 0; ?></th>
        <?php endforeach; ?>
    </tr>
    <?php   foreach($senarai_parti as $parti): 
        ?>
    <tr>
        <td><?= $parti->parti_nama ?> (<?= $parti->parti_singkatan ?>)</td>
        <?php $bilangan_calon = 0; foreach($senarai_pilihanraya as $pru): 
            if($pru->pilihanraya_bil == $parti->pilihanraya_bil){ ?>
        <td><?php 
$bilangan_calon = $bilangan_calon + count($data_calon_parlimen->calon_ikut_parti($parti->parti_bil, $pru->pilihanraya_bil));   
echo $bilangan_calon; $jumlah_calon[$pru->pilihanraya_bil] = $jumlah_calon[$pru->pilihanraya_bil] + $bilangan_calon; ?></td>
        <?php } endforeach; ?>
    </tr>
    <?php endforeach; ?>
    <tr>
        <th>JUMLAH</th>
        <?php foreach($senarai_pilihanraya as $pru): ?>
        <th><?= $jumlah_calon[$pru->pilihanraya_bil] ?></th>
        <?php endforeach; ?>
    </tr>
</table>
<h2>A. KAWASAN PARLIMEN</h2>
<p>Jangkaan BN menang parlimen</p>
<table class="table table-bordered mb-3">
    <tr>
        <th>NEGERI</th>
        <th>JUMLAH KERUSI</th>
        <th>BN TANDING</th>
        <th>JANGKAAN BN MENANG</th>
        <th colspan=4>STATUS GRADING</th>
    </tr>
    <tr>
        <td colspan=4></td>
        <td>P</td>
        <td>KP</td>
        <td>KH</td>
        <td>H</td>
    </tr>
    <tr>
        <td>PERLIS</td>
        <td>3</td>
        <td>3</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>3</td>
        <td>0</td>
    </tr>
    <tr>
        <th>JUMLAH KERUSI</th>
        <th>222</th>
        <th>178</th>
        <th>64</th>
        <th>0</th>
        <th>64</th>
        <th>105</th>
        <th>9</th>
    </tr>
</table>

