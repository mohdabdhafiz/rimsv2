<div class="row">
<?php foreach($data_dun as $dd): ?>
    <div class="col-sm-3">
        <p>Data berjaya dimasukkan.</p>
        
        <table class="table border">
            <tr>
                <th>Nama Parti</th>
                <td><?php echo $dd->dun_nama; ?></td>
            </tr>
            <tr>
                <th>Singkatan Parti</th>
                <td><?php echo $dd->dun_negeri; ?></td>
            </tr>
            <tr>
                <th>Dimasukkan Oleh</th>
                <td><?php echo $dd->nama_penuh; ?></td>
            </tr>
            <tr>
                <th>Waktu Muat Naik</th>
                <td><?php echo $dd->dun_waktu; ?></td>
            </tr>
        </table>
        
    </div>
    <?php endforeach; ?>

    <div class="col-sm-6">
        <?php echo $daftar; ?>
    </div>

</div>
