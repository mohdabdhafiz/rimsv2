<div class="container-fluid">
    <h1 class="display-1"><?= $pru->pilihanraya_nama ?></h1>
    <p>Senarai Calon Mengikut <?= $parti->parti_nama ?></p>
    <?php
    $count = 1;
    ?>
    <div class="table-responsive">
        <table class="table table-sm table-hover table-bordered">
            <thead>
                <tr>
                    <th>BIL</th>
                    <th>CALON</th>
                    <th>PARLIMEN / DUN</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($senaraiCalon as $calon): ?>
                <tr>
                    <td><?= $count++ ?></td>
                    <td>
                        <?= $calon->ahli_nama ?>
                        <br><?= $calon->ahli_umur ?>
                        <br><?= $calon->ahli_jantina ?>
                    </td>
                    <td>
                    <?php if($pru->pilihanraya_jenis == 'PARLIMEN'): ?>
                        <?= $calon->pt_nama ?>
                    <?php endif; ?>
                        <?php if($pru->pilihanraya_jenis == 'DUN'): ?>
                        <?= $calon->dun_nama ?>
                    <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>