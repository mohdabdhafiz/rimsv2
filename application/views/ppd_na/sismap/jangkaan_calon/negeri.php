<?php 
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/sidebar');
$this->load->view('ppd_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Jangkaan Calon</a></li>
                <li class="breadcrumb-item active"><?= $negeri->nt_nama ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        
        <?php $this->load->view('ppd_na/sismap/jangkaan_calon/nav'); ?>

        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Senarai Mengikut Parlimen (<?= count($senaraiParlimen) ?>)</h1>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Parlimen</th>
                                <th>Jangkaan Calon</th>
                                <th>Operasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($senaraiParlimen as $parlimen): 
                                $senaraiCalonParlimen = $dataCalonParlimen->calon_parlimen($parlimen->pt_bil); ?>
                            <tr>
                                <td>
                                    <?= $parlimen->pt_nama ?>
                                    <br>(<?= count($senaraiCalonParlimen) ?>)
                                </td>
                                <td>
                                    <?php if(!empty($senaraiCalonParlimen)): ?>
                                    <div class="row g-1">
                                        <?php foreach($senaraiCalonParlimen as $calonParlimen): ?>
                                        <div class="col-12 col-lg-3">
                                            <div class="p-1 text-center">
                                            <img src="<?php echo base_url('assets/img/').$dataFoto->foto($calonParlimen->wct_foto_bil)->foto_nama; ?>" style="object-fit: cover;width: 50px;height: 50px; border-radius: 100%;"/>
                                            <p>
                                                <?= $calonParlimen->wct_nama_penuh ?> (<?= $calonParlimen->wct_kategori_umur ?>)
                                                <br><?= $calonParlimen->parti_singkatan ?>
                                            </p>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                </td>
                                <td style="width: 10%;">
                                    <a href="<?= site_url('winnable_candidate/parlimen/'.$parlimen->pt_bil) ?>" class="btn btn-outline-primary shadow-sm">Maklumat Lanjut</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Senarai Mengikut DUN (<?= count($senaraiDun) ?>)</h1>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>DUN</th>
                                <th>Jangkaan Calon</th>
                                <th>Operasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($senaraiDun as $dun): 
                                $senaraiCalonDun = $dataCalonDun->calon_dun($dun->dun_bil);    
                            ?>
                            <tr>
                                <td>
                                    <?= $dun->dun_nama ?>
                                    <br>(<?= count($senaraiCalonDun) ?>)
                                </td>
                                <td>
                                    <?php if(!empty($senaraiCalonDun)): ?>
                                    <div class="row g-1">
                                    <?php foreach($senaraiCalonDun as $calonDun): ?>
                                        <div class="col-12 col-lg-3">
                                            <div class="p-1 text-center">
                                            <img src="<?php echo base_url('assets/img/').$dataFoto->foto($calonDun->jdt_foto_bil)->foto_nama; ?>" style="object-fit: cover;width: 50px;height: 50px; border-radius: 100%;"/>
                                            <p>
                                                <?= $calonDun->jdt_nama_penuh ?> (<?= $calonDun->jdt_kategori_umur ?>)
                                                <br><?= $calonDun->parti_singkatan ?>
                                            </p>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                </td>
                                <td style="width: 10%;">
                                    <a href="<?= site_url('winnable_candidate/dun/'.$dun->dun_bil) ?>" class="btn btn-outline-primary shadow-sm">Maklumat Lanjut</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>


    </main>


<?php $this->load->view('ppd_na/susunletak/bawah'); ?>
