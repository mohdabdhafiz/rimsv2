<div class="container">
    <div class="p-3 border rounded mb-3">
        <h1>Maklumat berjaya didaftarkan</h1>
        <p>Maklumat jenis program berjaya didaftarkan</p>
        <div class="row g-3">
            <div class="col-12 col-lg-4 col-md-4 col-sm-12">
                <?php echo anchor('program', 'Laman Utama Program', "class='btn btn-primary w-100'"); ?>
            </div>
            <div class="col-12 col-lg-4 col-md-4 col-sm-12">
                <?php echo anchor('jenis', 'Laman Jenis Program', "class='btn btn-secondary w-100'"); ?>
            </div>
            <div class="col-12 col-lg-4 col-md-4 col-sm-12">
                <?php echo anchor('jenis/tambah', 'Tambah Jenis Program', "class='btn btn-success w-100'"); ?>
            </div>
        </div>
    </div>
</div>