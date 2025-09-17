<div class="container-fluid">
    <div class="p-3 border rounded mb-3">
        <h1 class="display-1"><?php echo strtoupper($parti->parti_nama); ?> (<?php echo strtoupper($parti->parti_singkatan); ?>)</h1>
        <p class="small text-muted">Senarai Jangkaan Calon Parlimen PRU15 Mengikut Parti</p>
        <div class="row g-3 mt-3">
            <div class="col-12 col-lg-12">
                <?php echo anchor(base_url(), 'Laman Utama', "class='btn btn-primary w-100'"); ?>
            </div>
        </div>
    </div>
    <div class="p-3 border rounded mb-3">
        <h2 class="display-2">PARTI</h2>
        <p class="small text-muted">Senarai Jangkaan Calon Parlimen PRU15 Mengikut <?php echo $parti->parti_singkatan; ?></p>
        <div class="table-responsive mt-3">
            <table class="table table-hover table-bordered">
                <tr class="bg-secondary text-white">
                    <th class="text-center">BIL</th>
                    <th>SENARAI PARLIMEN</th>
                    <th class="text-center">BILANGAN JANGKAAN CALON <?php echo strtoupper($parti->parti_singkatan); ?> PARLIMEN PRU15 (ORANG)</th>
                </tr>
                <?php $count = 1; 
                $jumlah_calon = 0;
                foreach($senarai_parlimen as $parlimen): 
                if(count($data_wc->calon_parti_parlimen($parti->parti_bil, $parlimen->pt_bil)) > 0){?>
                <tr>
                    <td class="text-center"><?php echo $count++; ?></td>
                    <td><?php echo anchor("winnable_candidate/maklumat_parlimen/".$parlimen->pt_bil, $parlimen->pt_nama); ?></td>
                    <td class="text-center"><?php $bilangan_calon = count($data_wc->calon_parti_parlimen($parti->parti_bil, $parlimen->pt_bil));
                    $jumlah_calon = $jumlah_calon + $bilangan_calon;
                    echo $bilangan_calon; ?></td>
                </tr>
                <?php } endforeach; ?>
                <tr class="bg-light">
                    <th colspan=2 class="text-center">JUMLAH</th>
                    <th class="text-center"><?php echo $jumlah_calon; ?></th>
                </tr>
            </table>
        </div>
    </div>
    
</div>


