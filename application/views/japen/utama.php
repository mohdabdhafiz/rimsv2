<div class="p-3 border rounded mb-3">
    <h3>SENARAI NEGERI DAN BAHAGIAN JABATAN PENERANGAN MALAYSIA</h3>
    <div class="row g-3 mt-3">
        <div class="col">
            <?php echo anchor('japen', 'JAPEN', "class='btn btn-primary w-100'"); ?>
        </div>
        <div class="col">
            <?php echo anchor('japen/organisasi', 'Organisasi', "class='btn btn-primary w-100'"); ?>
        </div>
        <div class="col">
            <?php echo anchor('japen/tambah', 'Tambah Negeri/Bahagian', "class='btn btn-primary w-100'"); ?>
        </div>
        <div class="col">
            <?php echo anchor('japen/senarai_pengguna_rims', 'Senarai Pengguna RIMS', "class='btn btn-primary w-100'"); ?>
        </div>
    </div>
</div>

<div class="row g-3 mb-3">
    <?php foreach($senaraiPejabat as $pejabat): ?>
    <div class="col col-lg-3 col-md-4 col-sm-6 d-flex align-items-stretch">
        <div class="p-3 border rounded d-flex flex-column w-100">
            <p>
                <strong>Bahagian/Negeri</strong><br>
                <?php echo $pejabat->jt_pejabat; ?>
            </p>
            <p>
                <strong>Negeri</strong><br>
                <?php echo $pejabat->jt_negeri; ?>
            </p>
            <p class="small text-muted mt-auto">Oleh <?php echo $pejabat->jt_pengguna_nama; ?> - <?php echo $pejabat->jt_tarikh_masuk; ?></p>
            <div class="row g-3">
                <div class="col col-lg-6 col-md-6 col-sm-12">
                    <?php echo anchor('japen/kemaskini/'.$pejabat->jt_bil, 'Kemaskini', "class='btn btn-primary w-100'"); ?>
                </div>
                <div class="col col-lg-6 col-md-6 col-sm-12">
                    <?php echo anchor('japen/padam/'.$pejabat->jt_bil, 'Padam', "class='btn btn-danger w-100'"); ?>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>