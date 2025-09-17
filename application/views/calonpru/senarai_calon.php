<div class="container-fluid">
    <h1>SENARAI CALON NEGERI</h1>
    <?php foreach($senarai_pilihanraya as $pr): ?>
        <h2><?php echo $pr->pilihanraya_nama; ?></h2>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <tr>
                <th>BIL</th>
                <th>PARLIMEN</th>
                <th>NAMA CALON</th>
            </tr>
            <?php $count = 1; foreach($senarai_calon as $calon): ?>
                <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo $calon->pt_nama; ?></td>
                    <td><?php echo $calon->pencalonan_parlimen_ahliNama; ?></td>
                </tr>
                <?php endforeach; ?>
        </table>
    </div>
    <?php endforeach; ?>
</div>