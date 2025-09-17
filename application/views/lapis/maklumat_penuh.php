<?php $this->load->view('lapis/nav'); ?>

<div class="p-3 border rounded mb-3">
    <h2 class="display-6">Senarai Penuh Laporan</h2>
    <p class="small text-muted">Senarai penuh laporan yang telah dihantar. Berikut adalah pilihan senarai kluster isu.</p>
</div>

<div class="row g-3 mb-3">
    <?php foreach($senarai_kluster as $kluster): ?>
        <div class="col-12 col-lg-4 d-flex align-item-stretch">
            <div class="p-3 border rounded w-100 d-flex flex-column">
                <div>
            <h2 class="display-6"><?= $kluster->kit_nama ?></h2>
            <p><?= $kluster->kit_deskripsi ?></p>
            </div>
            <div class="mt-auto">
            <?php echo anchor('lapis/penuh/'.$kluster->kit_shortform, 'Pilih Kluster Isu', "class='btn btn-sm btn-outline-success w-100'"); ?>
            </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
