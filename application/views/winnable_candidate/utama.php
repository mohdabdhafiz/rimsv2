<div class="container-fluid">
    <div class="p-3 border rounded mb-3">
        <h3>JANGKAAN PENCALONAN PARLIMEN PRU15</h3>
        <p class="small text-muted"><?php  echo $data_wc_model->assign($pengguna->pengguna_peranan_bil)->wcat_negeri; ?></p>
        <div class="row g-3 mt-3">
            <div class="col-12 col-lg-6">
                <?php echo anchor('winnable_candidate/daftar', 'Tambah Calon', "class='btn btn-primary w-100'"); ?>
            </div>
            <div class="col-12 col-lg-6">
                <?php echo anchor('winnable_candidate/senarai_negeri', 'Senarai Parlimen', "class='btn btn-secondary w-100'"); ?>
            </div>
        </div>
    </div>
</div>