<?php foreach($senarai_parti as $parti): ?>
<div class="row g-3">
    <div class="col-12">
        <div class="p-3 text-center">
            <div class="row g-3 justify-content-center align-items-center">
                <div class="col-auto">
                <img src="<?php echo base_url('assets/img/').$model_parti->logo($parti->parti_bil); ?>" class="img-fluid" style="object-fit: contain;width: 100px;height: 100px"/>
                </div>
                <div class="col-auto">
                    <h1><?php echo strtoupper($parti->parti_nama." (".$parti->parti_singkatan.")"); ?></h1>
                </div>
            </div>
            
            <p class="small text-muted"><?php echo strtoupper($parti->pilihanraya_nama." (".$parti->pilihanraya_singkatan.")"); ?></p>
        </div>
    </div>

    <div class="col-12">
        <div class="p-3">
            <table class="table table-bordered">
                <td>
                    <h1>SENARAI PENCALONAN MENGIKUT POPULARITI</h1>
                    <div class="row g-3">
                        <?php foreach($senarai_calon as $calon): ?>
                        <div class="col-2">
                            <div class="p-3 border rounded text-center">
                                <p>UNDIAN: <?php echo $calon->status_grading_peratus; ?>%</p>
                                <img src="<?php echo base_url('assets/img/').$model_ahli->foto($calon->ahli_bil); ?>" class="img-fluid mb-3" style="object-fit: cover;width: 100px;height: 100px"/>
                                <p>
                                    <?php echo strtoupper($calon->ahli_nama); ?> <br> 
                                    <?php echo strtoupper($calon->dun_nama); ?>
                                </p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                </td>
            </table>
        </div>
    </div>



</div>
<?php endforeach; ?>