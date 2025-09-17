<div class="p-3 border rounded">
    <h2>SENARAI DUN <?= strtoupper($negeri->nt_nama) ?></h2>
    <div class="table-responsive mt-3">
        <table class="table table-bordered table-hover">
            <tr class="bg-secondary text-white">
                <th>BIL</th>
                <th>DUN</th>
            </tr>
            <?php $bilangan = 1;
            $senarai_dun = $data_dun->negeri($negeri->nt_nama);
            foreach($senarai_dun as $dun): ?>
            <tr>
                <td><?= $bilangan++ ?></td>
                <td><?= anchor('perumus/maklumat_dun/'.$dun->dun_bil, strtoupper($dun->dun_nama)) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>