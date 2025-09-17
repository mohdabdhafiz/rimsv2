<div class="container-fluid">
    <div class="p-3 border rounded mb-3">
    <h3>JANGKAAN CALON PRU15 PARLIMEN <?php echo strtoupper($parlimen->pt_nama); ?></h3>
    <div class="row g-3 mt-3">
            <div class="col-12 col-lg-4">
                <?php echo anchor('winnable_candidate/daftar', 'Pendaftaran Jangkaan Calon Parlimen PRU15', "class='btn btn-primary w-100'"); ?>
            </div>
            <div class="col-12 col-lg-5">
                <?php echo anchor('winnable_candidate/senarai_negeri', 'Senarai Parlimen', "class='btn btn-secondary w-100'"); ?>
            </div>
            <div class="col-12 col-lg-3">
                <?php echo anchor('winnable_candidate/kemaskini_parlimen/'.$parlimen->pt_bil, 'Kemaskini Maklumat Calon', "class='btn btn-secondary w-100'"); ?>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>GAMBAR</th>
                <th>NAMA CALON</th>
                <th>PARTI CALON</th>
                <th>JAWATAN DALAM PARTI</th>
                <th>KATEGORI UMUR</th>
                <th>PENYANDANG</th>
            </tr>
            <?php foreach($senarai_calon as $calon): ?>
                <tr>
                    <td>
                        <?php $nama_foto = $data_foto->foto($calon->wct_foto_bil); ?>
                        <img src="<?php echo base_url('assets/img/').$nama_foto->foto_nama; ?>" style="object-fit: cover;width: 100px;height: 100px; border-radius: 100%;"/>
                    </td>
                    <td><?php echo $calon->wct_nama_penuh; ?></td>
                    <td>
                        <?php 
                        $parti = $data_parti->parti($calon->wct_parti_bil);
                        $nama_foto = $data_foto->foto($parti->parti_logo); ?>
                        <img src="<?php echo base_url('assets/img/').$nama_foto->foto_nama; ?>" style="object-fit: contain;width: 100px;height: 100px;"/>
                    </td>
                    <td><?php echo $calon->wct_jawatan_parti; ?></td>
                    <td><?php echo $calon->wct_kategori_umur; ?></td>
                    <td><?php echo $calon->wct_status_calon; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>