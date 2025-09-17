<div class="p-3 border rounded mb-3">
    <h3 class="mb-3">LAPORAN UTAMA TAHUN <?php echo $tahun; ?></h3>
    <div class="row g-3">
        <div class="col">
            <?php echo anchor('program', 'Maklumat Program', "class='btn btn-primary w-100'"); ?>
        </div>
        <div class="col">
            <?php echo anchor('pilihanraya', 'Maklumat Pilihan Raya', "class='btn btn-secondary w-100'"); ?>
        </div>
    </div>
</div>

<!-- PROGRAM -->
<div class="p-3 border rounded mb-3">
    <p><strong>Laporan Perancangan dan Pelaksanaan Program-Program Bahagian Gerak Saraf dan Pengurusan Isu (BGSPI)</strong></p>
    <div class="row g-3 mb-3">
        <?php foreach($senarai_jenis_program as $jenis_program):
            $jumlah_pelaksanaan = 0;
            $jumlah_perancangan = 0; 
            foreach($senarai_jabatan as $jabatan){
                $input_kpi = $data_kpi->laporan_kpi($jabatan->jt_bil, $jenis_program->jt_bil)->kt_bilangan;
                $jumlah_perancangan = $jumlah_perancangan + $input_kpi;
                $input_laksana = count($data_program->senarai_ikut_jenis_program_negeri($jenis_program->jt_bil, $jabatan->jt_pejabat, $tahun));
                $jumlah_pelaksanaan = $jumlah_pelaksanaan + $input_laksana;
            }?>
        <div class="col-12 col-lg-2 col-md-6 col-sm-12">
            <div class="p-3 border rounded">
                <p class="text-center"><strong><?php echo $jenis_program->jt_nama; ?></strong></p>
                <p class="text-center"><span class="display-3"><?php echo $jumlah_pelaksanaan; ?></span> / <?php echo $jumlah_perancangan; ?></p>
                <p class="small text-muted text-center">Pelaksanaan / Perancangan</p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <tr>
                <th rowspan=2>BIL</th>
                <th>Program</th>
                <?php foreach($senarai_jenis_program as $jenis_program): ?>
                <th colspan=3><?php echo $jenis_program->jt_nama; ?></th>
                <?php endforeach; ?>
            </tr>
            <tr>
                <th>Negeri</th>
                <?php foreach($senarai_jenis_program as $jenis_program): ?>
                <th>KPI</th>
                <th>LAKSANA</th>
                <th>%</th>
                <?php endforeach; ?>
            </tr>
            <?php $count = 1; foreach($senarai_jabatan as $jabatan): $input_kpi = 0; $input_laksana = 0; ?>
                <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo $jabatan->jt_pejabat; ?></td>
                    <?php foreach($senarai_jenis_program as $jenis_program): ?>
                    <td><?php $input_kpi = $data_kpi->laporan_kpi($jabatan->jt_bil, $jenis_program->jt_bil)->kt_bilangan; echo $input_kpi; ?></td>
                    <td><?php $input_laksana = count($data_program->senarai_ikut_jenis_program_negeri($jenis_program->jt_bil, $jabatan->jt_pejabat, $tahun)); echo $input_laksana; ?></td>
                    <td><?php
                    if($input_kpi == 0){
                        $input_kpi = 1;
                    } 
                    echo number_format(($input_laksana/$input_kpi) * 100, 2, '.', ''); ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php echo anchor('program', 'Maklumat Program', "class='btn btn-primary w-100'"); ?>
</div>

<!-- PILIHAN RAYA -->
<div class="p-3 border rounded mb-3">
    <p><strong>Pilihan Raya Tahun <?php echo $tahun; ?></strong></p>
    <?php
    $senarai_pilihanraya = $data_pilihanraya->pilihanraya_ikut_tahun($tahun);
    if(!empty($senarai_pilihanraya)){ ?>
    <div class="row g-3 mb-3">
        <?php foreach($senarai_pilihanraya as $pilihanraya): ?>
        <div class="col-12 col-lg-4 col-md-4 col-sm-12">
            <div class="p-3 border rounded">
            <p><strong><?php echo $pilihanraya->pilihanraya_nama; ?> <br>
            (<?php echo $pilihanraya->pilihanraya_singkatan; ?>)</strong></p>
            <p><strong>Tarikh Penamaan Calon</strong><br>
                <?php echo date_format(date_create($pilihanraya->pilihanraya_penamaan_calon), "d.m.Y"); ?>
            </p>
            <p><strong>Tarikh Lock Status</strong><br>
                <?php echo date_format(date_create($pilihanraya->pilihanraya_lock_status), "d.m.Y"); ?>
            </p>
            <p><strong>Bilangan Calon Parlimen</strong><br>
            <?php echo count($data_pencalonan_parlimen->senaraiCalonPilihanraya($pilihanraya->pilihanraya_bil)); ?> orang calon
            </p>
            <p><strong>Bilangan Calon DUN</strong><br>
            <?php echo count($data_pencalonan_dun->papar_ikut_pilihanraya($pilihanraya->pilihanraya_bil)); ?> orang calon
            </p>
            <p class="small text-muted mb-3">Oleh <?php echo $data_pengguna->nama_pengguna($pilihanraya->pilihanraya_pengguna); ?> (<?php echo $pilihanraya->pilihanraya_waktu; ?>)</p>
            <?php echo anchor('pilihanraya/info/'.$pilihanraya->pilihanraya_bil, 'Maklumat Lanjut', "class='btn btn-secondary w-100'"); ?>
            
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php } else { ?>
        <div class="alert alert-warning">
            Tiada Pilihan Raya dijalankan pada tahun <?php echo $tahun; ?>
        </div>
    <?php } ?>
    <?php echo anchor('pilihanraya', 'Maklumat Pilihan Raya', "class='btn btn-primary w-100'"); ?>
</div>