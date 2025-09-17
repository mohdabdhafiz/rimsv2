<div class="container-fluid">
    <div class="p-3 border rounded mb-3">
        <h1 class="display-1"><?php echo strtoupper($negeri); ?></h1>
        <p class="small text-muted">Senarai Jangkaan Calon Parlimen PRU15 Mengikut Negeri</p>
        <div class="row g-3 mt-3">
            <div class="col-12 col-lg-12">
                <?php echo anchor(base_url(), 'Laman Utama', "class='btn btn-primary w-100'"); ?>
            </div>
        </div>
    </div>
    <div class="p-3 border rounded mb-3">
        <h2 class="display-2">PARLIMEN</h2>
        <p class="small text-muted">Senarai Calon Parlimen PRU15 Mengikut Parlimen <?php echo $negeri; ?></p>
        <div class="table-responsive mt-3">
            <table class="table table-hover table-bordered">
                <tr class="bg-secondary text-white">
                    <th class="text-center">BIL</th>
                    <th>SENARAI PARLIMEN</th>
                    <th class="text-center">BILANGAN CALON PARLIMEN PRU15 (ORANG)</th>
                </tr>
                <?php $count = 1; 
                $jumlah_calon = 0;
                foreach($senarai_parlimen as $parlimen): ?>
                <tr>
                    <td class="text-center"><?php echo $count++; ?></td>
                    <td><?php echo anchor("laporan/maklumat_parlimen/".$parlimen->pt_bil, $parlimen->pt_nama); ?></td>
                    <td class="text-center"><?php $bilangan_calon = count($data_wc->calon_parlimen($parlimen->pt_bil));
                    $jumlah_calon = $jumlah_calon + $bilangan_calon;
                    echo $bilangan_calon; ?></td>
                </tr>
                <?php endforeach; ?>
                <tr class="bg-light">
                    <th colspan=2 class="text-center">JUMLAH</th>
                    <th class="text-center"><?php echo $jumlah_calon; ?></th>
                </tr>
            </table>
        </div>
    </div>
    <div class="p-3 border rounded mb-3">
        <h2 class="display-2">CALON</h2>
        <p class="small text-muted">Senarai Calon Parlimen PRU15</p>
        <div class="table-responsive">
            <table class="table table-hover">
                <tr class="bg-secondary text-white">
                    <th class="text-center" valign="middle">BIL</th>
                    <th class="text-center" valign="middle">PARLIMEN</th>
                    <th class="text-center" valign="middle">GAMBAR</th>
                    <th valign="middle" class="text-center">NAMA CALON</th>
                    <th valign="middle" class="text-center">PARTI CALON</th>
                    <th valign="middle" class="text-center">JAWATAN DALAM PARTI</th>
                    <th valign="middle" class="text-center">KATEGORI UMUR</th>
                    <th valign="middle" class="text-center">JANTINA</th>
                    <th valign="middle" class="text-center">KAUM</th>
                    <th valign="middle" class="text-center">PENYANDANG</th>
                </tr>
                <?php $count = 1; 
                foreach($data_wc->semua_negeri($negeri) as $calon): ?>
                    <tr>
                        <td valign="middle" class="text-center"><?php echo $count++; ?></td>
                        <td valign="middle" class="text-center"><?php echo $data_parlimen->parlimen_bil($calon->pencalonan_parlimen_parlimenBil)->pt_nama; ?></td>
                        <td valign="center" class="text-center">
                            <?php $nama_foto = $data_foto->foto($calon->wct_foto_bil); ?>
                            <img src="<?php echo base_url('assets/img/').$nama_foto->foto_nama; ?>" style="object-fit: cover;width: 100px;height: 100px; border-radius: 100%;"/>
                        </td>
                        <td valign="middle" class="text-center"><?php echo $calon->wct_nama_penuh; ?></td>
                        <td valign="middle" class="text-center">
                            <?php 
                            $parti = $data_parti->parti($calon->wct_parti_bil);
                            $nama_foto = $data_foto->foto($parti->parti_logo); ?>
                            <img src="<?php echo base_url('assets/img/').$nama_foto->foto_nama; ?>" style="object-fit: contain;width: 100px;height: 100px;"/>
                        </td>
                        <td valign="middle" class="text-center"><?php echo $calon->wct_jawatan_parti; ?></td>
                        <td valign="middle" class="text-center"><?php echo $calon->wct_kategori_umur; ?></td>
                        <td valign="middle" class="text-center"><?php echo $calon->wct_jantina; ?></td>
                        <td valign="middle" class="text-center"><?php echo $calon->wct_kaum; ?></td>
                        <td valign="middle" class="text-center"><?php echo $calon->wct_status_calon; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>


