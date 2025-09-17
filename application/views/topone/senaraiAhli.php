<a href="<?= site_url('parlimen/senarai') ?>">Senarai Parlimen</a>
<a href="<?= site_url('dun/senarai') ?>">Senarai DUN</a>

<div class="p-3 border rounded mb-3">
    <h1 class="display-5">Senarai Wakil Rakyat Parlimen</h1>
    <table class="table">
        <thead>
            <tr>
                <th>BIL</th>
                <th>NEGERI</th>
                <th>PARLIMEN</th>
                <th>NAMA WAKIL RAKYAT</th>
                <th>PARTI</th>
                <th>PILIHAN RAYA</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $count = 1;
            foreach($senaraiParlimen as $p): ?>
            <tr>
                <td><?= $count++ ?></td>
                <td><?= $p->nt_nama ?></td>
                <td><?= $p->pt_nama ?></td>
                <td><?= $p->ahli_nama ?></td>
                <td><?= $p->parti_nama ?></td>
                <td><?= $p->pilihanraya_nama ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="p-3 border rounded">
    <h1 class="display-5">Senarai Wakil Rakyat DUN</h1>
    <table class="table">
        <thead>
            <tr>
                <th>BIL</th>
                <th>NEGERI</th>
                <th>DUN</th>
                <th>NAMA WAKIL RAKYAT</th>
                <th>PARTI</th>
                <th>PILIHAN RAYA</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $count = 1;
            foreach($senaraiDun as $d): ?>
            <tr>
                <td><?= $count++ ?></td>
                <td><?= $d->nt_nama ?></td>
                <td><?= $d->dun_nama ?></td>
                <td><?= $d->ahli_nama ?></td>
                <td><?= $d->parti_nama ?></td>
                <td><?= $d->pilihanraya_nama ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>