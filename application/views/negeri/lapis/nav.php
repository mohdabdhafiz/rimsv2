<div class="p-3 border rounded d-flex flex-column w-100">
    <p><strong>RIMS@LAPIS</strong></p>
    <div class="row g-3 mt-auto">
        <div class="col-12 col-lg-6">
            <?php echo anchor('lapis', 'Maklumat Penuh', "class='btn btn-sm btn-outline-success shadow-sm w-100'"); ?>
        </div>
        <div class="col-12 col-lg-6">
            <?= anchor('lapis/senarai_kluster', 'Laporan Penuh Mengikut Kluster', "class='btn btn-sm btn-outline-success shadow-sm w-100'") ?>
        </div>
        <div class="col-12 col-lg-6">
            <a href="<?= site_url('lapis/statusPenghantaran') ?>" class="btn btn-outline-success btn-sm shadow-sm w-100">Status Penghantaran Laporan</a>
        </div>
        <div class="col-12 col-lg-6">
            <a href="<?= site_url('lapis/listArkib') ?>" class="btn btn-outline-success btn-sm shadow-sm w-100">Arkib</a>
        </div>
    </div>
</div>