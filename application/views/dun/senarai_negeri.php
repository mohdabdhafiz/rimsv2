

<div class="container-fluid">
    <div class="p-3 border rounded mb-3">
        <h3>JANGKAAN CALON DUN</h3>
        <p class="small text-muted"><?php echo $negeri; ?></p>
        <div class="row g-3 mt-3">
            <div class="col-12 col-lg-2">
                <?php echo anchor(base_url(), 'Laman Utama', "class='btn btn-primary w-100'"); ?>
            </div>
            <div class="col-12 col-lg-4">
                <?php echo anchor('dun/tambah_jangkaan_calon', 'Pendaftaran Jangkaan Calon DUN', "class='btn btn-secondary w-100'"); ?>
            </div>
            <div class="col-12 col-lg-6">
                <?php echo anchor('dun/senarai_negeri', 'Senarai DUN', "class='btn btn-info w-100'"); ?>
            </div>
        </div>
    </div>
    <div class="row g-3 mb-3">
        <?php foreach($senarai_dun_negeri as $dun): ?>
            <div class="col-12 col-lg-3 d-flex align-items-stretch">
                <div class="p-3 border rounded w-100 d-flex flex-column">
                    <p><?php echo $dun->dun_nama; ?></p>
                    <?php $senarai_calon = $data_calon->calon_dun($dun->dun_bil);
                    if(!empty($senarai_calon)){ ?>
                    <div class="row g-1 mb-3">
                        <?php foreach($senarai_calon as $calon): ?>
                        <div class="col text-center"><img src="<?php echo base_url('assets/img/').$data_foto->foto($calon->jdt_foto_bil)->foto_nama; ?>" style="object-fit: cover;width: 50px;height: 50px; border-radius: 100%;"/></div>
                        <?php endforeach; ?>
                    </div>
                    <p class="text-end text-muted small">Bilangan Orang Jangkaan Calon DUN <?php echo $dun->dun_nama; ?> : <?php echo count($senarai_calon); ?> orang</p>
                    <?php } ?>
                    <div class="mt-auto">
                        <?php echo anchor('dun/senarai_jangkaan_calon/'.$dun->dun_bil, 'Senarai Calon', "class='btn btn-primary w-100'"); ?> 
                    </div> 
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>