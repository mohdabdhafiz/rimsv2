<div class="container-fluid">
        <h3>SENARAI PILIHAN RAYA</h3>

<div class="row g-3">

<?php foreach($senarai_pilihanraya as $pr): ?>
<div class="col col-lg-4">
    <div class="p-3 border rounded">
        <h2><?php echo $pr->pilihanraya_nama; ?></h2>
            <?php echo anchor('pilihanraya/maklumat/'.$pr->pilihanraya_bil, 'Maklumat Umum', "class='btn btn-primary w-100 mt-5 mb-3'"); ?>
    </div>
</div>
<?php endforeach; ?>


</div>
</div>