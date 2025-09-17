<div class="container p-5">
    <h1>PUTIH</h1>
    <p><strong>SENARAI PENUH PENGUNDI PUTIH BAGI DUN: <?php echo strtoupper($dun); ?></strong></p>
    <div class="mb-5">
        <?php echo anchor('pengundi/tambah_pengundi_putih', 'TAMBAH PENGUNDI PUTIH', "class='btn btn-primary w-100'"); ?>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <tr>
                <th>NAMA PENGUNDI</th>
                <th>NOMBOR KAD PENGENALAN</th>
                <th>NOMBOR TELEFON</th>
                <th>ALAMAT</th>
            </tr>
            <?php foreach($senarai_pengundi_putih as $pengundi): ?>
                <tr>
                    <td><?php echo $pengundi->ppt_nama_penuh; ?></td>
                    <td><?php echo $pengundi->ppt_no_ic; ?></td>
                    <td><?php echo $pengundi->ppt_no_tel; ?></td>
                    <td><?php echo $pengundi->ppt_alamat; ?></td>
                </tr>
                <?php endforeach; ?>
        </table>
    </div>
</div>