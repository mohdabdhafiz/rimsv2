<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
        <?php echo anchor(base_url(), 'RIMS (JaPen Negeri)'); ?>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Laman Utama</li>
  </ol>
</nav>




<div class="mb-3">

<?php 
    $senarai_pengguna = array();
    $senarai_padam_parlimen = $data_pengguna->senarai_padam_parlimen($negeri_bil->nt_bil);
    $senarai_padam_dun = $data_pengguna->senarai_padam_dun($negeri_bil->nt_bil);
    foreach($senarai_padam_parlimen as $padam_parlimen){
        if(!in_array($padam_parlimen->bil, $senarai_pengguna)){
            array_push($senarai_pengguna, $padam_parlimen->bil);
        }
    }
    foreach($senarai_padam_dun as $padam_dun){
        if(!in_array($padam_dun->bil, $senarai_pengguna)){
            array_push($senarai_pengguna, $padam_dun->bil);
        }
    }
    $kiraan_tugasan = count($senarai_pengguna);
    if($kiraan_tugasan > 0){ 
    ?>
<div class="p-3 border rounded mb-3">
    <p><strong>Rumusan Tugasan</strong></p>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Bil</th>
                    <th>Tugasan</th>
                    <th>Operasi</th>
                </tr>
            </thead>
            <tbody>

                <?php $bilangan = 1; ?>

                <?php // Pengesahan Padam 
                if(count($senarai_pengguna) > 0){
                ?>
                <tr>
                    <td><?= $bilangan++ ?></td>
                    <td>Terdapat <strong><?= count($senarai_pengguna) ?> akaun</strong> memerlukan pengesahan untuk dipadam.</td>
                    <td><?php echo anchor('pengguna/senarai_padam/'.$negeri_bil->nt_bil, 'Pengesahan', "class='btn btn-danger w-100'"); ?></td>
                </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>  
</div>
<?php } ?>

<div class="row g-3 mb-3">
    <div class="col-12 col-lg-6 col-md-6 col-sm-6 d-flex align-items-stretch">
        <?php $this->load->view('negeri/personel/nav'); ?>
    </div>
    <div class="col-12 col-lg-6 col-md-6 col-sm-6 d-flex align-items-stretch">
        <?php $this->load->view('negeri/lapis/nav'); ?>
    </div>
    <div class="col-12 col-lg-6 col-md-6 col-sm-6 d-flex align-items-stretch">
        <?php $this->load->view('negeri_na/lapis/sentimen/nav'); ?>
    </div>
    <div class="col-12 col-lg-6 col-md-6 col-sm-6 d-flex align-items-stretch">
        <?php $this->load->view('negeri/program/nav'); ?>
    </div>
    <div class="col-12 col-lg-6 col-md-6 col-sm-6 d-flex align-items-stretch">
        <?php $this->load->view('negeri/sismap/nav'); ?>
    </div>
    <div class="col-12 col-lg-6 col-md-6 col-sm-6 d-flex align-items-stretch">
        <?php $this->load->view('negeri_na/obp/nav'); ?>
    </div>
    <div class="col-12 col-lg-12 col-md-12 col-sm-12 d-flex align-items-stretch">
        <?php $this->load->view('negeri/konfigurasi/nav'); ?>
    </div>
</div>






        <h2>PARLIMEN</h2>
        <div class="row g-3 mb-3">
            <div class="col-12 col-lg-3 d-flex align-self-stretch">
                <div class="p-3 border rounded d-flex flex-column w-100">
                    <h3 class=" text-center mb-3">JANGKAAN CALON PARLIMEN</h3>
                    <div class="mt-auto">
                        <div class="row g-3">
                            <div class="col-12">
                                <?php echo anchor('winnable_candidate/utama', 'Dashboard Jangkaan Calon', "class='btn btn-primary w-100'"); ?>
                            </div>
                            <div class="col-12">
                                <?php echo anchor('winnable_candidate/daftar', 'Tambah Jangkaan Calon Parlimen', "class='btn btn-primary w-100'"); ?>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            <div class="col-12 col-lg-3 d-flex align-self-stretch">
                <div class="p-3 border rounded d-flex flex-column w-100">
                    <h3 class=" text-center mb-3">HARI PENAMAAN CALON PARLIMEN</h3>
                    <div class="mt-auto">
                        <div class="row g-3">
                            <div class="col-12">
                                <?php 
                                $bil = 6;
                                echo anchor('data_virtualization/pilihanraya_parlimen/'.$bil, 'Dashboard Penamaan Calon', "class='btn btn-primary w-100'"); 
                                ?>
                            </div>
                            <div class="col-12">
                                <?php echo anchor('pencalonan/parlimen', 'Tambah Pencalonan PRU', "class='btn btn-primary w-100'"); ?>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            <div class="col-12 col-lg-3 d-flex align-self-stretch">
                <div class="p-3 border rounded d-flex flex-column w-100">
                    <h3 class=" text-center mb-3">STATUS HARIAN PARLIMEN</h3>
                    <div class="mt-auto">
                        <div class="row g-3">
                            <div class="col-12">
                                <?php echo anchor('grading/negeri', 'Dashboard Grading', "class='btn btn-primary w-100'"); ?>
                            </div>
                            <div class="col-12">
                                <?php echo anchor(base_url(), 'Senarai Parlimen', "class='btn btn-primary w-100'"); ?>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            <div class="col-12 col-lg-3 d-flex align-self-stretch">
                <div class="p-3 border rounded d-flex flex-column w-100">
                    <h3 class=" text-center mb-3">HARI PEMBUANGAN UNDI PARLIMEN</h3>
                    <div class="mt-auto">
                        <div class="row g-3">
                            <div class="col-12">
                                <?php echo anchor('undi', 'Dashboard Pembuangan Undi', "class='btn btn-primary w-100'"); ?>
                            </div>
                            <div class="col-12">
                                <?php echo anchor('undi/operasi', 'Operasi', "class='btn btn-primary w-100'"); ?>
                            </div>
                            <div class="col-12">
                                <?php echo anchor('undi/tambahKeluarMengundiParlimen', 'Kemaskini Status Keluar Mengundi', "class='btn btn-outline-primary shadow-sm w-100'"); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <h2>DUN</h2>
        <div class="row g-3 mb-3">
            <div class="col-12 col-lg-3 d-flex align-self-stretch">
                <div class="p-3 border rounded d-flex flex-column w-100">
                    <h3 class=" text-center">JANGKAAN CALON DUN</h3>
                    <div class="mt-auto">
                        <div class="row g-3">
                            <div class="col-12">
                                <?php echo anchor('dun/senarai_negeri', 'Dashboard', "class = 'btn btn-secondary w-100'"); ?>
                            </div>
                            <div class="col-12">
                                <?php echo anchor('dun/tambah_jangkaan_calon', 'Tambah Pencalonan', "class='btn btn-secondary w-100'"); ?>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            <div class="col-12 col-lg-3 d-flex align-self-stretch">
                <div class="p-3 border rounded d-flex flex-column w-100">
                    <h3 class=" text-center">HARI PENAMAAN CALON DUN</h3>
                    <div class="mt-auto">
                        <div class="row g-3">
                            <div class="col-12">
                                <a href="<?= site_url('pencalonan/senarai') ?>" class="btn btn-outline-secondary shadow-sm w-100">Senarai Pencalonan</a>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            <div class="col-12 col-lg-3 d-flex align-self-stretch">
                <div class="p-3 border rounded d-flex flex-column w-100">
                    <h3 class=" text-center">STATUS HARIAN DUN</h3>
                    <div class="mt-auto">
                        <div class="row g-3">
                            <?php foreach($senaraiPilihanrayaNegeriDun as $pruDun): ?>
                            <div class="col-12">
                                <a href="<?= site_url('harian/pilihanrayaDun/'.$pruDun->pilihanraya_bil) ?>" class="btn btn-outline-secondary shadow-sm w-100"><?= $pruDun->pilihanraya_nama ?></a>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                </div>
            <div class="col-12 col-lg-3 d-flex align-self-stretch">
                <div class="p-3 border rounded d-flex flex-column w-100">
                    <h3 class=" text-center">HARI PEMBUANGAN UNDI DUN</h3>
                    <div class="mt-auto">
                        <div class="row g-3">
                            <div class="col-12">
                                <?php echo anchor('undi', 'Dashboard Pembuangan Undi', "class='btn btn-outline-secondary shadow-sm w-100'"); ?>
                            </div>
                            <div class="col-12">
                                <?php echo anchor('undi/operasi', 'Operasi', "class='btn btn-outline-secondary shadow-sm w-100'"); ?>
                            </div>
                            <div class="col-12">
                                <?php echo anchor('undi/tambahKeluarMengundiDun', 'Kemaskini Status Keluar Mengundi', "class='btn btn-outline-secondary shadow-sm w-100'"); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
</div>