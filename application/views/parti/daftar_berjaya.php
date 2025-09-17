<div class="row">
<?php foreach($data_parti as $dp): ?>
    <div class="col-sm-3">
        <p>Data berjaya dimasukkan.</p>
        
        <table class="table border">
            <tr>
                <th>Nama Parti</th>
                <td><?php echo $dp->parti_nama; ?></td>
            </tr>
            <tr>
                <th>Singkatan Parti</th>
                <td><?php echo $dp->parti_singkatan; ?></td>
            </tr>
            <tr>
                <th>Dimasukkan Oleh</th>
                <td><?php echo $dp->nama_penuh; ?></td>
            </tr>
            <tr>
                <th>Waktu Muat Naik</th>
                <td><?php echo $dp->parti_waktu; ?></td>
            </tr>
        </table>
        
    </div>
    <?php endforeach; ?>

    <div class="col-sm-6">
        <?php echo $daftar; ?>
    </div>

</div>
