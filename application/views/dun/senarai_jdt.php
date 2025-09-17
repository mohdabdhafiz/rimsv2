<div class="container-fluid">
    <div class="p-3 border rounded mb-3">
    <h3>JANGKAAN CALON DUN <?php echo strtoupper($dun->dun_nama); ?></h3>
    <div class="row g-3 mt-3">
            <div class="col-12 col-lg-4">
                <?php echo anchor('dun/tambah_jangkaan_calon', 'Pendaftaran Jangkaan Calon DUN', "class='btn btn-primary w-100'"); ?>
            </div>
            <div class="col-12 col-lg-5">
                <?php echo anchor('dun/senarai_negeri', 'Senarai DUN', "class='btn btn-secondary w-100'"); ?>
            </div>
            <div class="col-12 col-lg-3">
                <?php echo anchor('dun/kemaskini_jangkaan_dun/'.$dun->dun_bil, 'Kemaskini Maklumat Calon', "class='btn btn-secondary w-100'"); ?>
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
                        <?php $nama_foto = $data_foto->foto($calon->jdt_foto_bil); ?>
                        <img src="<?php echo base_url('assets/img/').$nama_foto->foto_nama; ?>" style="object-fit: cover;width: 100px;height: 100px; border-radius: 100%;"/>
                    </td>
                    <td><?php echo $calon->jdt_nama_penuh; ?></td>
                    <td>
                        <?php 
                        $parti = $data_parti->parti($calon->jdt_parti_bil);
                        $nama_foto = $data_foto->foto($parti->parti_logo); ?>
                        <img src="<?php echo base_url('assets/img/').$nama_foto->foto_nama; ?>" style="object-fit: contain;width: 100px;height: 100px;"/>
                    </td>
                    <td><?php echo $calon->jdt_jawatan_parti; ?></td>
                    <td><?php echo $calon->jdt_kategori_umur; ?></td>
                    <td><?php echo $calon->jdt_status_calon; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>