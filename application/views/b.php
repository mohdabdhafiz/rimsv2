<table class="table table-bordered">
    <tr>
        <td>DUN</td>
    </tr>
    <?php foreach($senarai_dun as $dun): ?>
    <tr>
        <td><?php echo $dun->dun_nama; ?><br>
            <ol>
                <?php foreach($senarai_calon->papar_ikut_dun($dun->dun_bil) as $calon): ?>
                <li><?php echo $calon->ahli_nama; ?> (<?php echo $calon->parti_singkatan; ?>)</li>
                <?php endforeach; ?>
            </ol>
        </td>
    </tr>
    <?php endforeach; ?>
</table>