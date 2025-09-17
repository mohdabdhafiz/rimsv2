<div class="container-fluid mb-3">
    <h1>SENARAI TUGAS</h1>
    <h2>PARLIMEN</h2>
    <p>BILANGAN PENGUNDI: <?php echo $data_pdm->jumlah_pengundi_keseluruhan()->total; ?></p>
    <table class="table table-bordered table-hover">
        <tbody>
            <?php foreach($senarai_parlimen as $parlimen): ?>
            <tr>
                <td><?php echo anchor('parlimen/dm/'.$parlimen->pt_bil, $parlimen->pt_nama); ?></td>
                <td><?php echo $parlimen->pt_negeri; ?></td>
                <td>
                    <?php $pdm = $data_pdm->parlimen($parlimen->pt_bil); 
                    echo count($pdm); ?>
                    
                </td>
                <td>
                    <?php $jumlah_pengundi = $data_pdm->jumlah_pengundi_parlimen($parlimen->pt_bil)->jumlah;
                    echo $jumlah_pengundi; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>DUN</h2>
    <table class="table table-bordered table-hover">
        <tbody>
            <?php foreach($senarai_dun as $dun): ?>
            <tr>
                <td><?php echo anchor('dun/dm/'.$dun->dun_bil, $dun->dun_nama); ?></td>
                <td><?php echo $dun->dun_negeri; ?></td>
                <td><?php $pdm = $data_pdm->dun($dun->dun_bil); 
                    echo count($pdm); ?></td>
                <td>
                    <?php $jumlah_pengundi = $data_pdm->jumlah_pengundi_dun($dun->dun_bil)->jumlah;
                    echo $jumlah_pengundi; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>