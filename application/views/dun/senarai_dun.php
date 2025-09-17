<ol>
<?php foreach($senarai_dun as $dun): ?>
<li><?php echo anchor('undi/dun/'.$dun->dun_bil, $dun->dun_nama); ?></li>
    <?php endforeach; ?>
    </ol>


<?php if(count($senarai_dun) == 0){ ?>
    <div class="alert alert-warning p-3">
TIADA PENGLIBATAN PILIHAN RAYA AKTIF YANG DIREKODKAN.
</div>
<?php } ?>