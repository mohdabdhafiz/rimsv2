<?php $this->load->view('lapis/nav'); ?>

<div class="p-3 border rounded mb-3">
    <p><strong>Tambah Laporan Baharu</strong></p>
    <p class="small text-muted">Pilihan Kluster</p>

<div class="row g-3 mb-3">
    <?php foreach($senarai_kluster as $kluster): ?>
        <div class="col-12 col-lg-3 d-flex align-item-stretch">
            <div class="p-3 border rounded w-100 d-flex flex-column">
                <div>
                    <p><strong><?= $kluster->kit_nama ?></strong></p>
            <p><?= $kluster->kit_deskripsi ?></p>
            </div>
            <div class="mt-auto">
                <div class="row g-1">
                    <div class="col d-flex justify-content-center align-items-stretch">
                        <?php echo anchor('lapis/'.$kluster->kit_shortform, 'Pilih Kluster Isu', "class='btn btn-sm btn-outline-success w-100 d-flex align-items-center justify-content-center'"); ?>
                    </div>
                    <div class="col d-flex justify-content-center align-items-stretch">
                        <?php echo anchor('lapis/borangIsu/'.$kluster->kit_bil, 'Pilih Kluster Isu Versi 2.0', "class='btn btn-sm btn-outline-success w-100 d-flex align-items-center justify-content-center'"); ?>
                    </div>
                </div>
            </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</div>
