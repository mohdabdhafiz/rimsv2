<ol>
<?php foreach($senarai_parlimen as $parlimen): ?>
<li><?php echo anchor('undi/parlimen/'.$parlimen->pt_bil, $parlimen->pt_nama); ?></li>
    <?php endforeach; ?>
    </ol>

<?php if(count($senarai_parlimen) == 0){ ?>
<p>TIADA PERTANDINGAN YANG DIREKODKAN.</p>
<?php } ?>