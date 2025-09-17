<div class="p-3 border rounded">
    <h2>SENARAI PARLIMEN <?= strtoupper($negeri->nt_nama) ?></h2>
    <div class="table-responsive mt-3">
        <table class="table table-bordered table-hover">
            <tr class="bg-secondary text-white">
                <th>BIL</th>
                <th>PARLIMEN</th>
            </tr>
            <?php $bilangan = 1;
            $senarai_parlimen = $data_parlimen->negeri($negeri->nt_nama);
            foreach($senarai_parlimen as $parlimen): ?>
            <tr>
                <td><?= $bilangan++ ?></td>
                <td><?= anchor('perumus/maklumat_parlimen/'.$parlimen->pt_bil, strtoupper($parlimen->pt_nama)) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>