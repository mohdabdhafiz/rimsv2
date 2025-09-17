<div class="p-3 border rounded mb-3">
    <h2>SENARAI PENGGUNA</h2>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <tr>
                <th>BIL</th>
                <th>PENGGUNA</th>
                <th>PASSWORD</th>
            </tr>
            <?php $bilangan = 1; foreach($senarai_pengguna as $pengguna): ?>
            <tr>
                <td><?= $bilangan++ ?></td>
                <td><?php echo $pengguna->pengguna_ic; ?></td>
                <td><?php echo $pengguna->no_tel; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>