<div class="p-3 border rounded mb-3">
    <h2>SENARAI NEGERI</h2>
    <div class="table-responsive mt-3">
        <table class="table table-bordered table-hover">
            <tr class="bg-secondary text-white">
                <th>BIL</th>
                <th>NEGERI</th>
            </tr>
            <?php $bilangan = 1;
                foreach($senarai_negeri as $negeri): ?>
            <tr>
                <td><?= $bilangan++ ?></td>
                <td>
                    <?php echo anchor('perumus/maklumat_negeri/'.$negeri->nt_bil, strtoupper($negeri->nt_nama)); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>