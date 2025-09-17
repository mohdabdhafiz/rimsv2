<div class="container-fluid">
    <div class="p-3 border rounded mb-3">
        <h1 class="display-1">PARLIMEN <?php echo strtoupper($parlimen->pt_nama); ?></h1>
        <div class="row g-3 mt-3">
            <div class="col-12 col-lg-6 col-md-4">
                <?php echo anchor(base_url(), 'Laman Utama', "class='btn btn-primary w-100'"); ?>
            </div>
            <div class="col-12 col-lg-6 col-md-4">
                <?php $temp_negeri = $parlimen->pt_negeri; 
                $negeri = url_title($temp_negeri);
                echo anchor('winnable_candidate/maklumat_negeri/'.$negeri, $temp_negeri, "class='btn btn-primary w-100'"); ?>
            </div>
        </div>
    </div>
    <div class="p-3 border rounded mb-3">
        <h2 class="display-2">CALON</h2>
        <p class="small text-muted">Senarai Jangkaan Calon Parlimen <?php echo $parlimen->pt_nama; ?> PRU15</p>
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <th valign="middle" class="text-center">GAMBAR</th>
                    <th valign="middle" class="text-center">NAMA CALON</th>
                    <th valign="middle" class="text-center">PARTI CALON</th>
                    <th valign="middle" class="text-center">JAWATAN DALAM PARTI</th>
                    <th valign="middle" class="text-center">KATEGORI UMUR</th>
                    <th valign="middle" class="text-center">JANTINA</th>
                    <th valign="middle" class="text-center">KAUM</th>
                    <th valign="middle" class="text-center">PENYANDANG</th>
                </tr>
                <?php foreach($senarai_calon as $calon): ?>
                    <tr>
                        <td valign="middle" class="text-center">
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
    <div class="p-3 border rounded mb-3">
        <h2 class="display-2">KEKUATAN DAN KELEMAHAN CALON</h2>
        <p class="small text-muted">Perbandingan kekuatan dan kelemahan calon</p>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <th class="text-center" valign="middle">#</th>
                    <?php foreach($senarai_calon as $calon): ?>
                    <th class="text-center" valign="middle">
                        <?php $nama_foto = $data_foto->foto($calon->wct_foto_bil); ?>
                        <img src="<?php echo base_url('assets/img/').$nama_foto->foto_nama; ?>" style="object-fit: cover;width: 100px;height: 100px; border-radius: 100%;"/>
                        <br />
                        <?php $parti = $data_parti->parti($calon->wct_parti_bil); echo $parti->parti_singkatan; ?> - <?php echo $calon->wct_nama_penuh; ?> 
                    </th>
                    <?php endforeach; ?>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center" valign="middle"><span class="display-4"><span class="bi bi-hand-thumbs-up"></span></span></td>
                        <?php foreach($senarai_calon as $calon): ?>
                            <td>
                                <ul>
                                    <?php $senarai_kekuatan = $data_kuat_lemah->kekuatan_calon($calon->wct_bil,'Kekuatan Calon'); 
                                    $senarai_kelemahan = $data_kuat_lemah->kekuatan_calon($calon->wct_bil,'Kelemahan Calon'); 
                                    foreach($senarai_kekuatan as $kekuatan): ?>
                                    <li><?php echo $kekuatan->wctm_deskripsi; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td class="text-center" valign="middle"><span class="display-4"><span class="bi bi-hand-thumbs-down"></span></span></td>
                        <?php foreach($senarai_calon as $calon): ?>
                            <td>
                                <ul>
                                    <?php foreach($senarai_kelemahan as $kelemahan): ?>
                                    <li><?php echo $kelemahan->wctm_deskripsi; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>