<div class="p-3 border rounded w-100">
    <p><strong>RIMS@PROGRAM</strong></p>
    <div class="row g-1 mt-1">
        <div class="col-12 col-lg-4 col-md-4 col-sm-12">
            <a href="<?= site_url('program') ?>" class='btn btn-sm btn-outline-secondary w-100 shadow-sm'>RIMS@PROGRAM</a>
        </div>
        <div class="col-12 col-lg-4 col-md-4 col-sm-12">
            <a href="<?= site_url('program/senarai') ?>" class="btn btn-sm btn-outline-secondary w-100 shadow-sm">Senarai Program</a>
        </div>
        <div class="col-12 col-lg-4 col-md-4 col-sm-12">
            <?php echo anchor('program/tambah', 'Tambah Program Baharu', "class='btn btn-sm btn-outline-secondary w-100'"); ?>
        </div>
    </div>
</div>