<div class="row g-3 mt-3">
        <?php foreach($senarai_kluster as $kluster_link): ?>
        <div class="col-12 col-lg-3">
            <?php echo anchor('lapis/analisis_kluster/'.$kluster_link->kit_bil, 'Kluster '.$kluster_link->kit_nama, "class='btn btn-sm btn-outline-success w-100'"); ?>
        </div>
        <?php endforeach; ?>
    </div>