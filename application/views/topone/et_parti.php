<div class="p-3 border rounded mb-3">
    <h2 class="display-2">ANALISA STATUS <?= strtoupper($pru->pilihanraya_jenis) ?></h2>
    <p class="small text-muted"><?= strtoupper($pru->pilihanraya_nama) ?></p>
</div>

<?php if($pru->pilihanraya_jenis == 'PARLIMEN') { ?>

<div class="p-3 border rounded mb-3">
    <h2>KEPUTUSAN SEMASA</h2>

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <tr>
                <th>BIL</th>
                <th>PARLIMEN</th>
                <th>MENANG</th>
            </tr>
            <?php $bilangan = 1;
            foreach($senarai_parlimen as $parlimen): ?>
            <tr>
                <td><?= $bilangan++ ?></td>
                <td><?= $parlimen->pt_nama ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<?php } ?>